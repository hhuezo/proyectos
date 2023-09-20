<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Actividad;

class ActividadActual extends Component
{

    public $registros ,$busqueda ="";
    public function render()
    {

        $busqueda_temp = $this->busqueda;
        $sql =  "select id,user_name,name from users where (user_name like '%".$busqueda_temp."%' or  name like '%".$busqueda_temp."%') and users.unidad_id =? and (users.rol_id in (2,5)  or users.id in (17,22)) order by user_name";

        $this->registros = DB::select($sql, array(auth()->user()->unidad_id));

        foreach($this->registros as $obj)
        {
            $actividad = Actividad::where('users_id','=',$obj->id)->where('estado_id','=',3)->first();
            if($actividad )
            {
                $obj->actividad = $actividad->descripcion;
                $obj->porcentaje = $actividad->porcentaje;
            }
            else{
                $obj->actividad = "";
                $obj->porcentaje = "";
            }
        }

        return view('livewire.actividad-actual');
    }
}
