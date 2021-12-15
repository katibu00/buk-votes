<?php

namespace App\Http\Controllers;

use App\Models\Associations;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Associations::all();
        return view('associations.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('associations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Associations();
        $data->name = $request->name;
        $data->save();

        Toastr::success('Association Was Created Successfully', 'Done');
        return redirect()->route('associations.index');
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
        $data['editData'] = Associations::findorfail($id);
        return view('associations.create',$data);
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
        $data = Associations::findorFail($id);
        $data->name = $request->name;
        $data->update();

        Toastr::success('Association Edited Successfully', 'Done');
        return redirect()->route('associations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Associations::findorFail($id)->delete();
        Toastr::success('Association Was Deleted Successfully', 'Done');
        return redirect()->route('associations.index');
    }
}
