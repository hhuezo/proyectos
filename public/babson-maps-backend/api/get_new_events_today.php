<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);

$student_id=$_POST['student_id']; 

// $pasword=$_POST['password']; 




$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel1=$con->prepare("SELECT ifnull(count(*),0) as cuenta FROM schedule_event s where student_id='$student_id' and date = current_date()");
$sel1->execute();
$res1=$sel1->get_result();
    while ($row1 = $res1->fetch_assoc()) {
        $cuenta = $row1['cuenta'];
    }
$res1->close();

if ($cuenta > 0) {
    $sel=$con->prepare("SELECT 0 as val, 'Exito' as mensaje, s.id, s.location_id, s.student_id, s.name, s.date, s.start_time, s.end_time, s.building, s.classroom, p.latitud, p.longitud, p.name as destination FROM schedule_event s
    LEFT OUTER JOIN puntos p ON s.location_id=p.id where student_id='$student_id' and date = current_date()");
    $sel->execute();
    $res=$sel->get_result();
    
    while ($row = $res->fetch_assoc()) {
        $response[] = $row;

    
    }
    $res->close();
}
else{
    //$response = array('val'=>'1','mensaje'=>'Error','id'=>0,'location_id'=>0,'student_id'=>0,'name'=>'','days'=>'','start_time'=>'','end_time'=>'','building'=>'','classroom'=>''); 
    $response = array('val'=>'1','mensaje'=>'Error','id'=>0,'location_id'=>0,'student_id'=>0,'name'=>'','days'=>'','start_time'=>'','end_time'=>'','building'=>'','classroom'=>'','latitud'=>'','longitud'=>'','destination'=>''); 
}


echo json_encode($response);

$con->close();

?>