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

$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel1=$con->prepare("SELECT ifnull(count(*),0) as cuenta FROM users u where active=1 and user_name='$user_name'");
$sel1->execute();
$res1=$sel1->get_result();
    while ($row1 = $res1->fetch_assoc()) {
        $cuenta = $row1['cuenta'];
    }
$res1->close();

if ($cuenta > 0) {
    $sel=$con->prepare("UPDATE users SET password='$password' where user_name='$user_name'");
    $sel->execute();


    $sel->execute();


    if ($sel->errno=='0'){
        $response = array('val'=>'0', 'mensaje'=>'Clave reseteada correctamente');
    }else{
        $response = array('val'=>'1', 'mensaje'=>$sel->error);
    }
}

echo json_encode($response);

$con->close();

?>