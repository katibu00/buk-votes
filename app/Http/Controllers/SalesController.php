<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\FormCheck;
use App\Models\SRACandidates;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {

        if(auth()->user()->role =='elcom'){

            $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
        }else{
            $data['elections'] = Election::all();
        }

        return view('forms.sales', $data);
    }

    public function search(Request $request)
    {

        if(auth()->user()->role =='elcom'){

            $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
        }else{
            $data['elections'] = Election::all();
        }
        $data['result'] = Election::where('id', $request->election_id)->first();
        return view('forms.sales', $data);
    }

    public function payment_exco(Request $request)
    {


        $check = FormCheck::where('user_id', $request->contestant_id)->where('election_id', $request->election_id)->where('post_id', $request->post_id)->where('payment',1)->first();

        if($check){

            Toastr::error('Contestant Already Marked as paid.', 'Not Allowed');
            return redirect()->route('sales.index');
        }


        $user = FormCheck::where('user_id', $request->contestant_id)->where('election_id', $request->election_id)->where('post_id', $request->post_id)->first();

        if ($user) {

            $user->payment = true;
            $user->amount = $request->amount;
            $user->progress = 70;
            $user->payment_id = Auth::user()->id;
            $user->update();

            Toastr::success('Constestant Marked Paid successfully.', 'Done');

                  if(auth()->user()->role =='elcom'){

                        $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
                    }else{
                        $data['elections'] = Election::all();
                    }
                      return redirect()->route('sales.index');;
                    } else {

            Toastr::error('No Match Found.', 'Error');
            return redirect()->route('sales.index');
        }
    }


    public function payment_sra(Request $request)
    {
        // dd($request->all());

        $user = SRACandidates::where('user_id', $request->user_id)->where('election_id', $request->election_id)->where('type', $request->type)->first();

        if($user->payment == 1){

            Toastr::error('Contestant Already Marked as paid.', 'Not Allowed');
            return redirect()->route('sales.index');
        }

        if ($user) {

            $user->payment = true;
            $user->amount = $request->amount;
            $user->payment_id = Auth::user()->id;
            $user->update();

            $check = FormCheck::where('user_id', $request->user_id)->where('election_id', $request->election_id)->latest()->first();
            if($check){
                $check->progress = 70;
                $check->update();
            }else{

                $check = new FormCheck();
                $check->user_id = $request->user_id;
                $check->election_id = $request->election_id;
                $check->progress = 70;
                $check->profile = 1;
                $check->save();
            }
           


            Toastr::success('Constestant Marked Paid successfully.', 'Done');
            if(auth()->user()->role =='elcom'){

                $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
            }else{
                $data['elections'] = Election::all();
            }

            return view('forms.sales', $data);
        } else {

            Toastr::error('No Match Found.', 'warning');
            return redirect()->route('sales.index');
        }
    }


    public function qualify_exco(Request $request)
    {
        // dd($request->all());

        $user = FormCheck::where('user_id', $request->contestant_id)->where('election_id', $request->election_id)->where('post_id', $request->post_id)->first();

        if ($user) {

            if($user->payment == 0){

                Toastr::error('Candidate has not paid yet.', 'Not Allowed');
                return redirect()->route('sales.index');
            }

            $user->qualify = true;
            $user->progress = 100;
            $user->qualify_id = Auth::user()->id;
            $user->update();

            Toastr::success('Constestant Qualified successfully.', 'Done');

            if(auth()->user()->role =='elcom'){

                            $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
                        }else{

                            $data['elections'] = Election::all();
                }
            return redirect()->route('sales.index');
        } else {

            Toastr::error('No Match Found.', 'warning');
            return redirect()->route('sales.index');
        }
    }

    public function qualify_sra(Request $request)
    {
        // dd($request->all());

        $user = SRACandidates::where('user_id', $request->user_id)->where('election_id', $request->election_id)->where('type', $request->type)->first();

        if ($user) {

            if($user->payment == 0){

                Toastr::error('Candidate has not paid yet.', 'Not Allowed');
                return redirect()->route('sales.index');
            }
            $user->qualify = true;
            $user->qualify_id = Auth::user()->id;
            $user->update();

            $check = FormCheck::where('user_id', $request->user_id)->where('election_id', $request->election_id)->latest()->first();
            if($check){
                $check->progress = 100;
                $check->update();
            }else{

                $check = new FormCheck();
                $check->user_id = $request->user_id;
                $check->election_id = $request->election_id;
                $check->progress = 100;
                $check->profile = 1;
                $check->save();
            }

            Toastr::success('Constestant Qualified successfully.', 'Done');
            if(auth()->user()->role =='elcom'){

                $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
            }else{
                $data['elections'] = Election::all();
            }
            return redirect()->route('sales.index');
        } else {

            Toastr::error('No Match Found.', 'warning');
            return redirect()->route('sales.index');
        }
    }
}
