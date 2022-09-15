<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include 'db.php';
$query = "SELECT * FROM foods";
if (isset($_GET['id'])) {
    $query = "SELECT * from products where id=" . $_GET['id'];
}
$run = mysqli_query($db, $query) or die(mysqli_error($db));
if (mysqli_num_rows($run) > 0) {
    $i = 0;
    while ($val = mysqli_fetch_assoc($run)) {
        $food[$i]['id'] = $val['id'];
        $food[$i]['food_name'] = $val['food_name'];
        $food[$i]['food_price'] = $val['food_price'];
        $i = $i + 1;
    }
    echo json_encode(['status' => true, 'message' => 'success', 'data' => $food]);

} else {
    echo json_encode(["status" => false, 'message' => 'Faild']);
}
