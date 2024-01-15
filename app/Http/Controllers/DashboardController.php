<?php

namespace App\Http\Controllers;

use App\iso\Grafica;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data = Grafica::findOrFail(1);
        $jsonData  = $data->valor;
        $grafica = json_decode($jsonData, true);




        $encabezados = [];

        // Iterar sobre las columnas B a Z
        foreach (range('B', 'Z') as $letra) {
            $encabezado = $grafica["0-$letra"];

            // Verificar si el encabezado no es nulo antes de agregarlo al array
            if ($encabezado !== null) {
                $encabezados[] = $encabezado;
            }
        }

        $data_grafico = [];


        // Iterar sobre las filas desde la 1
        for ($fila = 1; $fila <= 24; $fila++) {
            // Obtener el nombre de la fila actual
            $nombreFila = $grafica["$fila-A"];

            // Continuar solo si el nombre de la fila no es nulo
            if ($nombreFila !== null) {
                // Inicializar un arreglo para la fila actual
                $filaActual = ["name" => $nombreFila, "data" => []];

                // Iterar sobre las columnas B a Z
                foreach (range('B', 'Z') as $letra) {
                    // Obtener el valor de la celda actual
                    $valor = $grafica["$fila-$letra"];

                    // Agregar el valor al arreglo de la fila actual si no es nulo
                    if ($valor !== null) {
                        $filaActual["data"][] = $valor +0;
                    }
                }

                // Agregar la fila al arreglo principal
                $data_grafico[] = $filaActual;
            }
        }


        return view('dashboard.index', compact('grafica', 'data_grafico', 'encabezados'));
    }

    public function create()
    {
        /*$letras = array();

        for ($i = 0; $i < 26; $i++) {
            $letras[] = chr(65 + $i);
        }

        // for($i=0;$i<25;$i++)
        // {
        //     foreach( $letras as  $letra)
        //     {
        //         $grafica = new Grafica();
        //         $grafica->grafica_id = 1;
        //         $grafica->codigo = $i."-".$letra;
        //         $grafica->save();
        //     }

        // }

        //Grafica::where('grafica_id', 1)->where('codigo', '0-A')->update(['valor' => 10]);
        //$grafica = Grafica::where('grafica_id', 1)->get();

        $data = [
            "0-A" => null, "0-B" => "20", "0-C" => "30", "0-D" => null, "0-E" => null, " 0-F" => null, "0-G" => null, "0-H" => null, "0-I" => null, "0-J" => null, "0-K" => null, "0-L" => null, "0-M" => null, "0-N" => null, "0-O" => null, "0-P" => null, "0-Q" => null, "0-R" => null, "0-S" => null, "0-T" => null, "0-U" => null, "0-V" => null, "0-W" => null, "0-X" => null, " 0-Y" => null, "0-Z" => null, "1-A" => "50", "1-B"  => "60", "1-C"  =>  null, "1-D" => null, "1-E" => null, "1-F" => null, "1-G" => null, "1-H" => null, "1-I" => null, "1-J" => null, "1-K" => null, "1-L" => null, "1-M" => null, "1-N" => null, "1-O" => null, "1-P" => null, "1-Q" => null, "1-R" => null, "1-S" => null, "1-T" => null, "1-U" => null, "1-V" => null, "1-W" => null, "1-X" => null, "1-Y" => null, "1-Z" => null,
        ];

        foreach ($data as $key => $value) {
            Grafica::where('grafica_id', 1)->where('codigo', $key)->update(['valor' => $value]);
        }*/
    }

    public function store(Request $request)
    {
        $jsonData = json_encode($request->cellValues);
        $grafica = Grafica::findOrFail(1);
        $grafica->valor = $jsonData;
        $grafica->update();
        return $jsonData;
        Grafica::where('grafica_id', 1)->update(['valor' => null]);
        $data = array_filter($request->cellValues, function ($value) {
            return $value !== null;
        });
        foreach ($data as $key => $value) {
            Grafica::where('grafica_id', 1)->where('codigo', $key)->update(['valor' => $value]);
        }
        return  $data;
    }

    public function show($id)
    {
        //
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
