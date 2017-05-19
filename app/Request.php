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
                $query->where("description", "like","%$keyword%")
                    ->orWhere("due-date", "like", "%$keyword%")
                    ->orWhere("users->name", "like", "%$keyword%");
            });
        }
        return $query;
    }

    public function typeToStrState()
    {
        switch ($this->status) {
            case 0:
                return 'In process';
            case 1:
                return 'Closed';
        }

        return 'Unknown';
    }
}
