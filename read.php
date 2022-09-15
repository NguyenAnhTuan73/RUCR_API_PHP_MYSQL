<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
include 'db.php';
$query = "SELECT * FROM products";
if (isset($_GET['id'])) {
    $query = "SELECT * from products where id=" . $_GET['id'];
}
$run = mysqli_query($db, $query);
$products = mysqli_fetch_all($run, MYSQLI_ASSOC);
echo json_encode($products);
