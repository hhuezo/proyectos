<?php

namespace App\Http\Controllers;

use App\iso\Grafica;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function __construct()
    {
          $this->middleware('auth');
    }
    public function index()
    {

        $graficas = Grafica::where('unidades_id',auth()->user()->unidad_id)->get();

        $tipoGrafica = ["","column","pie"];

        foreach ($graficas as $data) {

            //$data = Grafica::findOrFail(1);
            $jsonData  = $data->valor;
            $grafica = json_decode($jsonData, true);


            $encabezados = [];


            // Iterar sobre las columnas B a Z
            foreach (range('B', 'Z') as $letra) {

                try {
                    $encabezado = $grafica["0-$letra"];
                } catch (Exception $e) {
                }



                // Verificar si el encabezado no es nulo antes de agregarlo al array
                if ($encabezado !== null) {
                    $encabezados[] = $encabezado;
                }
            }

            $data_grafico = [];


            // Iterar sobre las filas desde la 1
            for ($fila = 1; $fila <= 24; $fila++) {
                // Obtener el nombre de la fila actual

                try {
                    $nombreFila = $grafica["$fila-A"];
                } catch (Exception $e) {
                }

                // Continuar solo si el nombre de la fila no es nulo
                if ($nombreFila !== null) {
                    // Inicializar un arreglo para la fila actual
                    $filaActual = ["name" => $nombreFila, "data" => []];

                    // Iterar sobre las columnas B a Z
                    foreach (range('B', 'Z') as $letra) {

                        try {
                            // Obtener el valor de la celda actual
                            $valor = $grafica["$fila-$letra"];
                        } catch (Exception $e) {
                        }

                        // Agregar el valor al arreglo de la fila actual si no es nulo
                        if ($valor !== null) {
                            $filaActual["data"][] = $valor + 0;
                        }
                    }

                    // Agregar la fila al arreglo principal
                    $data_grafico[] = $filaActual;
                }
            }

            $data->data_grafico =  $data_grafico;
            $data->encabezado =  $encabezados;
            $data->tipo_grafico =  $tipoGrafica[$data->tipo_grafica_id];
        }


        return view('dashboard.index', compact('graficas',));
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function store(Request $request)
    {

        $jsonData = '{"0-A":null,"0-B":"ENE","0-C":"FEB","0-D":null,"0-E":null,"0-F":null,"0-G":null,"0-H":null,"0-I":null,"0-J":null,"0-K":null,"0-L":null,"0-M":null,"0-N":null,"0-O":null,"0-P":null,"0-Q":null,"0-R":null,"0-S":null,"0-T":null,"0-U":null,"0-V":null,"0-W":null,"0-X":null,"0-Y":null,"0-Z":null,"1-A":"TEST","1-B":"6503","1-C":"3368","1-D":null,"1-E":null,"1-F":null,"1-G":null,"1-H":null,"1-I":null,"1-J":null,"1-K":null,"1-L":null,"1-M":null,"1-N":null,"1-O":null,"1-P":null,"1-Q":null,"1-R":null,"1-S":null,"1-T":null,"1-U":null,"1-V":null,"1-W":null,"1-X":null,"1-Y":null,"1-Z":null,"2-A":null,"2-B":null,"2-C":null,"2-D":null,"2-E":null,"2-F":null,"2-G":null,"2-H":null,"2-I":null,"2-J":null,"2-K":null,"2-L":null,"2-M":null,"2-N":null,"2-O":null,"2-P":null,"2-Q":null,"2-R":null,"2-S":null,"2-T":null,"2-U":null,"2-V":null,"2-W":null,"2-X":null,"2-Y":null,"2-Z":null,"3-A":null,"3-B":null,"3-C":null,"3-D":null,"3-E":null,"3-F":null,"3-G":null,"3-H":null,"3-I":null,"3-J":null,"3-K":null,"3-L":null,"3-M":null,"3-N":null,"3-O":null,"3-P":null,"3-Q":null,"3-R":null,"3-S":null,"3-T":null,"3-U":null,"3-V":null,"3-W":null,"3-X":null,"3-Y":null,"3-Z":null,"4-A":null,"4-B":null,"4-C":null,"4-D":null,"4-E":null,"4-F":null,"4-G":null,"4-H":null,"4-I":null,"4-J":null,"4-K":null,"4-L":null,"4-M":null,"4-N":null,"4-O":null,"4-P":null,"4-Q":null,"4-R":null,"4-S":null,"4-T":null,"4-U":null,"4-V":null,"4-W":null,"4-X":null,"4-Y":null,"4-Z":null,"5-A":null,"5-B":null,"5-C":null,"5-D":null,"5-E":null,"5-F":null,"5-G":null,"5-H":null,"5-I":null,"5-J":null,"5-K":null,"5-L":null,"5-M":null,"5-N":null,"5-O":null,"5-P":null,"5-Q":null,"5-R":null,"5-S":null,"5-T":null,"5-U":null,"5-V":null,"5-W":null,"5-X":null,"5-Y":null,"5-Z":null,"6-A":null,"6-B":null,"6-C":null,"6-D":null,"6-E":null,"6-F":null,"6-G":null,"6-H":null,"6-I":null,"6-J":null,"6-K":null,"6-L":null,"6-M":null,"6-N":null,"6-O":null,"6-P":null,"6-Q":null,"6-R":null,"6-S":null,"6-T":null,"6-U":null,"6-V":null,"6-W":null,"6-X":null,"6-Y":null,"6-Z":null,"7-A":null,"7-B":null,"7-C":null,"7-D":null,"7-E":null,"7-F":null,"7-G":null,"7-H":null,"7-I":null,"7-J":null,"7-K":null,"7-L":null,"7-M":null,"7-N":null,"7-O":null,"7-P":null,"7-Q":null,"7-R":null,"7-S":null,"7-T":null,"7-U":null,"7-V":null,"7-W":null,"7-X":null,"7-Y":null,"7-Z":null,"8-A":null,"8-B":null,"8-C":null,"8-D":null,"8-E":null,"8-F":null,"8-G":null,"8-H":null,"8-I":null,"8-J":null,"8-K":null,"8-L":null,"8-M":null,"8-N":null,"8-O":null,"8-P":null,"8-Q":null,"8-R":null,"8-S":null,"8-T":null,"8-U":null,"8-V":null,"8-W":null,"8-X":null,"8-Y":null,"8-Z":null,"9-A":null,"9-B":null,"9-C":null,"9-D":null,"9-E":null,"9-F":null,"9-G":null,"9-H":null,"9-I":null,"9-J":null,"9-K":null,"9-L":null,"9-M":null,"9-N":null,"9-O":null,"9-P":null,"9-Q":null,"9-R":null,"9-S":null,"9-T":null,"9-U":null,"9-V":null,"9-W":null,"9-X":null,"9-Y":null,"9-Z":null,"10-A":null,"10-B":null,"10-C":null,"10-D":null,"10-E":null,"10-F":null,"10-G":null,"10-H":null,"10-I":null,"10-J":null,"10-K":null,"10-L":null,"10-M":null,"10-N":null,"10-O":null,"10-P":null,"10-Q":null,"10-R":null,"10-S":null,"10-T":null,"10-U":null,"10-V":null,"10-W":null,"10-X":null,"10-Y":null,"10-Z":null,"11-A":null,"11-B":null,"11-C":null,"11-D":null,"11-E":null,"11-F":null,"11-G":null,"11-H":null,"11-I":null,"11-J":null,"11-K":null,"11-L":null,"11-M":null,"11-N":null,"11-O":null,"11-P":null,"11-Q":null,"11-R":null,"11-S":null,"11-T":null,"11-U":null,"11-V":null,"11-W":null,"11-X":null,"11-Y":null,"11-Z":null,"12-A":null,"12-B":null,"12-C":null,"12-D":null,"12-E":null,"12-F":null,"12-G":null,"12-H":null,"12-I":null,"12-J":null,"12-K":null,"12-L":null,"12-M":null,"12-N":null,"12-O":null,"12-P":null,"12-Q":null,"12-R":null,"12-S":null,"12-T":null,"12-U":null,"12-V":null,"12-W":null,"12-X":null,"12-Y":null,"12-Z":null,"13-A":null,"13-B":null,"13-C":null,"13-D":null,"13-E":null,"13-F":null,"13-G":null,"13-H":null,"13-I":null,"13-J":null,"13-K":null,"13-L":null,"13-M":null,"13-N":null,"13-O":null,"13-P":null,"13-Q":null,"13-R":null,"13-S":null,"13-T":null,"13-U":null,"13-V":null,"13-W":null,"13-X":null,"13-Y":null,"13-Z":null,"14-A":null,"14-B":null,"14-C":null,"14-D":null,"14-E":null,"14-F":null,"14-G":null,"14-H":null,"14-I":null,"14-J":null,"14-K":null,"14-L":null,"14-M":null,"14-N":null,"14-O":null,"14-P":null,"14-Q":null,"14-R":null,"14-S":null,"14-T":null,"14-U":null,"14-V":null,"14-W":null,"14-X":null,"14-Y":null,"14-Z":null,"15-A":null,"15-B":null,"15-C":null,"15-D":null,"15-E":null,"15-F":null,"15-G":null,"15-H":null,"15-I":null,"15-J":null,"15-K":null,"15-L":null,"15-M":null,"15-N":null,"15-O":null,"15-P":null,"15-Q":null,"15-R":null,"15-S":null,"15-T":null,"15-U":null,"15-V":null,"15-W":null,"15-X":null,"15-Y":null,"15-Z":null,"16-A":null,"16-B":null,"16-C":null,"16-D":null,"16-E":null,"16-F":null,"16-G":null,"16-H":null,"16-I":null,"16-J":null,"16-K":null,"16-L":null,"16-M":null,"16-N":null,"16-O":null,"16-P":null,"16-Q":null,"16-R":null,"16-S":null,"16-T":null,"16-U":null,"16-V":null,"16-W":null,"16-X":null,"16-Y":null,"16-Z":null,"17-A":null,"17-B":null,"17-C":null,"17-D":null,"17-E":null,"17-F":null,"17-G":null,"17-H":null,"17-I":null,"17-J":null,"17-K":null,"17-L":null,"17-M":null,"17-N":null,"17-O":null,"17-P":null,"17-Q":null,"17-R":null,"17-S":null,"17-T":null,"17-U":null,"17-V":null,"17-W":null,"17-X":null,"17-Y":null,"17-Z":null,"18-A":null,"18-B":null,"18-C":null,"18-D":null,"18-E":null,"18-F":null,"18-G":null,"18-H":null,"18-I":null,"18-J":null,"18-K":null,"18-L":null,"18-M":null,"18-N":null,"18-O":null,"18-P":null,"18-Q":null,"18-R":null,"18-S":null,"18-T":null,"18-U":null,"18-V":null,"18-W":null,"18-X":null,"18-Y":null,"18-Z":null,"19-A":null,"19-B":null,"19-C":null,"19-D":null,"19-E":null,"19-F":null,"19-G":null,"19-H":null,"19-I":null,"19-J":null,"19-K":null,"19-L":null,"19-M":null,"19-N":null,"19-O":null,"19-P":null,"19-Q":null,"19-R":null,"19-S":null,"19-T":null,"19-U":null,"19-V":null,"19-W":null,"19-X":null,"19-Y":null,"19-Z":null,"20-A":null,"20-B":null,"20-C":null,"20-D":null,"20-E":null,"20-F":null,"20-G":null,"20-H":null,"20-I":null,"20-J":null,"20-K":null,"20-L":null,"20-M":null,"20-N":null,"20-O":null,"20-P":null,"20-Q":null,"20-R":null,"20-S":null,"20-T":null,"20-U":null,"20-V":null,"20-W":null,"20-X":null,"20-Y":null,"20-Z":null,"21-A":null,"21-B":null,"21-C":null,"21-D":null,"21-E":null,"21-F":null,"21-G":null,"21-H":null,"21-I":null,"21-J":null,"21-K":null,"21-L":null,"21-M":null,"21-N":null,"21-O":null,"21-P":null,"21-Q":null,"21-R":null,"21-S":null,"21-T":null,"21-U":null,"21-V":null,"21-W":null,"21-X":null,"21-Y":null,"21-Z":null,"22-A":null,"22-B":null,"22-C":null,"22-D":null,"22-E":null,"22-F":null,"22-G":null,"22-H":null,"22-I":null,"22-J":null,"22-K":null,"22-L":null,"22-M":null,"22-N":null,"22-O":null,"22-P":null,"22-Q":null,"22-R":null,"22-S":null,"22-T":null,"22-U":null,"22-V":null,"22-W":null,"22-X":null,"22-Y":null,"22-Z":null,"23-A":null,"23-B":null,"23-C":null,"23-D":null,"23-E":null,"23-F":null,"23-G":null,"23-H":null,"23-I":null,"23-J":null,"23-K":null,"23-L":null,"23-M":null,"23-N":null,"23-O":null,"23-P":null,"23-Q":null,"23-R":null,"23-S":null,"23-T":null,"23-U":null,"23-V":null,"23-W":null,"23-X":null,"23-Y":null,"23-Z":null,"24-A":null,"24-B":null,"24-C":null,"24-D":null,"24-E":null,"24-F":null,"24-G":null,"24-H":null,"24-I":null,"24-J":null,"24-K":null,"24-L":null,"24-M":null,"24-N":null,"24-O":null,"24-P":null,"24-Q":null,"24-R":null,"24-S":null,"24-T":null,"24-U":null,"24-V":null,"24-W":null,"24-X":null,"24-Y":null,"24-Z":null}';

        $grafica = new Grafica();
        $grafica->titulo = $request->titulo;
        $grafica->tipo_grafica_id = $request->tipo_grafica_id;
        $grafica->descripcion = $request->descripcion;
        $grafica->linea_estandar = $request->linea_estandar;
        $grafica->valor = $jsonData;
        $grafica->unidades_id = auth()->user()->unidad_id;
        $grafica->save();

        return back();

    }

    public function show($id)
    {
        $data = Grafica::findOrFail($id);
        $jsonData  = $data->valor;
        $grafica = json_decode($jsonData, true);

        return view('dashboard.show', compact('grafica', 'id'));
    }

    public function edit($id)
    {
        try {
            $grafica = Grafica::select('id','titulo','descripcion','linea_estandar')->findOrFail($id);
            return response()->json($grafica);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Grafica no encontrada'], 404);
        }
        /*$jsonData  = $grafica->valor;
        $data = json_decode($jsonData, true);

        return view('dashboard.edit', compact('grafica', 'data'));*/
    }

    public function update_grafica(Request $request)
    {
        $grafica = Grafica::findOrFail($request->id);
        $grafica->titulo = $request->titulo;
        $grafica->tipo_grafica_id = $request->tipo_grafica_id;
        $grafica->descripcion = $request->descripcion;
        $grafica->linea_estandar = $request->linea_estandar;
        $grafica->save();
        return back();
        return Redirect::to('dashboard/');
    }

    public function update(Request $request, $id)
    {
        $jsonData = json_encode($request->cellValues);
        $grafica = Grafica::findOrFail($id);
        $grafica->valor = $jsonData;
        $grafica->update();
        return $jsonData;
    }


    public function destroy($id)
    {
        $grafica = Grafica::findOrFail($id);
        $grafica->delete();
        return back();
    }
}
