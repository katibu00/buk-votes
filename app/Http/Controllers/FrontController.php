<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Settings;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(){

        $setting = Settings::findorFail(1);
        if($setting->frontend == 'on'){
            $data['datas'] = Election::all();
            return view('front.home',$data);
        }else{
            return redirect()->route('voter.login');
        }
       
    }


    public function offcial($id){
        $data['datas'] = Election::all();
        $data['election'] = Election::where('id',$id)->first();
        return view('front.official',$data);
    }


    public function timetable_back(){
        $data['datas'] = Election::all();
        return view('timetable.back',$data);
    }

    public function documentation(){
        $data['datas'] = Election::all();
        // $data['election'] = Election::where('id',$id)->first();
        return view('front.documentation',$data);
    }

    public function downloadStudent(){

        return response()->download('uploads/documentation/Students Guide - BUK eVote System.pdf');
   }
    public function downloadCandidate(){

        return response()->download('uploads/documentation/Candidates Guide - BUK eVote System.pdf');
   }
    public function downloadElcom(){

        return response()->download('uploads/documentation/ELCOMs Guide - BUK eVote System.pdf');
   }
}
