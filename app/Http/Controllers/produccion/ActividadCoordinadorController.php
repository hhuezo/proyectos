<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ActividadCoordinadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        return view('produccion.actividades_coordinador.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        session(['id_usuario' => $id]);
        return view('produccion.actividades_coordinador.show', ["id_usuario" => $id]);
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
