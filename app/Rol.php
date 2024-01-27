<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name',
    'guard_name' ,
    'created_at',
    'updated_at', ];

    public function permissions_has_role()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'role_id');
    }


}
