<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bandmember extends Model
{
  protected $table = 'bandmember';
    //
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function band()
  {
    return $this->belongsTo('App\Band');
  }
}
