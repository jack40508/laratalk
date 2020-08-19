<?php

namespace App\Message;

use Illuminate\Http\Request;
use Auth;
use App\Message\Message;

class MessageRespository
{
  public function __construct(Message $message)
  {
    $this->message = $message;
  }

  public function getAllMessages(){
    return $this->message->get();
  }

  public function sendMessage($request){
    $from = Auth::id();
    $to = 0;
    $message = $request->message;

    $data = new Message();
    $data->from_id = $from;
    $data->to_id = $to;
    $data->message = $message;
    $data->save();

    return $data;
  }

  public function getMessage($message){
    $from = 0;
    $to = Auth::id();

    $data = new Message();
    $data->from_id = $from;
    $data->to_id = $to;
    $data->message = $message;
    $data->save();

    return $data;
  }
}
