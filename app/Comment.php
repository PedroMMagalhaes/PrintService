<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  public function users()
  {
    return $this->belongsTo('App\User','user_id');
  }

  public function requests()
  {
    return $this->belongsTo('App\Request','request_id');
  }

  public function comments()
  {
    return $this->belongsTo('App\Comment','parent_id');
  }
}
