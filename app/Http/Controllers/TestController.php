<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\Proyecto;
use Illuminate\Http\Request;

use App\User;

use DB;

class TestController extends Controller
{
    //
    public function welcome()
    {
        return view('welcome');
    }


    public function prueba()
    {
        //$categories = Category::has('products')->get();

        return view('prueba');
    }
}
