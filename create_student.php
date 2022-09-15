<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Method:POST');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');

include 'db.php';
error_reporting(0);
$data = json_decode(file_get_contents("php://input"), true);
$id = $_POST['id'];
$student_name = $_POST['student_name'];
$age = $_POST['age'];
$city = $_POST['city'];

$error;
if (empty($student_name)) {
    $error = "student_name not required";
} else if (empty($age)) {
    $error = "age not required";
} elseif (empty($city)) {
    $error = "city not required";
} else {
    $sql_check = "SELECT * FROM students WHERE student_name='$student_name'";
    $run_is_exist = mysqli_query($db, $sql_check);

    if (mysqli_num_rows($run_is_exist) == 0) {
        $sql = "INSERT INTO students ( student_name,age,city) VALUES ('$student_name','$age','$city')";
        if (mysqli_query($db, $sql)) {

            echo json_encode(['status' => true, 'message' => 'Student Record Inserted']);
        } else {
            echo json_encode(['status' => false, 'message' => "Student Record not Inserted"]);
        }

    } else {
        echo json_encode(['status' => false, 'message' => 'student_name is exist']);
    }

}
mysqli_close($db);
