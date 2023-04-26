<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);
$place=$_POST['place'];    




//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT location FROM places p where name='$place' limit 1");
$sel->execute();
$res=$sel->get_result();



 while ($row = $res->fetch_assoc()) {
	  $json_places[] = $row;
	  
	//   $objCon_sel->Ejecutar($sql);
	//   $objCon_sel->Cerrar();
 }
 
 $json_string =  json_encode($json_places);

 
 $json_string = ltrim($json_string, $json_string[0]);
 
 $json_string = substr($json_string, 0, -1);
 
 echo $json_string;
 
 //echo ltrim($json_string, $json_string[strlen($json_string-1)]);
 
$res->close();
$con->close();
  ?>
