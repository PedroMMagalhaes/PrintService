<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    public function users()
    {
      return $this->belongsTo('App\User', 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function printers()
    {
      return $this->belongsTo('App\Printer');
    }

}
