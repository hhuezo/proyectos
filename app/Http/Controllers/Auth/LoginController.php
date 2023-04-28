<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as Req;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'user_name';
    }

    // public function showLoginForm()
    // {
    //   return view('auth.login');
    // }

    public function showLoginForm(Req $request)
    {

        $email = $request->input('email');
        $password = $request->input('password');

        return view('auth.login')->with(compact('email', 'password'));
    }

    public function redirectTo()
    {
        if (session()->has('redirect_to'))
            return session()->pull('redirect_to');

        $usuarios = User::take(10)->get();
        session(['session_usuarios' => $usuarios]);
        return $this->redirectTo;
    }
}
