<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRespository;
use App\Message\MessageRespository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRespository $user,MessageRespository $message)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = $this->user->getAllUserWithoutSelf();

        return view('home',compact('users'));
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
      //reset if message is read
      $this->message->readMessages($user_id);

      //get selected user's messages
      $messages = $this->message->getUserMessages($user_id);

      return view('message.index',compact('messages'));
    }
}
