@extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection
