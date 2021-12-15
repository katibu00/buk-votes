<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\FormCheck;
use App\Models\User;
use App\Models\VoterAuth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){

        if(Auth::user()->role == 'voter'){

            $checkauth = VoterAuth::where('user_id',Auth::user()->id)->first();
            if($checkauth == null || $checkauth->verified == 0){

                Toastr::error('Please authenticate yourself first.', 'warning');
                return redirect()->route('voter.home');
            }
        }

        $data['faculties'] = Faculty::all();
        $data['departments'] = Department::all();
        $data['user'] = User::findorFail(Auth::user()->id);
        return view('Auth.profile',$data);
    }

    public function update(Request $request){

        $data['faculties'] = Faculty::all();
        $data['departments'] = Department::all();
        $data['user'] = User::findorFail(Auth::user()->id);
        $user = $data['user'];


        if($user->role == 'voter'){

        $this->validate($request, [

            // 'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm' => 'required|same:password',

        ]);
        }

        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->nickname = $request->nickname;
        $user->department_id = $request->department_id;
        $user->faculty_id = $request->faculty_id;
        $user->cgpa = $request->cgpa;
        $user->level = $request->level;    

            if($user->role == 'voter'){

                if($request->password != $request->confirm){

                    Toastr::error('Passwords do not match', 'error');
                    return redirect()->route('profile');
                }

                $user->password = Hash::make($request->password);
                $user->role = 'candidate';

            }

            if ($request->file('image') != null) {

                $destination = 'uploads/users'.$user->image;

                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('uploads/users', $filename);
                $user->image = $filename;
            }

            $user->save();
        $check = FormCheck::where('user_id',$user->id)->first();
        if(!$check){

            $check = new FormCheck();
            $check->user_id = $user->id;
            $check->profile = 1;

            if ($request->file('image') != null) {
                $check->progress = 20;
                $check->picture = 1;
            }else{
                $check->progress = 10;
            }
            $check->save();
        }else{

            $check = FormCheck::where('user_id',$user->id)->first();


            if ($request->file('image') != null) {
                $check->progress = 20;
                $check->picture = 1;
            }

            $check->update();
        }



        Toastr::success('Profile Updated Successfully', 'success');
        return redirect()->route('candidate.home');
    }


    public function details($id){
        $data['user'] = User::findorFail($id);
        return view('Auth.details',$data);
    }
}
