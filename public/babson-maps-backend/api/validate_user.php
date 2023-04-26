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



//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT ifnull(count(*),0) as cuenta FROM users u WHERE user_name='$user_name' and password='$password'");
//echo "<br>";

$sel->execute();
$res=$sel->get_result();


if ($res != null) {
while ($row = $res->fetch_assoc()) {
	if ($row['cuenta'] > 0) {
		$response = array('val'=>'0', 'mensaje'=>'Exito');
	}
	else{
		$response = array('val'=>'1', 'mensaje'=>'Error');
	}
 }	
}else{
	$response = array('val'=>'1', 'mensaje'=>'Error');
}
 
 
 echo json_encode($response);
 
$res->close();
$con->close();
?>