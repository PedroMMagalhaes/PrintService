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
                return 'Pending';
            case 1:
                return 'Completed';
            case 2:
                return 'Refused';
        }

        return 'Unknown';
    }

    public static function strToTypeState()
    {
        switch ($this->status) {
            case 'Pending':
                return 0;
            case 'Completed':
                return 1;
            case 'Refused':
                return 2;
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

    public function typeToStrStampled()
    {
        switch ($this->stampled) {
            case 0:
                return 'No';
            case 1:
                return 'Yes';
        }

        return 'Unknown';
    }


    public function typeToStrColored()
    {
        switch ($this->colored) {
            case 0:
                return 'Black and White';
            case 1:
                return 'Colored';
        }

        return 'Unknown';
    }

    public function typeToStrFrontBack()
    {
        switch ($this->front_back) {
            case 0:
                return 'Single-sided';
            case 1:
                return 'Double-sided';
        }

        return 'Unknown';
    }
}
