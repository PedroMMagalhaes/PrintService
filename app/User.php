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
          $user->token = str_random(40);
      });
  }



public function hasVerified()
{

    $this->verified = true;
    $this->token = null;

    $this->save();
}



}
