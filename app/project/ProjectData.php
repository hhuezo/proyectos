<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;

class ProjectData extends Model
{
    protected $table = 'project_data';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'project_role_id',
        'month',
        'value'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function project_role(){
        return $this->belongsTo(ProjectRole::class);

    }
}
