<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IsoMatrizController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');
    }

    public function index()
    {
        return view('produccion.iso.index');
    }

    public function iso2022()
    {
        return view('produccion.iso.iso2022');
    }
}
