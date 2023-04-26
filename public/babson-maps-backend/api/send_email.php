<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);
$user_name=$_POST['user_name'];    
$password=$_POST['password'];    
$to=$_POST['to'];


//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');



//echo "INSERT INTO eventos(name,date,description,id_place)VALUES('$name','$date','$description','$id_place')";


    // $sel=$con->prepare("INSERT INTO eventos(name,date,description,id_place,created_at,updated_at)VALUES('$name','$date','$description','$id_place','$now','$now')");
    
    // $sel->execute();


    // if ($sel->errno=='0'){
    //     $response = array('val'=>'0', 'mensaje'=>'Registro creado correctamente');
    // }else{
    //     $response = array('val'=>'1', 'mensaje'=>$sel->error);
    // }

    
    //$res=$sel->get_result();
    //throw $th;
    

    $response = array('val'=>'0', 'mensaje'=>'Exito', 'user_name'=>$user_name, 'password'=>$password);
    

echo json_encode($response);

$con->close();
?>