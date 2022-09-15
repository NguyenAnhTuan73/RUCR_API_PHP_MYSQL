<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');

error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include 'db.php';
if ($data->id) {
    $query2 = "SELECT * from products where id=" . $data->id;
    $run2 = mysqli_query($db, $query2);
    $product = mysqli_fetch_assoc($run2);
    $product_name = $product['product_name'];
    $product_price = $product['product_price'];
    $stock = $product['stock'];
    $discount = $product['discount'];

    if ($data->discount != '') {
        $discount = $data->discount;
    }
    if ($data->stock != '') {
        $stock = $data->stock;
    }
    if ($data->product_name != '') {
        $product_name = $data->product_name;
    }
    if ($data->product_price != '') {
        $product_price = $data->product_price;
    }

    $query = "UPDATE products SET
    product_name='$product_name', product_price='$product_price', stock='$stock',discount='$discount'
    WHERE id=$data->id";

    $run = mysqli_query($db, $query);
    if ($run) {
        echo json_encode(['status' => 'success', 'message' => 'Update success']);
    } else {
        echo json_encode(['status' => 'faild', 'message' => 'Update product faild']);
    }

} else {
    echo json_encode(['status' => 'faild', 'message' => 'User id is not given']);
}
