<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function team()
    {
        return $this->hasMany(ProjectTeam::class);
    }


    public function getHr($id_project, $id_role)
    {
        $hr = 0;

        $calc = DB::table('project_role as pr')
            ->selectRaw('IFNULL(
                    (
                        SELECT pt.hr
                        FROM project_team pt
                        WHERE pt.project_role_id = pr.id
                        AND pt.project_id = ?
                        AND pt.hr <> 0.00
                        AND pt.hr IS NOT NULL
                        LIMIT 1
                    ),
                    pr.hr
                ) AS hr', [$id_project])
            ->where('pr.id', $id_role)
            ->first();


        if ($calc) {
            $hr = $calc->hr;
        }

        return $hr;
    }

    public function getHa($id_project, $id_role)
    {
        $ha = 0;

        $calc = DB::table('project_role as pr')
            ->selectRaw('IFNULL(
                        (
                            SELECT pt.ha
                            FROM project_team pt
                            WHERE pt.project_role_id = pr.id
                            AND pt.project_id = ?
                            AND pt.ha <> 0.00
                            AND pt.ha IS NOT NULL
                            LIMIT 1
                        ),
                        pr.ha
                    ) AS ha', [$id_project])
            ->where('pr.id', $id_role)
            ->first();



        if ($calc) {
            $ha = $calc->ha;
        }

        return $ha;
    }

    public function getNumber($id_project, $id_role)
    {
        $number = "";

        $calc = ProjectTeam::where('project_id',$id_project)->where('project_role_id',$id_role)->first();

        if ($calc) {
            $number = $calc->number;
        }


        return $number;
    }

    public function getIdTeam($id_project, $id_role)
    {
        $id = "";

        $calc = ProjectTeam::where('project_id',$id_project)->where('project_role_id',$id_role)->first();

        if ($calc) {
            $id = $calc->id;
        }


        return $id;
    }
}
