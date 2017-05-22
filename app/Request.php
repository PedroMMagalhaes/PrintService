<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $fillable = [
        'description', 'due_date', 'quantity', 'colored', 'stapled','paper_size','paper_type'
    ];

    public function users()
    {
      return $this->belongsTo('App\User', 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at');
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

    public function typeToStrPaperType()
    {
        switch ($this->paper_type) {
            case 0:
                return 'Draft';
            case 1:
                return 'Normal';
            case 2:
                return 'Photographic';
        }

        return 'Unknown';
    }

    public function typeToStrPaperSize()
    {
        switch ($this->paper_size) {
            case 3:
                return 'A3';
            case 4:
                return 'A4';
        }

        return 'Unknown';
    }
}
