<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public function requests()
    {
        return $this->hasMany('App\Request');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin', 'blocked', 'print_evals', 'print_counts', 'department_id', 'profile_photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = [

    ];


    public function typeToStr()
    {
        switch ($this->admin) {
            case 1:
                return 'Administrator';
            case 0:
                return 'Publisher';
        }

        return 'Unknown';
    }

    public function isAdmin()
    {
        return $this->admin == 1;
    }

    public function isPublisher()
    {
        return $this->admin == 0;
    }





}
