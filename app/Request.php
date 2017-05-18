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

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("description", "LIKE","%$keyword%")
                    ->orWhere("due-date", "LIKE", "%$keyword%")
                    ->orWhere("users->name", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

}
