<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function __construct()
    {
        auth()->logout();
        $this->middleware('guest')->except('logout');

    }

    public function index()
    {
        auth()->logout();
        return view('auth.login');

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'reg_number';
        request()->merge([$fieldType => $login]);

        if (!auth()->attempt($request->only($fieldType, 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
        if (Auth::user()->role == 'sa') {
            return redirect()->route('admin.home');
        } elseif (Auth::user()->role == 'elcom') {
            return redirect()->route('elcom.home');
        } elseif (Auth::user()->role == 'candidate') {
            return redirect()->route('candidate.home');
        } elseif (Auth::user()->usertype == 'voter') {
            return redirect()->route('voter.home');
        } else {
            return back()->with('status', 'You are not Authorized to Access this Website');
        }

    }

    public function voter_index()
    {
        auth()->logout();
        return view('auth.voter_login');
    }

    public function voter_login(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
        ]);

        $user = User::where('reg_number', '=', $request->login)->first();

        if ($user) {

            if (Auth::loginUsingId($user->id)) {
                if (Auth::user()->role != 'voter') {
                    return back()->with('status', 'Please Login as Candidate');
                }
                return redirect()->route('voter.homeAlert');
            }
        } else {

            $url = 'https://mybuk2.buk.edu.ng/api/ug.php';
            $key = sha1('K92@218$%_712bn');
            $json = json_decode(file_get_contents('https://mybuk2.buk.edu.ng/api/ug.php?regno=' . $request->login . '&api_key=' . $key), true);

            if ($json['status'] == 'true') {

                $user = new User();
                $user->first_name = $json['first_name'];
                $user->middle_name = $json['middle_name'];
                $user->last_name = $json['last_name'];
                $user->reg_number = $request->login;
                $user->email = $json['otheremail'];
                $user->role = 'voter';
                $user->phone = $json['phone'];
                $user->level = $json['level'];
                $user->state = $json['state'];
                $user->lga = $json['lga'];
                $user->save();

                if (Auth::loginUsingId($user->id)) {
                    if (Auth::user()->role != 'voter') {
                        return back()->with('status', 'Please Login as Candidate');
                    }
                    return redirect()->route('voter.homeAlert');
                }

            } else {

                return back()->with('status', 'Invalid Registration Number or does not exist.');

            }

        }

    }
}
