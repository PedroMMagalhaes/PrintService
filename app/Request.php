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
        return $this->hasMany('App\Comment')->groupBy('parent_id')->orderBy('created_at');
    }

    public function printers()
    {
      return $this->belongsTo('App\Printer');
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

    public static function strToTypeState($status)
    {
        switch ($status) {
            case 'In process':
                return 0;
            case 'Closed':
                return 1;
        }

        return -1;
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
