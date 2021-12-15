<?php

namespace App\Http\Controllers;

use App\Mail\SendCode;
use App\Models\VoterAuth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class AuthenticationController extends Controller
{
    public function send(Request $request)
    {
        //email
        if ($request->verify == 'email') {
            dd("disabled");
            $code = random_int(100000, 999999);
            // $email = Auth::user()->email;
            $email = 'ukmisau@gmail.com';

            $data = array(
                'code' => $code,
            );

            $shortcheck = VoterAuth::where('user_id', Auth::user()->id)->where('method', 'email')->whereBetween('updated_at', array(Carbon::now()->subMinutes(5)->toDateTimeString(), Carbon::now()->toDateTimeString()))->first();

            if ($shortcheck) {

                if ($shortcheck->verified == 1) {

                    Toastr::warning('You have already verified your account', 'Not Allowed');
                    return redirect()->route('voter.home');
                }

                // if($shortcheck->attempt >= 1){

                //     Toastr::warning('Too many attempt. Please try again after some time', 'warning');
                //     return redirect()->route('voter.home');
                // }

            }

            $mediumcheck = VoterAuth::where('user_id', Auth::user()->id)->where('method', 'email')->whereBetween('updated_at', array(Carbon::now()->subMinutes(50)->toDateTimeString(), Carbon::now()->toDateTimeString()))->first();

            if (@$mediumcheck->attempt >= 5) {

                Toastr::warning('Too many attempt. Please try again after some time', 'Not Allowed');
                return redirect()->route('voter.home');
            }
            // dd($email);

            Mail::to($email)->send(new SendCode($data));

            if (count(Mail::failures()) > 0) {

                Toastr::error('Error Occured', 'error');
                return redirect()->route('voter.home');

            } else {

                $longcheck = VoterAuth::where('user_id', Auth::user()->id)->first();

                if ($longcheck) {

                    $longcheck->code = $code;
                    $longcheck->attempt = $longcheck->attempt + 1;
                    $longcheck->update();

                    Toastr::success('Verification Code Sent Successfully. Click on Authenticate again and input the code.', 'Done');
                    return redirect()->route('voter.home');

                } else {
                    $data = new VoterAuth();
                    $data->user_id = Auth::user()->id;
                    $data->method = 'email';
                    $data->code = $code;
                    $data->attempt = 1;
                    $data->save();

                    Toastr::success('Verification Code Sent Successfully', 'Done');
                    return redirect()->route('voter.home');
                }

            }

        }

        //phone

        if ($request->verify == 'phone') {


            $code = random_int(100000, 999999);
          
            $phone = Auth::user()->phone;

            if(strlen($phone) <= 11){
                $phone = '+234'.$phone;
            }
          

            $data = array(
                'code' => $code,
            );

            $shortcheck = VoterAuth::where('user_id', Auth::user()->id)->where('method', 'phone')->whereBetween('updated_at', array(Carbon::now()->subMinutes(5)->toDateTimeString(), Carbon::now()->toDateTimeString()))->first();

            if ($shortcheck) {

                if ($shortcheck->verified == 1) {

                    Toastr::warning('You have already verified your account', 'Not Allowed');
                    return redirect()->route('voter.home');
                }

                // if($shortcheck->attempt >= 5){

                //     Toastr::warning('Too many attempt. Please contact admin', 'warning');
                //     return redirect()->route('voter.home');
                // }

            }

            $mediumcheck = VoterAuth::where('user_id', Auth::user()->id)->where('method', 'phone')->whereBetween('updated_at', array(Carbon::now()->subMinutes(50)->toDateTimeString(), Carbon::now()->toDateTimeString()))->first();

            if (@$mediumcheck->attempt >= 3) {

                Toastr::warning('Too many attempt. Please try again after some time', 'Not Allowed');
                return redirect()->route('voter.home');
            }
           //send SMS STARTS
            $to = $phone;
           
            $message = "Your code is $code. Dont share this with anyone. Click on authenticate and provide this code in the space provided.";


            //open connection
   

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.smartsmssolutions.com/io/api/client/v1/smsotp/send/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('token' => 'ZwF5tQ6UEexf0QZnriE8ziFcz04B57EVBJJBpKpnWShvlac2zA','phone' => $phone,'otp' => $code,'sender' => 'OTP NG','template_code' => '7153792424','ref_id' => '55'),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $data = json_decode($response);
           

            if ($data->success != 'true') {

                Toastr::error('Error Occured.', 'error');
                return redirect()->route('voter.home');

            } else {

                $longcheck = VoterAuth::where('user_id', Auth::user()->id)->first();

                if ($longcheck) {

                    $longcheck->code = $code;
                    $longcheck->attempt = $longcheck->attempt + 1;
                    $longcheck->update();

                    Toastr::success('Verification Code Sent Successfully. Click on Authenticate again and input the OTP sent.', 'Done');
                    return redirect()->route('voter.home');

                } else {
                    $data = new VoterAuth();
                    $data->user_id = Auth::user()->id;
                    $data->method = 'phone';
                    $data->code = $code;
                    $data->attempt = 1;
                    $data->save();

                    Toastr::success('Verification Code Sent Successfully', 'Done');
                    return redirect()->route('voter.home');
                }

            }


        }
    }

    //verify code

    public function verify(Request $request)
    {

        $input = $request->code;
        $query = VoterAuth::where('user_id', Auth::user()->id)->where('verified', 0)->first();
        $code = $query->code;

        if ($input == $code) {

            $query->verified = true;
            $query->update();

            Toastr::success('You are Verified Successfully', 'Done');
            return redirect()->route('voter.home');
        } else {

            Toastr::error('Wrong or Expired Code', 'Error');
            return redirect()->route('voter.home');
        }

    }
}
