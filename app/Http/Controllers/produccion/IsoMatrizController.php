<?php

namespace App\Http\Controllers\produccion;

use App\Http\Controllers\Controller;
use App\iso\Documento;
use App\iso\DocumentoTitulo;
use Exception;
use Illuminate\Http\Request;

class IsoMatrizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documentos_titulo = DocumentoTitulo::get();
        $colores = ["light-primary-bg","light-info-bg","light-success-bg","light-warning-bg","light-danger-bg","bg-careys-pink","bg-warning"];
        return view('produccion.iso.index', compact('documentos_titulo','colores'));
    }

    public function store(Request $request)
    {
        $documento = new Documento();
        $documento->nombre = $request->nombre;
        $documento->documento_iso_titulo_id = $request->documento_iso_titulo_id;

        if ($request->file('archivo')) {

            $file = $request->file('archivo');
            $id_file = uniqid();
            $file->move(public_path("iso/"), $id_file . ' ' . $file->getClientOriginalName());
            $documento->ruta = $id_file . ' ' . $file->getClientOriginalName();
        }

        $documento->save();
        alert()->success('El registro ha sido agregado correctamente');
        return back();
    }

    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);
        $documento->nombre = $request->nombre;

        if ($request->file('archivo')) {

            try {
                unlink(public_path("iso/") . $documento->url);
            } catch (Exception $e) {
                //return $e->getMessage();
            }

            $file = $request->file('archivo');
            $id_file = uniqid();
            $file->move(public_path("iso/"), $id_file . ' ' . $file->getClientOriginalName());
            $documento->ruta = $id_file . ' ' . $file->getClientOriginalName();
        }

        $documento->update();
        alert()->success('El registro ha sido modificado correctamente');
        return back();
    }

    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->activo = false;
        $documento->update();
        alert()->success('El registro ha sido eliminado correctamente');
        return back();
    }

    public function iso2022()
    {
        return view('produccion.iso.iso2022');
    }
}
