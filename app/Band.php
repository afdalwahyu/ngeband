<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
  protected $table = 'band';
    //

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function bandmember()
  {
    return $this->hasMany('App\Bandmember');
  }

  public function reqjoin()
  {
    return $this->hasMany('App\Reqjoin');
  }

}
