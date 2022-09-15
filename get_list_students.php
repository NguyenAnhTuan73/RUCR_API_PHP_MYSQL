<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:GET');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
include 'db.php';

$data = json_decode(file_get_contents("php://input"));

$sql = "SELECT * FROM students";
$search = $_GET['search'] ?? '';
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM students where id = $_GET[id]  ";
} else
if (isset($_GET['search']) || isset($_GET['limit'])) {
    $sql = "SELECT * FROM students WHERE student_name LIKE '%$search%' LIMIT $_GET[limit] ";
}

$result = mysqli_query($db, $sql) or die("SQL Query Failed");

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(['status' => true, 'message' => 'Get list students success', 'data' => $output]);
} else {
    echo json_encode(['status' => false, 'message' => 'No Record Found']);
}
mysqli_close($db);
