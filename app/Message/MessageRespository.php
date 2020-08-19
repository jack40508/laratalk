<?php

namespace App\Message;

use Illuminate\Http\Request;
use Auth;
use App\Message\Message;
use GuzzleHttp\Client;

class MessageRespository
{
  public function __construct(Message $message)
  {
    $this->message = $message;
  }

  public function getAllMessages(){
    return $this->message->get();
  }

  public function getUserMessages($user_id){

    $messages = $this->message->where(function ($query) use ($user_id){
                                        $query->where('from_id',Auth::id())
                                              ->where('to_id',$user_id);
                                      })->orwhere(function ($query) use ($user_id){
                                                    $query->where('from_id',$user_id)
                                                          ->where('to_id',Auth::id());
                                                        })->get();
    return $messages;
  }

  public function sendMessage($request){
    $from = Auth::id();
    $to = $request->receiver_id;
    $message = $request->message;

    $data = new Message();
    $data->from_id = $from;
    $data->to_id = $to;
    $data->message = $message;
    $data->is_read = false;
    $data->save();

    return $data;
  }

  public function postTalkMessage($message){
    $from = 0;
    $to = Auth::id();

    $data = new Message();
    $data->from_id = $from;
    $data->to_id = $to;
    $data->message = $message;
    $data->is_read = false;
    $data->save();

    return $data;
  }

  public function getTalkMessage($message){
    //Get Message from Talk
    $client = new Client();
    $res = $client->request('POST', 'https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk', [
        'form_params' => [
            'apikey' => 'DZZpEiJNTW1sSsQ7B8MkLb2Hk5UJFPj3',
            'query' => $message->message,
        ]
    ]);

    $result = json_decode($res->getBody()->getContents(), true);
    $talkmessage = $result['results'][0]['reply'];

    $message->is_read = true;
    $message->save();

    return $talkmessage;
  }

  public function readMessages($user_id){
    $this->message->where('from_id',$user_id)->where('to_id',Auth::id())->update(['is_read' => true]);
  }
}
