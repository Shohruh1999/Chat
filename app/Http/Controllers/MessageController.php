<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public  function index(){
        $users = User::all();
        // $message = Message::where('sendeder_id', auth()->user()->id)
        // ->orwhere('receiver_id', auth()->user()->id)->get();
        return view('chat', compact('users'));
    }
    //
}
