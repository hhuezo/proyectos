<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;

class ProjectSecurityRequirements extends Model
{
    protected $table = 'project_security_requirements';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'project_catalog_security_requirements_id',
        'project_id',
        'required'
    ];
}
