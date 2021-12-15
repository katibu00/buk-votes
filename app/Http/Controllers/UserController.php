<?php

namespace App\Http\Controllers;

use App\Models\Elcom;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data['datas'] = User::where('role','voter')->get();
        $data['elcoms'] = Elcom::all();
        return view('users.index',$data);
    }

    public function make_elcom(Request $request, $id){

        
        $password = Str::random(2).mt_rand(100,90000000); 

        $user = User::findorFail($id);
        $user->nickname = $password;
        $user->role = 'elcom';
        $user->elcom_id = $request->election_id;
        $user->password =  Hash::make($password);
        $user->update();

        Toastr::success('ELCOM Assigned Successfully', 'success');
        return redirect()->route('users.index');
    }

    public function SAindex()
    {
        $data['datas'] = User::where('role','sa')->get();
        $data['elcoms'] = Elcom::all();
        return view('users.sa_index',$data);
    }

    public function delete(Request $request)
    {
        if(User::where('role','sa')->get()->count() == 1){
            Toastr::error('You can not delete this Admin', 'Not Allowed');
            return redirect()->route('users.sa.index');
        }

        $user = User::findorFail($request->user_id);
        $user->delete();

        Toastr::success('User Deleted Successfully', 'success');
        return redirect()->route('users.sa.index');
    }

    public function password(Request $request)
    {
        $user = User::findorFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->update();

        Toastr::success('Password Changed Successfully', 'success');
        return redirect()->route('users.sa.index');
    }

    public function Candidateindex(){

        $data['datas'] = User::where('role','candidate')->get();
        $data['elcoms'] = Elcom::all();
        return view('users.candidates_index',$data);
    }


}
