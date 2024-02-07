<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    protected $table = 'project_team';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'project_role_id',
        'number',
        'project_id',
        'ha',
        'hr'
    ];


    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function project_role(){
        return $this->belongsTo(ProjectRole::class);

    }

    public function getData($project_id,$project_role_id)
    {
        return ProjectData::where('project_id',$project_id)->where('project_role_id',$project_role_id)->orderby('month')->get();
    }




}
