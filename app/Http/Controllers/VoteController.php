<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\CheckCast;
use App\Models\Department;
use App\Models\Election;
use App\Models\Faculty;
use App\Models\FormCheck;
use App\Models\Forms;
use App\Models\Settings;
use App\Models\SRACandidates;
use App\Models\SRAVotes;
use App\Models\VoterAuth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index(Request $request){

        if(Auth::user()->role == 'voter'){

            $checkauth = VoterAuth::where('user_id',Auth::user()->id)->first();
            if($checkauth == null || $checkauth->verified == 0){

                Toastr::error('Please authenticate yourself first.', 'warning');
                return redirect()->route('voter.home');
            }
        }



        $reg = explode("/", auth()->user()->reg_number);
        $fac =  $reg[0];
        $dept =  $reg[2];

        $data['election'] = Election::where('id',$request->election_id)->first();
        $election =  $data['election'];
        $user = Auth::user();

        if($request->election_id){


            if($election->faculty != 'all'){

                $faculty = Faculty::where('code',$fac)->first();

                if($election->faculty != $faculty->id){
                    Toastr::error('Your Faculty members are not allowed to participate in this election', 'Not Allowed');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
            }

            //check department
            if($election->department != 'all'){

                $department = Department::where('code',$dept)->first();

                if($election->department != $department->id){
                    Toastr::error('Your Department members are not allowed to participate in this election', 'Not Allowed');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
            }
            //check state
            if($election->state != 'All'){
                if($election->state != $user->state){
                    Toastr::error('Your State members are not allowed to participate in this election', 'Not Allowed');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
            }

             //check lga
             if($election->lga != 'All'){
                if($election->lga != $user->lga){
                    Toastr::error('Your LGA members are not allowed to participate in this election', 'Not Allowed');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
            }

            //Time Check
                $start_date = Carbon::createFromFormat('Y-m-d', @$data['election']->start_date);
                $start_time = Carbon::createFromFormat('H:i:s', @$data['election']->start_time);
                $end_date = Carbon::createFromFormat('Y-m-d', @$data['election']->end_date);
                $end_time = Carbon::createFromFormat('H:i:s', @$data['election']->end_time);

                $today_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
                $current_time = Carbon::createFromFormat('H:i:s', date('H:i:s'));

                //date before
                if($today_date->lt($start_date)){

                    Toastr::error('There is still days to the election.', 'warning');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }

                }
                //date after
                if($today_date->gt($end_date)){

                    Toastr::error('The Election date has passed.', 'warning');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
                //time before
                if($current_time->lt($start_time)){

                    Toastr::error('There is still time remaining to the election', 'warning');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }
                //time before
                if($current_time->gt($end_time)){

                    Toastr::error('The election time has elapsed', 'warning');
                    if(Auth::user()->role == 'candidate'){
                        return redirect()->route('candidate.home');
                    }else{
                        return redirect()->route('voter.home');
                    }
                }

                //if contestant has made any payment as exco or sra

                // if(Auth::user()->role == 'candidate'){

                //     $exco = FormCheck::where('user_id',Auth::user()->id)->where('payment',1)->first();
                //     $sra = SRACandidates::where('user_id',Auth::user()->id)->where('payment',1)->first();

                //     if(!$exco && !$sra){
                //         Toastr::error('You cannot cast vote if you have not made any payment.', 'Not Allowed');
                //         return redirect()->route('candidate.home');
                //     }


                // }
                //if already voted
                $checkcast = CheckCast::where('user_id',Auth::user()->id)->where('election_id',$request->election_id)->first();
                if($checkcast){

                    Toastr::error('You have already voted for this election.', 'warning');
                    if(Auth::user()->role == 'voter'){
                        return redirect()->route('voter.home');

                    }else{
                        return redirect()->route('candidate.home');

                    }
                }
        }

        $data['electionss'] = Election::all();
        $data['settings'] = Settings::findorFail(1);
        return view('cast.index',$data);
    }



    public function submit(Request $request){

        $checkcast = CheckCast::where('user_id',Auth::user()->id)->where('election_id',$request->election_id)->first();
        if($checkcast){

            Toastr::error('You have already voted for this election.', 'warning');
            if(Auth::user()->role == 'voter'){
                return redirect()->route('voter.home');

            }else{
                return redirect()->route('candidate.home');

            }
        }




        $posts = Forms::where('election_id',1)->get();

        $postsCount = count($posts);
        if($postsCount != NULL){
            for ($i=0; $i < $postsCount; $i++){


                $data = new Cast();
                $contestant_id = 'contestant_id' . $i;
                $data->user_id = Auth::user()->id;
                $data->post_id = $posts[$i]->post_id;
                $data->election_id = $request->election_id;
                $data->contestant_id = $request->$contestant_id;
                $data->save();

                if($request->departmental.$i){
                    $departmental = 'departmental' . $i;
                    $data = new SRAVotes();
                    $data->user_id = Auth::user()->id;
                    $data->election_id = $request->election_id;
                    $data->type = 'department';
                    $data->code = $request->code1;
                    $data->contestant_id = $request->$departmental;
                    $data->save();
                }

                if($request->faculty.$i){
                    $faculty = 'faculty' . $i;
                    $data = new SRAVotes();
                    $data->user_id = Auth::user()->id;
                    $data->election_id = $request->election_id;
                    $data->type = 'faculty';
                    $data->code = $request->code;
                    $data->contestant_id = $request->$faculty;
                    $data->save();
                }
            }
        }

        $checkvote = new CheckCast();
        $checkvote->user_id = Auth::user()->id;
        $checkvote->election_id = $request->election_id;
        $checkvote->save();

        Toastr::success('You have Casted  Your Vote Successfully', 'success');
        if(Auth::user()->role == 'voter'){
            return redirect()->route('voter.home');

        }else{
            return redirect()->route('candidate.home');

        }

    }


}
