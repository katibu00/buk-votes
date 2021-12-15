<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){

        $data['messages'] = Message::all();
        return view('messages.index',$data);
    }


    public function send(Request $request){


        $data = new Message();
        $data->message = $request->message;
        $data->contact = $request->contact;
        $data->save();

        Toastr::success('Message Sent Successfully', 'success');
        return redirect()->route('home');
    }


    public function delete()
    {
        Message::truncate();
        Toastr::success('Messages Deleted Successfully', 'success');
        return redirect()->route('message.index');
    }
}
