@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <!--
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div id="app">
              <h1>Chatroom</h1>
              <chat-log :messages="messages"></chat-log>
              <chat-composer v-on:messagesent="addMessage"></chat-composer>
            </div>
        </div>
    </div>
  -->
  <div class="row">
    <div class="col-md-4">
      <div class="user-wrapper">
        <ul class="users">
          <li class="user" id="0">
            <div class="media">
              <div class="media-left">
                <img src="http://via.placeholder.com/150" alt="" class="media-object">
              </div>

              <div class="media-body">
                <p class="name">Talk API</p>
                <p class="email">https://a3rt.recruit-tech.co.jp/product/talkAPI/</p>
              </div>
            </div>
          </li>
          @foreach($users as $user)
            <li class="user" id="{{ $user->id }}">
              @if(Auth::user()->unreadMessages($user->id))
                <span class="pending">{{ Auth::user()->unreadMessages($user->id) }}</span>
              @endif

              <div class="media">
                <div class="media-left">
                  <img src="http://via.placeholder.com/150" alt="" class="media-object">
                </div>

                <div class="media-body">
                  <p class="name">{{ $user->name }}</p>
                  <p class="email">{{ $user->email }}</p>
                </div>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <a class="btn btn-danger btn-reset" href="message/destroyall" role="button">メッセージをリセット</a>
    </div>
    <div class="col-md-8" id="messages">

    </div>
  </div>
</div>
@endsection
