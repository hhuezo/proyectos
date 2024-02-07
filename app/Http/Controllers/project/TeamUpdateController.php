<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\project\ProjectTeam;
use Exception;
use Illuminate\Http\Request;

class TeamUpdateController extends Controller
{
    public function  update_data_role_hr(Request $request)
    {
        try {

            $team = ProjectTeam::where('project_id', $request->project)->where('project_role_id', $request->role)->first();

            if ($team) {
                $value = 0;
                if ($request->value != "") {
                    $value = $request->value;
                }
                $team->hr = $value;
                $team->update();
                return $team;
                return $value;
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function update_data_role_ha(Request $request)
    {
        try {

            $team = ProjectTeam::where('project_id', $request->project)->where('project_role_id', $request->role)->first();
            if ($team) {
                $value = 0;
                if ($request->value != "") {
                    $value = $request->value;
                }
                $team->ha = $value;
                $team->update();
                return $team;
                return $value;
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}
