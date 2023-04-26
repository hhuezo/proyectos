<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);
$name=$_POST['name'];    
$date=$_POST['date'];    
$description=$_POST['description'];
$id_place=$_POST['id_place'];
$latitud=$_POST['latitud'];
$longitud=$_POST['longitud'];
$place=$_POST['place'];


//$con=new mysqli('localhost','root','','roadmap');
$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');



//echo "INSERT INTO eventos(name,date,description,id_place)VALUES('$name','$date','$description','$id_place')";


    $sel=$con->prepare("INSERT INTO eventos(name,date,description,id_place,created_at,updated_at,latitud,longitud,place)VALUES('$name','$date','$description','$id_place','$now','$now','$latitud','$longitud','$place')");
    
    $sel->execute();



    $sel2=$con->prepare("SELECT ifnull(max(id),0) as id FROM eventos");
    $sel2->execute();
    $res2=$sel2->get_result();
    
    while ($row2 = $res2->fetch_assoc()) {
        $event_id = $row2['id'];
        
    }

    $res2->close();




    $sel3=$con->prepare("SELECT id FROM users u where active='1'");
    $sel3->execute();
    $res3=$sel3->get_result();
    
    while ($row3 = $res3->fetch_assoc()) {
        $user_id = $row3['id'];
        
        if ($event_id > 0){
            $sel4=$con->prepare("INSERT INTO event_users(event_id,user_id)VALUES('$event_id','$user_id')");
            
            // echo "INSERT INTO event_users(event_id,user_id)VALUES('$event_id','$user_id')";
            // echo "<br>";

            $sel4->execute();
        }

    }

    $res3->close();



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