<?php

namespace App\Http\Controllers\produccion;

use App\CreacionObjetoBase;
use App\Http\Controllers\Controller;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreacionObjetoBaseController extends Controller
{

    public function index()
    {
        $objetos_bd = CreacionObjetoBase::get();

        return view('produccion.creacion_objetos_base_datos.index', compact('objetos_bd'));
    }

    public function create()
    {
        $proyectos = Proyecto::get();
        return view('produccion.creacion_objetos_base_datos.create', compact('proyectos'));
    }


    public function store(Request $request)
    {



        // $dia = substr($request->fecha_creacion, 0, 2);
        // $mes = substr($request->fecha_creacion, 3, 2);
        // $anio = substr($request->fecha_creacion, 6, 4);

        // $fecha_ymd = $anio.$mes.$dia;


       //dd($fileName);

       $creacionObjetoBaseDatos = new CreacionObjetoBase();
       $creacionObjetoBaseDatos->nombre_especialista=$request->nombre_especialista;
       $creacionObjetoBaseDatos->num_formulario=$request->num_formulario;
       $creacionObjetoBaseDatos->tipo_objeto=$request->tipo_objeto;
       $creacionObjetoBaseDatos->fecha_creacion=$request->fecha_creacion;
       $creacionObjetoBaseDatos->funciones=$request->funciones;
       $creacionObjetoBaseDatos->nombre_objeto_asignar=$request->nombre_objeto_asignar;
       $creacionObjetoBaseDatos->descripcion=$request->descripcion;
       $creacionObjetoBaseDatos->base_datos=$request->base_datos;
       $creacionObjetoBaseDatos->grants=$request->grants;
       $creacionObjetoBaseDatos->roles=$request->roles;
       $creacionObjetoBaseDatos->synonyms=$request->synonyms;
       $creacionObjetoBaseDatos->comentario=$request->comentario;
       $creacionObjetoBaseDatos->proyecto_relacionado=$request->proyecto_relacionado;
       $creacionObjetoBaseDatos->fecha_ymd=$request->fecha_creacion;


        //   $adjunto1 = $request->file('adjunto1');
        //   dd($adjunto1);


         if ($request->file('adjunto1')){
             $adjunto1 = $request->file('adjunto1');
             $adjunto1->move(public_path().'/Archivos/',$adjunto1->getClientOriginalName());
             $creacionObjetoBaseDatos->adjunto1=$adjunto1->getClientOriginalName();
         }

         if ($request->file('adjunto2')){
             $adjunto2 = $request->file('adjunto2');
             $adjunto2->move(public_path().'/Archivos/',$adjunto2->getClientOriginalName());
             $creacionObjetoBaseDatos->adjunto2=$adjunto2->getClientOriginalName();
         }

         if ($request->file('adjunto3')){
             $adjunto3 = $request->file('adjunto3');
             $adjunto3->move(public_path().'/Archivos/',$adjunto3->getClientOriginalName());
             $creacionObjetoBaseDatos->adjunto3=$adjunto3->getClientOriginalName();
         }

         if ($request->file('adjunto4')){
             $adjunto4 = $request->file('adjunto4');
             $adjunto4->move(public_path().'/Archivos/',$adjunto4->getClientOriginalName());
             $creacionObjetoBaseDatos->adjunto4=$adjunto4->getClientOriginalName();
         }


       $creacionObjetoBaseDatos->save();

        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }


}
