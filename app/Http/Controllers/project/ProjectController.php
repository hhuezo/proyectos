<?php

namespace App\Http\Controllers\project;

use App\Http\Controllers\Controller;
use App\project\Project;
use App\project\ProjectData;
use App\project\ProjectRole;
use App\project\ProjectSecurityRequirements;
use App\project\ProjectTeam;
use App\project\SecurityRequirements;
use Exception;
use Illuminate\Http\Request;
use PDF;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $projects = Project::get();


        // $project = Project::first();
        // foreach($project->team as $team )
        // {
        //     for($i=1;$i<=$project->number_months;$i++)
        //     {

        //         $data = new ProjectData();
        //         $data->project_id = $project->id;
        //         $data->project_role_id = $team->project_role_id;
        //         $data->mounth = $i;
        //         $data->save();
        //     }


        // }


        /* $project = Project::first();
        //asignando data al proyecto
        $meses = $project->number_month;

        //formando encabezados
        $letras = array_map('chr', range(ord('A'), ord('Z')));

        $array_data = [];

        $array_data = ["0-A" => ""];
        $count_mes = 1;
        for ($i = 1; $i < count($letras); $i++) {
            $combinacion = "0-$letras[$i]";
            $array_data[$combinacion] = $i <= $meses ? "M" . (($i - 1) % 12 + 1) : null;
        }


        // array_push($array_data, $array_encabezado);


        $row = 1;
        foreach ($project->team as $team) {
            $array_data["$row-A"] = $team->project_role->name;

            for ($i = 1; $i < count($letras); $i++) {
                $combinacion = "$row-$letras[$i]";
                $array_data[$combinacion] =  null;
            }

            //array_push($array_data, $array);
            $row++;
        }




        for ($row; $row <= 24; $row++) {
            // $array = [];
            for ($i = 0; $i < count($letras); $i++) {
                $combinacion = "$row-$letras[$i]";
                $array_data[$combinacion] =  null;
            }

            // array_push($array_data, $array);
        }


        $project->data = $array_data;
        $project->update();*/







        $levels = ["", "Low", "Medium", "High"];

        return view('projects.project.index', compact('projects', 'levels'));
    }


    public function create()
    {
        $levels = ["", "Low", "Medium", "High"];
        return view('projects.project.create', compact('levels'));
    }


    public function store(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->level_confidence = $request->level_confidence;
        $project->requestor = $request->requestor;
        $project->estimator = $request->estimator;
        $project->version = $request->version;
        $project->number_months = $request->number_months;
        $project->estimated_hours = $request->estimated_hours;
        $project->estimated_investment = $request->estimated_investment;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();
        session(['tab' => 2]);
        return redirect('project/' . $project->id . '/edit');
    }


    public function show($id)
    {
        $project = Project::findOrFail($id);
        $levels = ["", "Low", "Medium", "High"];  //background-color:

        $roles = ProjectRole::get();
        foreach ($roles as $role) {
            $teamMember = $project->team->where('project_role_id', $role->id)->first();

            if ($teamMember) {
                $role->number = $teamMember->number;
                $role->team_id = $teamMember->id;
            } else {
                $role->number = null;
                $role->team_id = null;
            }
        }


        $security_requirements = SecurityRequirements::where('status', 1)->get();



        $project->summary = str_replace('background-color:', '', $project->summary);



        $pdf = PDF::loadView('projects.project.show',compact('project','levels','roles','security_requirements'));

        // $pdf->setPaper('A4', 'portrait');
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('test_pdf.pdf');

    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        $roles = ProjectRole::get();
        foreach ($roles as $role) {
            $teamMember = $project->team->where('project_role_id', $role->id)->first();

            if ($teamMember) {
                $role->number = $teamMember->number;
                $role->team_id = $teamMember->id;
            } else {
                $role->number = null;
                $role->team_id = null;
            }
        }

        $security_requirements = SecurityRequirements::where('status', 1)->get();

        if (!session()->has('tab')) {
            session(['tab' => 1]);
        }


        return view('projects.project.edit', compact('project', 'roles', 'security_requirements'));
    }


    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->level_confidence = $request->level_confidence;
        $project->requestor = $request->requestor;
        $project->estimator = $request->estimator;
        $project->version = $request->version;
        $project->number_months = $request->number_months;
        $project->estimated_hours = $request->estimated_hours;
        $project->estimated_investment = $request->estimated_investment;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->update();

        session(['tab' => 2]);

        return redirect('project/' . $id . '/edit');
    }

    public function summary(Request $request)
    {
        $project = Project::findOrFail($request->project);
        $project->summary = $request->summary;
        $project->update();

        session(['tab' => 3]);
        return back();
    }

    public function assumptions(Request $request)
    {
        $project = Project::findOrFail($request->project);
        $project->assumptions = $request->assumptions;
        $project->update();

        alert()->success('El registro ha sido agregado correctamente');
        session(['tab' => 1]);
        return back();
    }


    public function team_activate(Request $request)
    {
        $team = new ProjectTeam();
        $team->project_role_id =  $request->project_role_id;
        $team->number =  $request->number;
        $team->project_id =  $request->project_id;
        $team->save();



        $months = $team->project->number_months;

        for ($i = 1; $i <= $months; $i++) {
            $data = new ProjectData();
            $data->project_id = $request->project_id;
            $data->project_role_id = $request->project_role_id;
            $data->month = $i;
            $data->value = 0;
            $data->save();
        }


        session(['tab' => 3]);
        return back();
    }


    public function team_inactivate(Request $request)
    {
        $team = ProjectTeam::findOrFail($request->team_id);

        ProjectData::where('project_id', $team->project_id)->where('project_role_id', $team->project_role_id)->delete();

        $team->delete();


        session(['tab' => 3]);
        return back();
    }

    public function team_update(Request $request)
    {
        $team = ProjectTeam::findOrFail($request->team_id);
        $team->number =  $request->number;
        $team->update();
        session(['tab' => 3]);
        return back();
    }

    public function send_data(Request $request, $id)
    {
        $data = ProjectData::findOrFail($id);
        $data->value = $request->value;
        $data->update();

        $project = Project::findOrFail($data->project_id);
        $total_hours = $project->getTotalHours($data->project_id, $data->month);
        $total_investment = $project->getMonthlyInvestment($data->project_id, $data->month);
        $estimated_investment = $project->getEstimatedInvestment($data->project_id);
        return response()->json([
            'message' => '1', 'total_hours' => $total_hours, 'total_investment' => $total_investment, 'estimated_investment' => $estimated_investment
        ]);
    }

    public function get_totales($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.project.totales', compact('project'));
    }


    public function send_data_requirement(Request $request)
    {
        $requirement = ProjectSecurityRequirements::firstOrCreate(
            [
                'project_catalog_security_requirements_id' => $request->id,
                'project_id' => $request->project
            ],
            ['required' => '0'] // Ajustar el valor predeterminado a '0'
        );

        // Cambia el estado de 'required' si el registro ya existía
        $requirement->required = $requirement->required === '1' ? '0' : '1';
        $requirement->save();

        return $requirement;
    }

    public function set_sesion($id)
    {
        session(['tab' => $id]);
        return back();
    }


    public function  send_data_role(Request $request)
    {
        try {

            ProjectData::where('project_id', $request->project)->where('project_role_id', $request->role)->delete();
            ProjectTeam::where('project_id', $request->project)->where('project_role_id', $request->role)->delete();

            if ($request->value > 0) {
                $team = new ProjectTeam();
                $team->project_role_id =  $request->role;
                $team->number =  $request->value;
                $team->project_id =  $request->project;
                $team->save();

                $months = $team->project->number_months;

                for ($i = 1; $i <= $months; $i++) {
                    $data = new ProjectData();
                    $data->project_id = $request->project;
                    $data->project_role_id = $request->role;
                    $data->month = $i;
                    $data->value = 0;
                    $data->save();
                }
            }

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }


    public function destroy($id)
    {
        ProjectData::where('project_id', $id)->delete();
        ProjectSecurityRequirements::where('project_id', $id)->delete();
        ProjectTeam::where('project_id', $id)->delete();
        $project = Project::findOrFail($id);
        $project->delete();

        alert()->success('the record was deleted');
        return back();
    }
}
