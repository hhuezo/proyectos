<?php

namespace App\Http\Controllers\infraestructura;

use App\Http\Controllers\Controller;
use App\infraestructura\CalendarioVacacion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use PDF;
class CalendarioVacacioncontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $calendario= CalendarioVacacion::where('estado','=','A')->get();
        $user=User::get();
        $periodo = CalendarioVacacion::distinct('periodo')->pluck('periodo');
      //   dd($periodo);
        return view('infraestructura.calendarizacion_vacacion.index', compact('calendario','user','periodo'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personal=User::get();
        return view('infraestructura.calendarizacion_vacacion.create',compact('personal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'personal_id.required' => 'ingresar la persona',
            'cargo.required' => 'ingresar el cargo',
            'area.required' => 'ingresar el area',
            'fecha_inicio.required' => 'ingresar fecha de inicio',
            'fecha_fin.required' => 'ingresar fecha de fin',
        ];



        $request->validate([
            'personal_id' => 'required',
            'cargo' => 'required',   
            'area' => 'required',           
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');
        $vacaciones = new CalendarioVacacion();
        $vacaciones->personal_id = $request->get('personal_id');
        $vacaciones->cargo = $request->get('cargo');
        $vacaciones->area = $request->get('area');
        $vacaciones->periodo = $request->get('periodo');
        $vacaciones->fecha_inicio = $request->get('fecha_inicio');
        $vacaciones->fecha_fin = $request->get('fecha_fin');
        $vacaciones->estado = 'A';        
        $vacaciones->save();
        alert()->success(' se ha agregado la vacacion correctamente');
        return back(); 



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
      //  $calendario= CalendarioVacacion::get();
       // $user=User::get();
        //return view('infraestructura.calendarizacion_vacacion.show',compact( 'calendario','user')); 
        
      //  $pdf = PDF::loadView('infraestructura.evaluaciones.show', compact('resultado', 'evaluacion', 'data_calificacion', 'califica_obtenida', 'rango_evaluacion'));

        //$pdf->setPaper('A4', 'portrait');
        //return $pdf->stream('test_pdf.pdf');

    }


    public function reporte(Request $request)
    {       
       // dd($request->fecha_inicio,  $request->fecha_fin  );
        $user=User::get();
        $inicio= $request->fecha_inicio;
        $fin= $request->fecha_fin;
        
        $calendario= CalendarioVacacion::where ('fecha_inicio','>=',$inicio)->where('fecha_fin','<=',$fin)->get();
       
         return view('infraestructura.calendarizacion_vacacion.show',compact( 'calendario','user')); 
        //$pdf = PDF::loadView('infraestructura.calendarizacion_vacacion.show',compact( 'calendario','user'));
        
      //  $pdf = PDF::loadView('infraestructura.evaluaciones.show', compact('resultado', 'evaluacion', 'data_calificacion', 'califica_obtenida', 'rango_evaluacion'));

       // $pdf->setPaper('A4', 'portrait');
       // return $pdf->stream('test_pdf.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $calendario= CalendarioVacacion::findorfail($id);
        $user=User::get();
        return view('infraestructura.calendarizacion_vacacion.edit',compact('calendario','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
           
            'cargo.required' => 'ingresar el cargo',
            'area.required' => 'ingresar el area',
            'fecha_inicio.required' => 'ingresar fecha de inicio',
            'fecha_fin.required' => 'ingresar fecha de fin',
        ];



        $request->validate([
           
            'cargo' => 'required',
            'area' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ], $messages);


        $time = Carbon::now('America/El_Salvador');
        $vacaciones =  CalendarioVacacion::findorfail($id);
        //$vacaciones->personal_id = $request->get('personal_id');
        $vacaciones->cargo = $request->get('cargo');
        $vacaciones->area = $request->get('area');
        $vacaciones->periodo = $request->get('periodo');
        $vacaciones->fecha_inicio = $request->get('fecha_inicio');
        $vacaciones->fecha_fin = $request->get('fecha_fin');
        //$vacaciones->estado = 'A';        
        $vacaciones->update();
        alert()->success(' se ha modificado la vacacion correctamente');
        return back(); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacacion = CalendarioVacacion::findOrFail($id);
        $vacacion->estado = 'I';
        $vacacion->update();
        alert()->error('La vacacion se ha desactivado correctamente');
        return back();
    }
}
