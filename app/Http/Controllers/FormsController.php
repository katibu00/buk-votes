<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\FormCheck;
use App\Models\Forms;
use App\Models\Posts;
use App\Models\SRACandidates;
use App\Models\SRAForm;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{

    public function index(){
        $data['elections'] = Election::all();
        $data['posts'] = Posts::all();
        return view('forms.index',$data);
    }


    public function form_generate($id){
        if(Forms::where('election_id',$id)->first()){
            Toastr::error('Forms already generated for this election', 'Not Allowed');
            return redirect()->route('forms.index');
        }
        $data['elections'] = Election::all();
        $data['posts'] = Posts::all();
        $data['id'] = $id;
        return view('forms.generate',$data);
    }

    public function form_generate_sra($id){

        if(SRAForm::where('election_id',$id)->first()){
            Toastr::error('SRA Forms already generated for this election', 'Not Allowed');
            return redirect()->route('forms.index');
        }
        $data['elections'] = Election::all();
        $data['posts'] = Posts::all();
        $data['id'] = $id;
        return view('forms.sra_create',$data);
    }

    public function form_store(Request $request){

        $positionCount = count($request->post_id);
        if($positionCount != NULL){
            for ($i=0; $i < $positionCount; $i++){
                $data = new Forms();
                $data->election_id = $request->election_id;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
                $data->post_id = $request->post_id[$i];
                $data->level = $request->level[$i];
                $data->cgpa = $request->cgpa[$i];
                $data->price = $request->price[$i];
                $data->save();
            }
        }

        Toastr::success('Exco Forms Generated Successfully', 'Done');
        return redirect()->route('forms.index');
    }

    public function form_store_sra(Request $request,$id){



        $positionCount = count($request->type);
        if($positionCount != NULL){
            for ($i=0; $i < $positionCount; $i++){
                $data = new SRAForm();
                $data->election_id = $id;
                $data->type = $request->type[$i];
                $data->level = $request->level[$i];
                $data->cgpa = $request->cgpa[$i];
                $data->price = $request->price[$i];
                $data->save();
            }
        }

        Toastr::success('SRA Forms Generated Successfully', 'Done');
        return redirect()->route('forms.index');
    }

    public function onsale(){
        $data['elections'] = Election::all();

        return view('forms.onsale',$data);
    }

    public function contest(Request $request){

        $user_id = Auth::user()->id;
        $user = User::findorFail($user_id);
        $election = Election::findorFail($request->election_id);

        if(SRACandidates::where('election_id',$request->election_id)->where('user_id',$user_id)->first()){

            Toastr::error('You have Already Declared Interest for this Election', 'Not Allowed');
            return redirect()->route('onsale.index');
        }
        //if profile is updated
        if(FormCheck::where('user_id',$user_id)->first() == null){
            Toastr::error('Please Update your Profile First', 'Not Allowed');
            return redirect()->route('onsale.index');
        }
        //check faculty
            if($election->faculty != 'all'){
                if($election->faculty != $user->faculty_id){
                    Toastr::error('Your Faculty members are not allowed to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
                }
            }

            //check department
            if($election->department != 'all'){
                if($election->department != $user->department_id){
                    Toastr::error('Your Department members are not allowed to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
                }
            }
            //check state
            if($election->state != 'All'){
                if($election->state != $user->state){
                    Toastr::error('Your State members are not allowed to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
                }
            }

            //check lga
            if($election->lga != 'All'){
                if($election->lga != $user->lga){
                    Toastr::error('Your LGA members are not allowed to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
                }
            }

            //check form details

            $formcheck = Forms::where('election_id',$request->election_id)->where('post_id',$request->post_id)->first();
            //check Level
            if(Auth::user()->level < $formcheck->level){

                    Toastr::error('You do not meet the minimun level required to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
            }
            //check CGPA
            if(Auth::user()->cgpa < $formcheck->cgpa){

                    Toastr::error('You do not meet the minimun CGPA required to participate in this election', 'Not Allowed');
                    return redirect()->route('onsale.index');
            }


        $form = FormCheck::where('user_id',$user_id)->where('election_id',$request->election_id)->first();

        if($form){
            //throw error already bought
            Toastr::error('You have already declare interest for this election', 'Not Allowed');
            return redirect()->route('candidate.home');

        }else{

            $check = FormCheck::where('user_id',$user_id)->where('election_id','!=',0)->where('post_id','!=',0)->first();
            if($check){

                $form = new FormCheck();
                $form->user_id = $user_id;
                $form->profile = 1;
                $form->progress = 30;
                $form->election_id = $request->election_id;
                $form->post_id = $request->post_id;
                $form->save();
                Toastr::success('You have declared interest for this election successfully', 'Done');
                return redirect()->route('candidate.home');
            }else{

                $form = FormCheck::where('user_id',$user_id)->first();
                $form->election_id = $request->election_id;
                $form->post_id = $request->post_id;
                $form->progress = 30;
                $form->update();
                Toastr::success('You have declared interest for this election successfully', 'Done');
                return redirect()->route('candidate.home');

            }
        }
    }


    public function form_edit_exco($id){

        $check = Forms::where('election_id',$id)->get();

        if($check->count() < 1){
            Toastr::error('Forms not generated for this Election', 'Not Allowed');
            return redirect()->route('forms.index');
        }
        $data['elections'] = Election::all();
        $data['posts'] = Posts::all();
        $data['id'] = $id;
       return view('forms.edit',$data);
    }


    public function form_edit_sra($id){

        $check = SRAForm::where('election_id',$id)->get();

        if($check->count() < 1){
            Toastr::error('Forms not generated for this Election', 'Not Allowed');
            return redirect()->route('forms.index');
        }
        $data['elections'] = Election::all();
        $data['posts'] = Posts::all();
        $data['id'] = $id;
       return view('forms.sra_edit',$data);
    }


    public function form_update_exco(Request $request, $id){

        Forms::where('election_id',$id)->delete();

        $positionCount = count($request->post_id);
        if($positionCount != NULL){
            for ($i=0; $i < $positionCount; $i++){
                $data = new Forms();
                $data->election_id = $request->election_id;
                $data->start_date = $request->start_date;
                $data->end_date = $request->end_date;
                $data->post_id = $request->post_id[$i];
                $data->level = $request->level[$i];
                $data->cgpa = $request->cgpa[$i];
                $data->price = $request->price[$i];
                $data->save();
            }
        }

        Toastr::success('Form Updated Successfully', 'Done');
        return redirect()->route('forms.index');
    }

    public function form_update_sra(Request $request, $id){

        SRAForm::where('election_id',$id)->delete();

        $positionCount = count($request->type);
        if($positionCount != NULL){
            for ($i=0; $i < $positionCount; $i++){
                $data = new SRAForm();
                $data->election_id = $id;
                $data->type = $request->type[$i];
                $data->level = $request->level[$i];
                $data->cgpa = $request->cgpa[$i];
                $data->price = $request->price[$i];
                $data->save();
            }
        }

        Toastr::success('Form Updated Successfully', 'Don');
        return redirect()->route('forms.index');
    }


    public function delete_exco($id){

        if(Forms::where('election_id',$id)->delete()){

            Toastr::success('Form Deleted Successfully', 'Done');
            return redirect()->route('forms.index');
        }

        Toastr::error('Forms not generated for this Election', 'Not Allowed');
        return redirect()->route('forms.index');
    }


    public function delete_sra($id){

        if(SRAForm::where('election_id',$id)->delete()){

            Toastr::success('Form Deleted Successfully', 'Done');
            return redirect()->route('forms.index');
        }

        Toastr::error('Forms not generated for this Election', 'Not Allowed');
        return redirect()->route('forms.index');
    }



    public function contest_sra(Request $request){

        $user_id = Auth::user()->id;
        $user = User::findorFail($user_id);
        $election = Election::findorFail($request->election_id);

        //if profile is updated
        if(FormCheck::where('user_id',$user_id)->first() == null){
            Toastr::error('Please Update your Profile First', 'Not Allowed');
            return redirect()->route('candidate.home');
        }


        $exco = FormCheck::where('user_id',$user_id)->where('election_id',$request->election_id)->first();

        $sra = SRACandidates::where('user_id',$user_id)->where('election_id',$request->election_id)->first();

        if($exco){
            //throw error already bought
            Toastr::error('You have already declare interest for this election', 'Not Allowed');
            return redirect()->route('onsale.index');
        }

        if($sra){
            //throw error already bought
            Toastr::error('You have already declare interest for this election', 'Not Allowed');
            return redirect()->route('onsale.index');
        }


                $reg = explode("/", auth()->user()->reg_number);
                $fac =  $reg[0];
                $dept =  $reg[2];

                if($request->type == 'faculty'){

                    $form = new SRACandidates();
                    $form->user_id = $user_id;
                    $form->election_id = $request->election_id;
                    $form->type = 'faculty';
                    $form->code = $fac;
                    $form->faculty_id = $user->faculty_id;
                    $form->save();

                    $progress = FormCheck::where('user_id',Auth::user()->id)->latest()->first();
                    $progress->progress = 30;
                    $progress->update();

                    Toastr::success('You have declared interest for this election successfully', 'Done');
                    return redirect()->route('candidate.home');

                }


                if($request->type == 'department'){

                    $form = new SRACandidates();
                    $form->user_id = $user_id;
                    $form->election_id = $request->election_id;
                    $form->type = 'department';
                    $form->code = $dept;
                    $form->department_id = $user->department_id;
                    $form->save();


                    $progress = FormCheck::where('user_id',Auth::user()->id)->latest()->first();
                    $progress->progress = 30;
                    $progress->update();

                    Toastr::success('You have declared interest for this election successfully', 'Done');
                    return redirect()->route('candidate.home');

                }

                Toastr::error('Something went wrong', 'error');
                return redirect()->route('candidate.home');
    }


    public function my_interests(){

        $data['excos'] = FormCheck::where('user_id',Auth::user()->id)->where('post_id','!=',0)->get();
        $data['sras'] = SRACandidates::where('user_id',Auth::user()->id)->get();
        return view('users.my_interests',$data);
    }
}
