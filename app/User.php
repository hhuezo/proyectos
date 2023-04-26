<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use App\Cart;
use App\Unidad;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'user_name', 'rol_id', 'unidad_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function unidad(){

        return $this->belongsTo('App\Unidad', 'unidad_id', 'id');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'rol_id', 'id');
    }

    public function unidadId(){

        $unidadId = User::join('unidades','users.unidad_id','=','unidades.id')
        ->select('unidades.id')
        ->where('users.id','=',\Auth::user()->id)->get()->first()->id;

        return $unidadId;
    }

}
