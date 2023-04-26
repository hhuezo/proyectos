<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);

$id_user=$_POST['id_user']; 
$first_name=$_POST['first_name']; 
$second_name=$_POST['second_name'];  
$last_name=$_POST['last_name']; 
$user_name=$_POST['user_name']; 
$student_code=$_POST['student_code']; 
$email=$_POST['email']; 
$password=$_POST['password']; 
$year_birth=$_POST['year_birth']; 

$foto_rostro=$_POST['foto_rostro']; 
$foto_fondo=$_POST['foto_fondo']; 




//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');



//echo "INSERT INTO eventos(name,date,description,id_place)VALUES('$name','$date','$description','$id_place')";


    $sel=$con->prepare("UPDATE users SET first_name='$first_name', second_name='$second_name', last_name='$last_name', user_name='$user_name', student_code='$student_code',
                            email='$email', password='$password', user_photo='$foto_rostro',background_photo='$foto_fondo',year_birth='$year_birth' where id='$id_user'");
    
    //echo "INSERT INTO users(full_name,user_name,student_code,email,password,user_photo,background_foto,active)values('$full_name','$user_name','$student_code','$email','$clave','$foto_rostro','$foto_fondo','$active'";

    $sel->execute();


    if ($sel->errno=='0'){
        $response = array('val'=>'0', 'mensaje'=>'Registro actualizado correctamente');
    }else{
        $response = array('val'=>'1', 'mensaje'=>$sel->error);
    }

    
    //$res=$sel->get_result();
    //throw $th;
    

echo json_encode($response);

$con->close();
?>