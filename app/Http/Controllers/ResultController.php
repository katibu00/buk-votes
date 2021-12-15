<?php

namespace App\Http\Controllers;

use App\Models\AssignDepartment;
use App\Models\Cast;
use App\Models\CheckCast;
use App\Models\Election;
use App\Models\FormCheck;
use App\Models\SRAVotes;
use App\Models\VoterAuth;
use App\Models\Settings;
use App\Models\Winner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class ResultController extends Controller
{
    public function live(Request $request){

        if(Auth::user()->role == 'voter'){

            $checkauth = VoterAuth::where('user_id',Auth::user()->id)->first();
            if($checkauth == null || $checkauth->verified == 0){

                Toastr::error('Please authenticate yourself first.', 'Not Allowed');
                return redirect()->route('voter.home');
            }
        }

        if(Auth::user()->role != 'sa'){
            $settings = Settings::findorFail(1); 
            if($settings->live != 'on'){
                Toastr::error('Live Result Not Allowed', 'Not Allowed');
                if(Auth::user()->role == 'candidate'){
                    return redirect()->route('candidate.home');
                }else{
                    return redirect()->route('voter.home');
                }
            }
        }




        $data['electionss'] = Election::all();
        $data['election'] = Election::where('id',$request->election_id)->first();

        if($request->election_id){

        $votes = Cast::where('election_id',$request->election_id)->first();
        if($votes == null){
                Toastr::error('No Votes Casted for the selected election Yet', 'Not Allowed');
                if(Auth::user()->role == 'voter'){
                    return redirect()->route('voter.home');
                }elseif(Auth::user()->role == 'candidate'){
                    return redirect()->route('candidate.home');
                }else{



                    return redirect()->route('live.result');
                }

            }

            $checkcast = CheckCast::where('user_id',Auth::user()->id)->where('election_id',$request->election_id)->first();

            if(Auth::user()->role != 'sa'){

                if(!$checkcast){

                    Toastr::error('Please cast your vote first before checking live result.', 'Not Allowed');
                    if(Auth::user()->role == 'voter'){
                        return redirect()->route('voter.home');

                    }else{
                        return redirect()->route('candidate.home');

                    }
                }
            }

        }


        return view('result.live',$data);
    }

    //election return
    public function return_exco(Request $request){



        if($request->election_id){
            $checkvotes = Cast::where('election_id',$request->election_id)->get()->count();
            if($checkvotes == 0){

                Toastr::error('No vote casted for the selected election.', 'Not Allowed');
                return redirect()->route('return.exco');
            }

            $data['electionss'] = Election::all();
            $data['election'] = Election::where('id',$request->election_id)->first();
            return view('result.report',$data);

            }


        $data['election'] = Election::where('id',$request->election_id)->first();
        $data['electionss'] = Election::all();
        return view('result.report',$data);




    }

    public function return_sra(Request $request){

        if($request->election_id){

            $checkvotes = SRAVotes::where('election_id',$request->election_id)->get()->count();
            if($checkvotes == 0){

                Toastr::error('No vote was casted for the selected election.', 'Not Allowed');
                return redirect()->route('return.sra');
            }

            $data['electionss'] = Election::all();
            $data['election'] = Election::where('id',$request->election_id)->first();

            if($data['election']->sra == 'none'){

                Toastr::error('SRA not Assigned for the selected election.', 'Not Allowed');
                return redirect()->route('return.sra');
            }

            $data['faculties'] = AssignDepartment::select('faculty_id')->groupBy('faculty_id')->get();
            return view('result.return_sra',$data);;

            }
       $data['election'] = Election::where('id',$request->election_id)->first();
        $data['electionss'] = Election::all();
        $data['faculties'] = AssignDepartment::select('faculty_id')->groupBy('faculty_id')->get();
        return view('result.return_sra',$data);
    }

    public function return_exco_store(Request $request){

        $check = Winner::where('election_id',$request->election_id)->where('post_id',$request->post_id)->get();
        if($check->count() > 0){

            Toastr::error('Winner for this post already declared.', 'warning');
            return redirect()->route('return.exco');
        }

       $data = new Winner();
       $data->election_id = $request->election_id;
       $data->type = 'exco';
       $data->post_id = $request->post_id;
       $data->contestant_id = $request->contestant_id;
       $data->save();

       Toastr::success('candidate Declared Winner and Issued Certificate Successfully.', 'Declared Winner');
       return redirect()->route('return.exco');
    }


    public function return_sra_store(Request $request){

        $check = Winner::where('election_id',$request->election_id)->where('type','sra')->where('code',$request->code)->get();
        if($check->count() > 0){

            Toastr::error('Winner for this post already declared.', 'warning');
            return redirect()->route('return.sra');
        }

       $data = new Winner();
       $data->election_id = $request->election_id;
       $data->type = $request->type;
       $data->code = $request->code;
       $data->contestant_id = $request->contestant_id;
       $data->save();

       Toastr::success('candidate Declared Winner and Issued Certificate Successfully.', 'Declared Winner');
       return redirect()->route('return.sra');
    }


    public function certificate_index(){

        $data['wins'] = Winner::where('contestant_id',Auth::user()->id)->get();
        return view('result.certificate_index',$data);
    }


    public function certificate_download(){

        $pdf = PDF::loadView('pdfs.certificate_exco_return');
        $pdf->setPaper('A4', 'landscape');
        // return view('pdfs.certificate_exco_return');

        return $pdf->stream('Testimonial.pdf');

    }



    public function livesra(Request $request){

        if($request->election_id){

            $checkvotes = SRAVotes::where('election_id',$request->election_id)->get()->count();
            if($checkvotes == 0){

                Toastr::error('No vote was casted for the selected election.', 'Not Allowed');
                return redirect()->route('live.result.sra');
            }

            $data['electionss'] = Election::all();
            $data['election'] = Election::where('id',$request->election_id)->first();

            if($data['election']->sra == 'none'){

                Toastr::error('SRA not Assigned for the selected election.', 'Not Allowed');
                return redirect()->route('live.result.sra');
            }

            $data['faculties'] = AssignDepartment::select('faculty_id')->groupBy('faculty_id')->get();
            return view('result.live_sra',$data);;

            }
       $data['election'] = Election::where('id',$request->election_id)->first();
        $data['electionss'] = Election::all();
        $data['faculties'] = AssignDepartment::select('faculty_id')->groupBy('faculty_id')->get();
        return view('result.live_sra',$data);
    }
}
