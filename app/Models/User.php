<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     use SoftDeletes;

     protected $dates = ['deleted_at'];

     protected $table = 'users';
     protected $primaryKey = 'idusers';

    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if ($this->role == 2) return true;
            return false;
    }

    public function items()
    {
      return $this->hasMany('App\Models\Items', 'idusers');
    }

    public function orders()
    {
      return $this->hasMany('App\Models\Orders', 'idusers');
    }

    public function notifications()
    {
      return $this->hasMany('App\Models\Notifications', 'idusers');
    }
}
