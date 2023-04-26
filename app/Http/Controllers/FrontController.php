<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proyecto;
use App\Actividad;

class FrontController extends Controller
{
    //        
    public function index(){
        if (auth()->user()->rol_id != 1) {
            $proyectos = Actividad::join('proyectos','actividades.proyecto_id','=','proyectos.id')
            ->join('users','actividades.users_id','=','users.id')
            ->join('estados','actividades.estado_id','=','estados.id')
            ->join('categoria_tickets','actividades.categoria_id','=','categoria_tickets.id')
            ->join('prioridad_tickets','actividades.prioridad_id','=','prioridad_tickets.id')
            ->select('proyectos.id', 'proyectos.nombre')
            ->where('actividades.estado_id','<>',4)
            ->where('actividades.users_id','=',auth()->user()->id)->distinct()->get();
        }else{
            $proyectos = Proyecto::all();
        }
        

        
        return view('post.index', compact('proyectos'));
    }

    public function proyecto($proyecto){
        $proyecto = Proyecto::find($proyecto);
        //dd($proyecto);
        return view('post.proyecto', compact('proyecto'));
    }

    public function actividad($proyecto, $actividad){
        $actividad = Actividad::find($actividad);

        auth()->user()->unreadNotifications->markAsRead();
        
        return view('post.actividad', compact('actividad'));
    }
}