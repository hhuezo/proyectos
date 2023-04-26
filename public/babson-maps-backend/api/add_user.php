<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);

$password=$_POST['password']; 
$year_birth=$_POST['year_birth']; 
$email=$_POST['email']; 
$foto_fondo=$_POST['foto_fondo']; 
$foto_rostro=$_POST['foto_rostro']; 
$first_name=$_POST['first_name']; 
$second_name=$_POST['second_name']; 
$last_name=$_POST['last_name']; 
$student_code=$_POST['student_code']; 
$user_name=$_POST['user_name']; 
$active=1;


//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');



//echo "INSERT INTO eventos(name,date,description,id_place)VALUES('$name','$date','$description','$id_place')";


    $sel=$con->prepare("INSERT INTO users(first_name,second_name,last_name,user_name,student_code,email,password,year_birth,user_photo,background_photo,active)values('$first_name','$second_name','$last_name','$user_name','$student_code','$email','$password','$year_birth','$foto_rostro','$foto_fondo','$active')");
    
    //echo "INSERT INTO users(full_name,user_name,student_code,email,password,user_photo,background_foto,active)values('$full_name','$user_name','$student_code','$email','$clave','$foto_rostro','$foto_fondo','$active'";

    $sel->execute();

    $sel=$con->prepare("DELETE FROM users WHERE user_name=''");
    $sel->execute();

    if ($sel->errno=='0'){
        $response = array('val'=>'0', 'mensaje'=>'Registro creado correctamente');
    }else{
        $response = array('val'=>'1', 'mensaje'=>$sel->error);
    }

    
    //$res=$sel->get_result();
    //throw $th;
    

echo json_encode($response);

$con->close();
?>