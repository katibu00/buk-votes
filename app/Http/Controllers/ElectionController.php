<?php

namespace App\Http\Controllers;

use App\Models\Associations;
use App\Models\Clubs;
use App\Models\Department;
use App\Models\Elcom;
use App\Models\Election;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['elections'] = Election::get();
        return view('election.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['faculties'] = Faculty::all();
        $data['departments'] = Department::all();
        $data['clubs'] = Clubs::all();
        $data['elcoms'] = Elcom::all();
        $data['associations'] = Associations::all();
        return view('election.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Election();
        $data->title = $request->title;
        $data->elcom_id = $request->elcom;
        $data->sra = $request->sra;
        $data->start_date = $request->start_date;
        $data->start_time = $request->start_time;
        $data->end_date = $request->end_date;
        $data->end_time = $request->end_time;
        $data->faculty = $request->faculty;
        $data->department = $request->department;
        $data->state = $request->state;
        $data->lga = $request->lga;
        $data->account_name = $request->account_name;
        $data->account_number = $request->account_number;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();

        Toastr::success('Election was Created Successfully', 'Done');
        return redirect()->route('election.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['faculties'] = Faculty::all();
        $data['departments'] = Department::all();
        $data['elcoms'] = Elcom::all();
        $data['editData'] = Election::findorFail($id);
        return view('election.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = Election::findorFail($id);
        $data->title = $request->title;
        $data->elcom_id = $request->elcom;
        $data->sra = $request->sra;
        $data->start_date = $request->start_date;
        $data->start_time = $request->start_time;
        $data->end_date = $request->end_date;
        $data->end_time = $request->end_time;
        $data->faculty = $request->faculty;
        $data->department = $request->department;
        $data->state = $request->state;
        $data->lga = $request->lga;
        $data->account_name = $request->account_name;
        $data->account_number = $request->account_number;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->update();

        Toastr::success('Election was Updated Successfully', 'Done');
        return redirect()->route('election.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Election::findorfail($id)->delete();
        Toastr::success('Election was Deleted Successfully', 'Done');
        return redirect()->route('election.index');
    }
}
