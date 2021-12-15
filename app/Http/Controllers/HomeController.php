<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\FormCheck;
use App\Models\SRACandidates;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



class HomeController extends Controller
{
    public function admin()
    {

        $data['sum'] = FormCheck::where('payment',1)->whereNotNull('amount')->sum('amount');
        $data['sum2'] = SRACandidates::whereNotNull('amount')->sum('amount'); 
        $data['interests'] = FormCheck::all()->count();
        $data['interest_sra'] = SRACandidates::all()->count();
        $data['paid'] = FormCheck::where('payment',1)->get()->count();
        $data['paid_sra'] = SRACandidates::where('payment',1)->get()->count();
        $data['voters'] = User::where('role','voter')->get()->count();
        $data['candidates'] = User::where('role','candidate')->get()->count();
        $data['sa'] = User::where('role','sa')->get()->count();
        $data['elcoms'] = User::where('role','elcom')->get()->count();
        return view('home',$data);
    }

    public function elcom()
    {
        $data['sum'] = FormCheck::where('election_id',auth()->user()->elcom_id)->whereNotNull('amount')->sum('amount');
        $data['sum2'] = SRACandidates::where('election_id',auth()->user()->elcom_id)->whereNotNull('amount')->sum('amount');
        $data['interests'] = FormCheck::where('election_id',auth()->user()->elcom_id)->get()->count();
        $data['interest_sra'] = SRACandidates::where('election_id',auth()->user()->elcom_id)->get()->count();
        $data['paid'] = FormCheck::where('election_id',auth()->user()->elcom_id)->where('payment',1)->get()->count();
        $data['paid_sra'] = SRACandidates::where('election_id',auth()->user()->elcom_id)->where('payment',1)->get()->count();
        return view('elcom',$data);
    }

    public function candidate()
    {
        $data['check'] = FormCheck::where('user_id',Auth::user()->id)->latest()->first();
        return view('contestant',$data);
    }

    public function voter()
    {
        return view('voter_home');
    }
    public function voterAlert()
    {
        Alert::info(auth()->user()->first_name.' '.auth()->user()->middle_name.' '.auth()->user()->last_name, 'You are welcome to BUK eVotes. Please authenticate yourself to continue.')->timerProgressBar()->autoClose(100000);
        return view('voter_home');
    }
}
