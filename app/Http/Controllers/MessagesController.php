<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['messages'] = \Auth::user()->messages()->where('read',false)->orderBy('id','desc')->get();
        return view('messages.index',$data);
    }

    public function create()
    {
        $data['users'] = User::all();
        return view('messages.create',$data);
    }

    public function store(Request $request)
    {
        $message = new Message([
            "from_id"=>\Auth::id(),
            "to_id"=>$request->to,
            "info"=>$request->info,
        ]);
        if($message->save()){
            $request->session()->flash('status', 'alert-success');
        }
        else{
            $request->session()->flash('status', 'alert-danger');
        }
        return redirect()->back();        
    }

    public function show($id)
    {
        $data['message'] = Message::findOrFail($id);
        return view('messages.show',$data);
    }
}
