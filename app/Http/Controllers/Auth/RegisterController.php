<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
       
        return view('auth.register');
    }

    public function store(Request $request) {

        $this->validate($request, [
               
                'email' => 'required|email|unique:users,email',
               
                'password' => 'required|min:6|confirmed',
                'first_name' => 'required',
                'last_name' => 'required',
            ]);

            $user = new User();
            $user->first_name = $request->first_name;
            $user->middle_name = $request->middle_name;
            $user->last_name = $request->last_name;
            $user->role = 'sa';
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
          
            Toastr::success('Account Created sucessfully', 'success');
            return redirect()->route('users.sa.index');
    }
}

