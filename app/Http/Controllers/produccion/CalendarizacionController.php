<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\snipeit\Maintenances;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $year = Carbon::now()->year;
        $pending = Maintenances::selectRaw('count(*) as count,MONTH(start_date) -1 AS mes, DAY(start_date) AS dia,
         YEAR(start_date) AS axo, "red"  as color, "Pendientes"  as label')
            ->whereYear('start_date', '=', $year)
            ->whereRaw('(notes = "" or notes is null)')
            ->groupBy('start_date')
            ->get();

        $done = Maintenances::selectRaw('count(*) as count,MONTH(start_date) -1 AS mes, DAY(start_date) AS dia,
            YEAR(start_date) AS axo, "blue" as color, "Realizados"  as label')
            ->whereYear('start_date', '=', $year)
            ->whereRaw('(notes != "" or notes is not null)')
            ->groupBy('start_date')
            ->get();

        return view('produccion.calendarizacion.index', compact('pending', 'done'));
    }

    public function get_data($date)
    {
        // $maintenances_pending = Maintenances::where('start_date', '=', $date)
        //     ->whereRaw('(notes = "" or notes is null)')
        //     ->get();

        // $maintenances_done = Maintenances::where('start_date', '=', $date)
        //     ->whereRaw('(notes != "" or notes is not null)')

        //     ->get();


            $maintenances_pending = DB::connection('mysql2')
            ->table('asset_maintenances as m')
            ->select('a.name', 'a.asset_tag', 'l.name as location', 'm.asset_maintenance_type', 'm.start_date', 'm.completion_date', 's.name as supplier')
            ->join('assets as a', 'm.asset_id', '=', 'a.id')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->join('suppliers as s', 'm.supplier_id', '=', 's.id')
            ->where('m.start_date', '=', $date)
            ->where(function ($query) {
                $query->where('m.notes', '=', '')
                      ->orWhereNull('m.notes');
            })
            ->get();



            $maintenances_done = DB::connection('mysql2')
            ->table('asset_maintenances as m')
            ->select('a.name', 'a.asset_tag', 'l.name as location', 'm.asset_maintenance_type', 'm.start_date', 'm.completion_date', 's.name as supplier')
            ->join('assets as a', 'm.asset_id', '=', 'a.id')
            ->join('locations as l', 'a.location_id', '=', 'l.id')
            ->join('suppliers as s', 'm.supplier_id', '=', 's.id')
            ->where('m.start_date', '=', $date)
            ->where(function ($query) {
                $query->where('m.notes', '!=', '')
                      ->orWhereNotNull('m.notes');
            })
            ->get();


            return view('produccion.calendarizacion.show', compact('maintenances_pending', 'maintenances_done', 'date'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
