<?php

namespace App;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserRespository
{
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function getAllUser(){
    $users = $this->user->get();
  }

  public function getAllUserWithoutSelf(){
    $users = $this->user->where('id', '!=', Auth::id())->get();

    return $users;
  }
}
