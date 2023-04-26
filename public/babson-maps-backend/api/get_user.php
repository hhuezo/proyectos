<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);

$user_name=$_POST['user_name']; 
$pasword=$_POST['password']; 




$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel1=$con->prepare("SELECT ifnull(count(*),0) as cuenta FROM users u where active=1 and user_name='$user_name' and password='$pasword'");
$sel1->execute();
$res1=$sel1->get_result();
    while ($row1 = $res1->fetch_assoc()) {
        $cuenta = $row1['cuenta'];
    }
$res1->close();

if ($cuenta > 0) {
    $sel=$con->prepare("SELECT id, first_name, second_name, last_name, user_name, student_code, email, password, user_photo, background_photo, year_birth FROM users u where active=1 and user_name='$user_name' and password='$pasword'");
    $sel->execute();
    $res=$sel->get_result();
    
    while ($row = $res->fetch_assoc()) {
        $id = $row['id'];
        $first_name = $row['first_name'];
        $second_name = $row['second_name'];
        $last_name = $row['last_name'];
        $user_name = $row['user_name'];
        $student_code = $row['student_code'];    
        $email = $row['email'];
        $password = $row['password'];
        $user_photo = $row['user_photo'];    
        $background_photo = $row['background_photo'];   
        $year_birth = $row['year_birth'];   
         
        }
    $response = array('val'=>'0', 'mensaje'=>'Exito', 'id'=>$id, 'first_name'=>$first_name, 'second_name'=>$second_name, 'last_name'=>$last_name, 'user_name'=>$user_name, 'student_code'=>$student_code, 'email'=>$email, 'password'=>$password, 'user_photo'=>$user_photo, 'background_photo'=>$background_photo, 'year_birth'=>$year_birth);
    $res->close();
}
else{
    $response = array('val'=>'1', 'mensaje'=>'Error', 'id'=>0, 'first_name'=>'', 'second_name'=>'', 'last_name'=>'', 'user_name'=>'', 'student_code'=>'', 'email'=>'', 'password'=>'', 'user_photo'=>'', 'background_photo'=>'', 'year_birth'=>'');
}


echo json_encode($response);


$con->close();

?>
