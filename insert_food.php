<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include 'db.php';
if ($data->food_name == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Food_name not provide']);
} else if ($data->food_price == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Food_price not provide']);
} else {
    $query = "INSERT INTO foods(food_name,food_price)";
    $query .= "VALUES('$data->food_name',$data->food_price)";
    $run = mysqli_query($db, $query) or die(mysqli_error($db));
    if ($run) {
        echo json_encode(['status' => true, 'message' => 'Food Addedd!']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Food NOT Addedd!']);
    }

}
