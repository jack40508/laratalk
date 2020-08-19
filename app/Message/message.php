<?php

namespace App\Message;

use Illuminate\Database\Eloquent\Model;
use App\User;

class message extends Model
{
    //
    protected $table = 'messages';
    protected $fillable = [
      'from_id',
      'to_id',
      'message',
      'is_read',
    ];

    /*------------------------------------------------------------------------**
    ** Relation 定義                                                          **
    **------------------------------------------------------------------------*/

    public function from(){
      return $this->belongsTo(User::class);
    }

    public function to(){
      return $this->belongsTo(User::class);
    }
}
