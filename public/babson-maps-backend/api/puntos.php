
<?php

switch($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'),true);
        echo "guardar el punto: ".$_POST['nombre'];        
        break;
    case 'GET':
        echo "Obtener puntos(s)";
        break;
    case 'PUT':
        echo "Actualizar punto";
        break;
    case 'DELETE':
        echo "eliminar punto";
        break;                                                      
}



?>

