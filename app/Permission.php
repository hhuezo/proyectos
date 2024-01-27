<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $table = 'permissions';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'name',
        'guard_name',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [];

    public function permissions_has_role()
    {
        return $this->belongsToMany('App\Rol', 'role_has_permissions','role_id', 'permission_id');
    }


}
