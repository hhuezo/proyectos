<?php

namespace App\Http\Controllers\catalogo;

use App\catalogo\Propietario;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Proyectos;
use App\Proyecto;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $propietario = Propietario::orderByDesc('activo')->get();
        //dd($propietario);
        return view('catalogo.propietario.index',compact('propietario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propietario = Propietario::get();
        $proyecto = Proyecto::get();

       // $servidores_has_aplicacion =  $aplicacion->aplicacion_has_servidor;
       // $servidores= Servidor::get();
        //$servidores_has_aplicacion =  $aplicacion->aplicacion_has_servidor;
        return view('catalogo.propietario.create',compact('propietario','proyecto'));
        
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
            'nombre.required' => 'ingresar nombre del tipo de servidor',


        ];



        $request->validate([
            'nombre' => 'required',
                ], $messages);



        //dd($fecha);



         $propietario = new propietario();
        //$max = Tiposervidor::max('id') + 1;
        //$tipo_servidores->id =  $max;
        $propietario->nombre = $request->get('nombre');
        $propietario->activo = 1;

        $propietario->save();

        alert()->success('El registro ha sido agregado correctamente');
        return redirect('/catalogo/propietario/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propietario = Propietario::findOrFail($id);
        // dd($tipo_servidores);
         return view('catalogo.propietario.edit', compact('propietario'));
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
            'nombre.required' => 'ingresar nombre',
        ];
        $request->validate([
            'nombre' => 'required',

        ], $messages);


        $propietario =  Propietario::findOrFail($id);
        $propietario->nombre = $request->get('nombre');
        $propietario->update();
       // $tipo_servidores->save();
        alert()->success('El registro ha sido modificado correctamente');
        return redirect('/catalogo/propietario/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propietario =Propietario::findOrFail($id);
        if($propietario->activo == 1){
            $propietario->activo = 0;
        }else{
            $propietario->activo = 1;
        }
        $propietario->update();
        alert()->error('El registro ha sido eliminado correctamente');
        return back();
    }
}
