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

        $calc = DB::table('project_data as pd')
            ->selectRaw('SUM((pd.value * pt.ha) * p.estimated_hours) as total')
            ->join('project as p', 'p.id', '=', 'pd.project_id')
            ->join('project_team as pt', function ($join) {
                $join->on('pt.project_role_id', '=', 'pd.project_role_id')
                    ->on('pt.project_id', '=', 'pd.project_id');
            })
            ->where('pd.project_id', $project_id)
            ->where('pd.month',  $month)
            ->where('pd.value', '>', 0)
            ->first();

        if ($calc) {
            $total = $calc->total;
        }

        return intval($total);
    }

    public function getMonthlyInvestment($project_id, $month)
    {
        $total = 0;

        $calc = DB::table('project_data')
            ->select(DB::raw('SUM((project_data.value * project_team.ha * project_team.hr) * project.estimated_hours) AS total'))
            ->join('project', 'project.id', '=', 'project_data.project_id')
            ->join('project_team', function ($join) {
                $join->on('project_team.project_role_id', '=', 'project_data.project_role_id')
                    ->on('project_team.project_id', '=', 'project_data.project_id');
            })
            ->where('project_data.project_id', $project_id)
            ->where('project_data.month', $month)
            ->where('project_data.value', '>', 0)
            ->first();

        if ($calc) {
            $total = $calc->total;
        }

        return $total;
    }

    public function getEstimatedInvestment($project_id)
    {
        $total = 0;

        $calc = DB::table('project_data as pd')
            ->select(DB::raw('SUM((pd.value * pr.ha * pr.hr) * p.estimated_hours) AS total'))
            ->join('project as p', 'p.id', '=', 'pd.project_id')
            ->join('project_team as pr', function ($join) {
                $join->on('pr.project_role_id', '=', 'pd.project_role_id')
                    ->on('pr.project_id', '=', 'pd.project_id');
            })
            ->where('pd.project_id', $project_id)
            ->where('pd.value', '>', 0)
            ->first();

        if ($calc) {
            $total = $calc->total;
        }

        return $total;
    }


}
