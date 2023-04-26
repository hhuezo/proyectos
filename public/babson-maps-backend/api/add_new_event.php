<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

//location_id,student_id,name,days,time,building,classroom


$_POST = json_decode(file_get_contents('php://input'),true);
$place=$_POST['place'];    
$student_id=$_POST['student_id'];    
$name=$_POST['name'];
$date=$_POST['date'];
$start_time=$_POST['start_time'];
$end_time=$_POST['end_time'];
$building=$_POST['building'];
$classroom=$_POST['classroom'];


//$con=new mysqli('localhost','proyectos_ow','proyectos2021','seguimiento_proyectos');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel=$con->prepare("SELECT id as id_place, latitud, longitud FROM puntos p where name='$place' and categories='All Categories' limit 1");
$sel->execute();
$res=$sel->get_result();

while ($row = $res->fetch_assoc()) {
    $location_id = $row['id_place'];
    $latitud = $row['latitud'];
    $longitud = $row['longitud'];    
}
$res->close();






    $sel=$con->prepare("INSERT INTO schedule_event(location_id,student_id,name,date,start_time,end_time,building,classroom)values('$location_id','$student_id','$name','$date','$start_time','$end_time','$building','$classroom')");
    
    $sel->execute();



    
  //echo $days[$x]."<br>";

// $str_days = ltrim($str_days, ',');
// $str_days = ltrim($str_days, ' ');

//echo $str_days;


//echo "INSERT INTO eventos(name,date,description,id_place)VALUES('$name','$date','$description','$id_place')";




    if ($sel->errno=='0'){
        $response = array('val'=>'0', 'mensaje'=>'Registro creado correctamente','location_id'=>$location_id,'latitud'=>$latitud,'longitud'=>$longitud);
    }else{
        $response = array('val'=>'1', 'mensaje'=>$sel->error,'location_id'=>0,'latitud'=>'','longitud'=>'');
    }

    
    
    //$res=$sel->get_result();
    //throw $th;
    

echo json_encode($response);

$con->close();
?>