<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Settings;



class SettingsController extends Controller
{
    public function save(Request $request){

        $settings = Settings::FindorFail(1);
        $settings->phone = $request->phone;
        $settings->email = $request->email;
        $settings->commission = $request->commission;
        $settings->frontend = $request->frontend;
        $settings->live = $request->live;
        $settings->force = $request->force;
        $settings->certificate = $request->certificate;
        $settings->update();

        Toastr::success('Settings Updated Successfully', 'Done');
        return redirect()->back();
    }
}
