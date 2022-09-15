<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');

include 'db.php';
error_reporting(0);
$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$student_name = $data['student_name'];
$age = $data['age'];
$city = $data['city'];

$sql = "UPDATE students SET student_name = '{$student_name}',age ='{$age}' ,city = '{$city}' WHERE id = '{$id}'";

if (mysqli_query($db, $sql)) {
    echo json_encode(['status' => true, 'message' => 'Update student success']);
} else {
    echo json_encode(['status' => false, 'message' => 'Update faild']);
}
