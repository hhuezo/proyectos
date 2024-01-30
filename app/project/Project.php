<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    //
    protected $table = 'project';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'title',
        'sumary',
        'level_confidence',
        'requestor',
        'estimator',
        'version',
        'number_months',
        'estimated_hours',
        'estimated_investment',
        'assumptions'
    ];


    public function team()
    {
        return $this->hasMany(ProjectTeam::class);
    }

    public function project_data()
    {
        return $this->hasMany(ProjectData::class);
    }

    public function getTotalHours($project_id, $month)
    {
        $total = 0;

        $calc = DB::table('project_data')
        ->select(DB::raw('SUM((project_data.value * project_role.ha) * project.estimated_hours) as total'))
        ->join('project', 'project.id', '=', 'project_data.project_id')
        ->join('project_role', 'project_role.id', '=', 'project_data.project_role_id')
        ->where('project_data.project_id', $project_id)
        ->where('project_data.month',  $month)
        ->where('project_data.value', '>', 0)
        ->first();
        if($calc)
        {
            $total = $calc->total;
        }

        return intval($total);
    }

    public function getMonthlyInvestment($project_id, $month)
    {
        $total = 0;

        $calc = DB::table('project_data')
        ->select(DB::raw('SUM((project_data.value * project_role.ha * project_role.hr) * project.estimated_hours) as total'))
        ->join('project', 'project.id', '=', 'project_data.project_id')
        ->join('project_role', 'project_role.id', '=', 'project_data.project_role_id')
        ->where('project_data.project_id', $project_id)
        ->where('project_data.month',  $month)
        ->where('project_data.value', '>', 0)
        ->first();
        if($calc)
        {
            $total = $calc->total;
        }

        return $total;
    }

    public function getEstimatedInvestment($project_id)
    {
        $total = 0;

        $calc = DB::table('project_data')
        ->select(DB::raw('SUM((project_data.value * project_role.ha * project_role.hr) * project.estimated_hours) as total'))
        ->join('project', 'project.id', '=', 'project_data.project_id')
        ->join('project_role', 'project_role.id', '=', 'project_data.project_role_id')
        ->where('project_data.project_id', $project_id)
        ->where('project_data.value', '>', 0)
        ->first();
        if($calc)
        {
            $total = $calc->total;
        }

        return $total;
    }
}
