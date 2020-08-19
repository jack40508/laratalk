<?php

namespace App\Http\Controllers;

use App\Message\Message;
use App\Message\MessageRespository;
use Illuminate\Http\Request;
use App\Events\MessagePosted;
use Auth;
use Pusher\Pusher;

class MessageController extends Controller
{
    public function __construct(MessageRespository $message)
    {
        $this->middleware('auth');
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $messages = $this->message->getAllMessages();

        return $messages;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $message = $this->message->sendMessage($request);

        if($request->receiver_id == 0){
          $talkmessage = $this->message->getTalkMessage($message);
          $this->message->postTalkMessage($talkmessage);
        }

        // pusher
        $options = array(
          'cluster' => 'mt1',
          'useTLS' => true
        );

        $pusher = new Pusher(
          '58eb611363d0e375ea67',
          '67aa0934798b38d95c38',
          '1057527',
          $options
        );

        $data = ['from' => Auth::id(), 'to' => $request->receiver_id]; // sending from and to user id when pressed enter
        $pusher->trigger('message-channel', 'sent-message-event', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(message $message)
    {
        //
    }
}
