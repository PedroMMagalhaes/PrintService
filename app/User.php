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
        'password',
    ];

    protected $guarded = [
      'id','remember_token'
    ];


    public function typeToStr()
    {
        switch ($this->admin) {
            case 1:
                return 'Administrator';
            case 0:
                return 'Functionary';
        }

        return 'Unknown';
    }


    public function departToStr()
    {
        switch ($this->department_id) {
            case 1:
                return 'Ciências Jurídicas';
            case 2:
                return 'Ciências da Linguagem';

            case 3:
                return 'Engenharia do Ambiente';

            case 4:
                return 'Engenharia Civil';

            case 5:
                return 'Engenharia Eletrotécnica';

            case 6:
                return 'Engenharia Informática';

            case 7:
                return 'Engenharia Mecânica';

            case 8:
                return 'Gestão e Economia';

            case 9:
                return 'Matemática';
        }

        return 'Unknown';
    }

    public static function strToDepart($string)
    {
        switch ($string) {
            case 'Ciências Jurídicas':
                return 1;
            case 'Ciências da Linguagem':
                return 2;

            case 'Engenharia do Ambiente':
                return 3;

            case 'Engenharia Civil':
                return 4;

            case 'Engenharia Eletrotécnica':
                return 5;

            case 'Engenharia Informática':
                return 6;

            case 'Engenharia Mecânica':
                return 7;

            case 'Gestão e Economia':
                return 8;

            case 'Matemática':
                return 9;
        }

        return -1;
    }

    public function isAdmin()
    {
        return $this->admin == 1;
    }

    public function isPublisher()
    {
        return $this->admin == 0;
    }


// BOOT do modelo




  public static function boot()
  {
      parent::boot();
      static::creating(function ($user) {
          $user->remember_token = str_random(40);
          $user->token = str_random(100);
      });
  }



public function hasVerified()
{

    $this->activated = 1;
    //$this->token = null;

    $this->save();
}



}
