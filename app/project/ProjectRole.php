<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;

class ProjectRole extends Model
{
    protected $table = 'project_role';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'name',
        'hr',
        'ha',
        'requestor',
        'status'
    ];

    public function team(){
        return $this->hasMany(ProjectTeam::class);
    }
}
