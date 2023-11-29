<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        
        //session()->put('s','salom');
        $users = User::all();
        session()->put('users', $users);
        $user2 = User::find(2);
        $s = 5;
        //dd($user2->getChat(),$s);
        // $message = Message::where('sendeder_id', auth()->user()->id)
        // ->orwhere('receiver_id', auth()->user()->id)->get();
        return view('chat', compact('users'));
    }
    public function show($id)
    {
        $id = (int)$id;
        $user = User::find($id);
        //dd($user);
        session()->put('user',$user);
        $messages = Message::where('user_id', auth()->user()->id)->where('receiver_id', $id)
        ->orwhere('receiver_id', auth()->user()->id)->where('user_id', $id)->get();
        session()->put('messages', $messages);
        $confirmed = Message::where('receiver_id', auth()->user()->id)->where('user_id',  $id)->get();
        foreach ($confirmed->where('confirmed',false) as $message){
            $message->confirmed = true;
            $message->save();
        }
        $users= session('users');
        // dump($users);
        // dd($users);
        return view('chats.show',['messages'=>$messages, 'show'=>$user, 'users'=>$users]);
    }
    public function store(Request $request){
        
        $validate = $request->validate([
            'send' => 'required',
        ]);
        $send_user = auth()->user()->id; 
        $recive_user = (int) $request->user; 
        $chat = Chat::create([
            'send_id' => $send_user,
            'user_id' => $recive_user,
        ]);
        $chat_id = Chat::max('id');
        $message = Message::create([
            'message' =>$request->send,
            'user_id' => $send_user,
            'receiver_id' => $recive_user,
            'chat_id' => $chat_id,
            'confirmed' => false,
        ]);
        return redirect()->back();
        //return return redirect()->back()->withErrors($validator)->withInput();
    }
    public function edit($id)
    {        
        // $id =$this->chat($id);
        $users=session('users');
        $messages = session('messages');
        $message = Message::find((int)$id);
        return view('chats.edit',['edit_message'=>$message, 'show'=>session('user'), 'users'=>$users, 'messages'=>$messages]);
    }
    public function update(Request $request, Message $message)
    {
        $validated =  $request->validate(['send'=> 'required']);
        //dd($validated['send']);
        $message->update(['message'=>$validated['send']]);
        return $this->show($message->receiver_id);


    }
    public function destroy($id){
        dd($id);
        $id = (int)$id;
        $message = Message::find($id);
        $message->delete();
        return redirect()->back();
    }
public function chat($id)
    {
        return (int)$id;
    }
}