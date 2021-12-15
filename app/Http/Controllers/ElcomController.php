<?php

namespace App\Http\Controllers;

use App\Models\Elcom;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;


class ElcomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Elcom::all();
        return view('elcom.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elcom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Elcom();
        $data->name = $request->name;
        $data->save();

        Toastr::success('Election Committee Was Created Successfully', 'success');
        return redirect()->route('elcom.index');
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
        $data['editData'] = Elcom::findorfail($id);
        return view('elcom.create',$data);
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
        $data = Elcom::findorFail($id);
        $data->name = $request->name;
        $data->update();

        Toastr::success('Election Committee Edited Successfully', 'success');
        return redirect()->route('elcom.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Elcom::findorFail($id)->delete();
        Toastr::success('Election Committee Was Deleted Successfully', 'success');
        return redirect()->route('elcom.index');
    }
}
