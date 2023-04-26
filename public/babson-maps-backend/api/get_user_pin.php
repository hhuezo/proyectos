<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);

$student_code=$_POST['student_code']; 




$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel1=$con->prepare("SELECT ifnull(count(*),0) as cuenta FROM users u where active=1 and student_code='$student_code'");
$sel1->execute();
$res1=$sel1->get_result();
    while ($row1 = $res1->fetch_assoc()) {
        $cuenta = $row1['cuenta'];
    }
$res1->close();

if ($cuenta > 0) {
    $sel=$con->prepare("SELECT id, user_name, student_code FROM users u where active=1 and student_code='$student_code'");
    $sel->execute();
    $res=$sel->get_result();
    
    while ($row = $res->fetch_assoc()) {
        $id = $row['id'];
        $user_name = $row['user_name'];
        $student_code = $row['student_code'];    
        }
    $response = array('val'=>'0', 'mensaje'=>'Exito', 'id'=>$id, 'user_name'=>$user_name, 'student_code'=>$student_code);
    $res->close();
}
else{
    $response = array('val'=>'1', 'mensaje'=>'Error', 'id'=>0, 'user_name'=>'', 'student_code'=>'');
}


echo json_encode($response);


$con->close();

?>