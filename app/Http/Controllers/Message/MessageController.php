<?php

namespace App\Http\Controllers;

use App\Message\Message;
use App\Message\MessageRespository;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Events\MessagePosted;
use Auth;

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

        $this->message->getMessage($talkmessage);

        event(new MessagePosted($message,Auth::user()));
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
