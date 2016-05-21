<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reqjoin extends Model
{
  protected $table = 'reqjoin';
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
