<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include 'db.php';
if ($data->discount == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Discount not provide']);
} else if ($data->stock == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Stock not provide']);
} else if ($data->product_name == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Product_name not provide']);
} else if ($data->product_price == '') {
    echo json_encode(['status' => 'Faild', 'message' => 'Product_price not provide']);
} else {
    $query = "INSERT INTO products(product_name,product_price,stock,discount)";
    $query .= "VALUES('$data->product_name',$data->product_price,$data->stock,$data->discount)";
    $run = mysqli_query($db, $query);
    if ($run) {
        echo json_encode(['status' => 'success', 'message' => 'Product Addedd!']);
    } else {
        echo json_encode(['status' => 'Faild', 'message' => 'Product NOT Addedd!']);
    }

}
