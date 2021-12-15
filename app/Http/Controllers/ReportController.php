<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales_index(){

        if(auth()->user()->role =='elcom'){

            $data['elections'] = Election::where('id',auth()->user()->elcom_id)->get();
        }else{
            $data['elections'] = Election::all();
        }
        return view('report.sales',$data);
    }

    public function sales_generate(Request $request){

    $election = Election::where('id',$request->election_id)->first();
    $pdf = PDF::loadView('pdfs.sales',compact('election'));
    return $pdf->stream('Sales Report.pdf');

    }
}
