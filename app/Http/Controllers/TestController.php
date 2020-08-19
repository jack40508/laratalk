<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    //
    public function index()
    {
        //
        $client = new Client();
        $res = $client->request('POST', 'https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk', [
            'form_params' => [
                'apikey' => 'DZZpEiJNTW1sSsQ7B8MkLb2Hk5UJFPj3',
                'query' => 'TEST',
            ]
        ]);

        $result = json_decode($res->getBody()->getContents(), true);
        $talkmessage = $result['results'][0]['reply'];

        return view('test',compact('talkmessage','res'));
    }
}
