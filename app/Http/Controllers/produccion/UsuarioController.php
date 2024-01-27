<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\Rol;
use App\Unidad;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UsuarioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $usuario = User::where('estado', '!=', 'I')->get();
        return view('produccion.usuario.index', compact('usuario'));
    }

    public function create()
    {
        $rol = Rol::get();
        $unidad = Unidad::get();
        return view('produccion.usuario.create', compact('rol', 'unidad'));
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
            'name.required' => 'ingresar nombre',
            'user_name.required' => 'ingresar usuario',
            'email.required' => 'ingresar correo',
            'password.required' => 'ingresar clave',

        ];

        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required',



        ], $messages);


        $user = new user();
        // $aplicacionasservidor->id = $request->get('id');
        $user->name = $request->get('name');
        $user->user_name = $request->get('user_name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->rol_id = $request->get('rol_id');
        $user->unidad_id = $request->get('unidad_id');
        // $user->fecha_creacion =  $time->toDateTimeString();
        $user->estado =   'A';
        $user->save();
        $roles = Role::findOrFail($user->rol_id);
        $user->assignRole($roles->name);
        alert()->success('El registro ha sido agregado correctamente');
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
        $user = User::findOrFail($id);
        $rol = Rol::get();
        $unidad = Unidad::get();

        $roles = $user->user_rol;

        $rolArray =  $roles->pluck('id')->toArray();

        $rol_no_asignados = Role::whereNotIn('id', $rolArray)->get();

        return view('produccion.usuario.show', compact('user', 'rol', 'roles', 'unidad', 'rol_no_asignados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $rol = Rol::get();
        $unidad = Unidad::get();

        $roles = $user->user_rol;

        $rolArray =  $roles->pluck('id')->toArray();

        $rol_no_asignados = Role::whereNotIn('id', $rolArray)->get();

        return view('produccion.usuario.edit', compact('user', 'rol','roles', 'unidad', 'rol_no_asignados'));
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
            'name.required' => 'ingresar nombre',
            'user_name.required' => 'ingresar usuario',
            'email.required' => 'ingresar correo',


        ];

        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',



        ], $messages);


        $user =   User::findorFail($id);
        // $aplicacionasservidor->id = $request->get('id');
        $user->name = $request->get('name');
        $user->user_name = $request->get('user_name');
        $user->email = $request->get('email');
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        //$user->rol_id = $request->get('rol_id');
        //$roles = Role::findOrFail($user->rol_id);
        //$user->assignRole($roles->name);
        $user->unidad_id = $request->get('unidad_id');
        // $user->fecha_creacion =  $time->toDateTimeString();
        $user->estado = $request->get('estado');
        $user->update();
        alert()->success('El registro ha sido modificado correctamente');
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

        $usuario = User::findOrFail($id);
        $usuario->estado = 'I';
        $usuario->update();
        alert()->error('El usuario ha sido desactivado correctamente');
        return back();
    }

    public function  attach_roles(Request $request)
    {


        $user = User::findOrFail($request->model_id);
        $roles = Role::findOrFail($request->rol_id);
        $user->assignRole($roles->name);
        alert()->success('se han sido Agregado correctamente');
        return back();
    }

    public function  dettach_roles(Request $request)
    {
        $user = User::findOrFail($request->model_id);
        $user->user_rol()->detach($request->rol_id);
        alert()->error('El registro ha sido eliminado correctamente');
        return back();
    }


    public function update_perfil(Request $request)
    {

        $messages = [
            'name.required' => 'ingresar nombre',
            'user_name.required' => 'ingresar usuario',
            'email.required' => 'ingresar correo',


        ];

        $request->validate([
            'name' => 'required',
            'user_name' => 'required',
            'email' => 'required',



        ], $messages);


        $user =   User::findorFail(auth()->user()->id);

        // $aplicacionasservidor->id = $request->get('id');
        $user->name = $request->get('name');
        $user->user_name = $request->get('user_name');
        $user->email = $request->get('email');


        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }


      //  $filename = $archivo->getClientOriginalName();
      //  $path = $filename;
       // $destinationPath = public_path('./images/users');
       // $archivo->move($destinationPath, $path);       // $organizations->logo_url = "./images";       // $organizations->logo = $filename;
       // $user->image = $filename;
       // $user->update();
        //alert()->success('El registro ha sido modificado correctamente');
        //return back();--}}

         //$file = $request->file('fileInput');

           // $filename = $file->getClientOriginalName();
           // $path = uniqid() . $filename;
            //$destinationPath = public_path('./images/users');
            //$file->move($destinationPath, $path);
            //$user->image = $filename;

            if ($request->file('fileInput')) {
                $doc = $request->file('fileInput');
                $path = uniqid() . $doc->getClientOriginalName();
                $doc->move(public_path("./images/users"),  $path);
                $user->image = $path;
            }

            $user->update();


        alert()->success('Registro actualizado correctamente');
        return back();

    }
}
