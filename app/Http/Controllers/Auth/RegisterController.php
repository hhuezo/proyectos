<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as Req;

use App\Departamento;
use App\Municipio;
use App\Rol;
use App\Unidad;


use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

      $messages = [
          'name.required'  => 'Nombre de Usuario es requerido',
          'name.unique' => 'Este Nombre de Usuario ya ha sido tomado',
          'email.required'  => 'email es requerido',
          'email.email' => 'Debe tener formato de correo',
          'email.unique' => 'Este correo ya ha sido tomado',
          'password.required'  => 'Contrasena es requerido',
          'password.min'  => 'Contrasena debe tener por lo menos 5 caracteres',
          'user_name.required'  => 'Usuario es requerido',
          'user_name.unique' => 'Este usuario ya ha sido tomado'
      ];



        return Validator::make($data, [
            'email' => ['required', 'nullable', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'user_name' => ['required','unique:users'],
            'name' => ['required','unique:users']
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {



        return User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?: '',
            'password' => bcrypt($data['password']),
            'user_name' => $data['user_name'],
            'rol_id' => $data['rol_id'],
            'unidad_id' => $data['unidad_id']
            
        ]);

        Alert::success('Usuario Creado','Datos guardados correctamente');
        //dd($data);
    }

    public function showRegistrationForm(Req $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $roles = Rol::where('roles.id','>',0)->get();

        $unidades = Unidad::where('unidades.id','>',0)->get();

        return view('auth.register')->with(compact('name','email','roles','unidades'));
    }


}
