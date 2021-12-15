<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AssignDepartment;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Settings;
use App\Models\FormCheck;
use App\Models\SRACandidates;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{
    public function department_index(){
        $data['datas'] = AssignDepartment::select('faculty_id')->groupBy('faculty_id')->get();
        return view('settings.assign_departments.index',$data);
    }

    public function department_create(){
        $data['faculties'] = Faculty::all();
        $data['departments'] = Department::all();
        return view('settings.assign_departments.create',$data);
    }

    public function department_reset($id){

        AssignDepartment::where('faculty_id',$id)->delete();

        Toastr::success('Department Assignment Reset Successfully', 'success');
        return redirect()->route('assign.index');
    }

    public function department_store(Request $request){

        $departmentCount = count($request->department_id);
        if($departmentCount != NULL){
            for ($i=0; $i < $departmentCount; $i++){
                $data = new AssignDepartment();
                $data->faculty_id = $request->faculty_id;
                $data->department_id = $request->department_id[$i];
                $data->save();
            }
        }

        Toastr::success('Departments Assigned Successfully', 'success');
        return redirect()->route('assign.index');
    }

    public function preference(){
        $data['settings'] = Settings::findorFail(1);
       return view('settings.preference',$data);
    }

    public function deposit_index(){
        return view('forms.deposit');
     }

     public function deposit_generate(){

        $exco = FormCheck::where('user_id',Auth::user()->id)->where('payment',0)->where('election_id','!=',0)->where('election_id','!=',null)->first();
        $sra = SRACandidates::where('user_id',Auth::user()->id)->where('payment',0)->first(); 

        if(!$exco && !$sra){

            Toastr::error('You have no Unpaid Invoice.', 'Not Allowed');

            return redirect()->route('candidate.home');

        }


    $pdf = PDF::loadView('pdfs.deposit');
    return $pdf->stream('Deposit Slip.pdf');

     }


    public function election_form(){

        return view('forms.election_form');

     }

     public function election_generate(){


    $pdf = PDF::loadView('pdfs.election_form');
    return $pdf->stream('Offline Election Request Form.pdf');

     }

     public function getDept(Request $request)
     {

         $allData = AssignDepartment::with(['department'])->where('faculty_id', $request->faculty)->get();

         return response()->json($allData);
     }

}
