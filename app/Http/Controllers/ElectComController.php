<?php

namespace App\Http\Controllers;

use App\Models\Elcom;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ElectComController extends Controller
{
    public function index(){
        $data['datas'] = Elcom::all();
        return view('users.elcom',$data);
    }

    public function dissolve(Request $request){
        
        $users = User::where('role','elcom')->where('elcom_id',$request->elcom_id)->get();

        foreach($users as $user){
            $user->nickname = '';
            $user->elcom_id = '';
            $user->role = 'voter';
            $user->password = '';
            $user->update();
        }

        Toastr::success('ELCOM dissolved Successfully', 'success');
        return redirect()->route('electcom.index');

    }
}
