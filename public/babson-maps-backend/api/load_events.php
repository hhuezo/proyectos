<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Content-Type:application/json");

$timezone='America/El_Salvador';
date_default_timezone_set($timezone);

$now = date('Y-m-d H:i:s', time());  

$_POST = json_decode(file_get_contents('php://input'),true);
$user_id=$_POST['user_id'];    

//echo "user_id=$user_id";


$con=new mysqli('localhost','roadmap_ow','rm2022$tc','roadmap');
$con->set_charset('utf-8');

$sel1=$con->prepare("SELECT count(*) as cuenta FROM eventos e
                        LEFT OUTER JOIN puntos p ON e.id_place=p.id
                        inner join event_users eu on e.id=eu.event_id and eu.user_id='$user_id'
                        where date <=DATE_ADD(current_date(), INTERVAL 1 DAY) and p.category_id=1
                        order by e.name");
$sel1->execute();
$res1=$sel1->get_result();
    while ($row1 = $res1->fetch_assoc()) {
        $cuenta = $row1['cuenta'];
    }
$res1->close();


//echo "cuenta=$cuenta";


if ($cuenta > 0) {
    $sel=$con->prepare("SELECT e.id, e.name, p.name as place, e.date, e.description, e.id_place, p.latitud, p.longitud, p.category_img FROM eventos e
                            LEFT OUTER JOIN puntos p ON e.id_place=p.id
                            inner join event_users eu on e.id=eu.event_id and eu.user_id='$user_id'
                            where date <=DATE_ADD(current_date(), INTERVAL 1 DAY) and p.category_id=1
                            order by name");
    $sel->execute();
    $res=$sel->get_result();
    
    while ($row = $res->fetch_assoc()) {
        $response[] = $row;

    
    }
    $res->close();
}

echo json_encode($response);

$con->close();


?>