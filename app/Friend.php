<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
  protected $table = 'friend';
    //
  public function user_action()
  {
    return $this->belongsTo('App\User');
  }

  public function user_response()
  {
    return $this->belongsTo('App\User');
  }
}
