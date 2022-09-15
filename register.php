<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Headers:Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');
require_once 'db.php';
$full_name = $_POST['full_name'];
$user_name = $_POST['user_name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$error;
if (empty($full_name)) {
    $error = "Full_name not required";
} else if (empty($user_name)) {
    $error = "User_name not required";
} else if (empty($password)) {
    $error = "Password not required";
} else if (empty($email)) {
    $error = "Email not required";
} else if (empty($mobile)) {
    $error = "Mobile not required";
} else {

    $already_exits_val = mysqli_query($db, "SELECT * FROM users WHERE mobile='$mobile'OR user_name='$user_name'");
    if (mysqli_num_rows($already_exits_val) == 0) {

        $insert_query = "INSERT INTO users (full_name, user_name, password, email,mobile)
        VALUES('$full_name','$user_name','$password','$email','$mobile')";
        $query = mysqli_query($db, $insert_query);
        if ($query) {
            $user_id = mysqli_insert_id($db);
            $response['status'] = true;
            $response['message'] = 'Register sucessfully';
        } else {
            $response['status'] = false;
            $response['message'] = 'Register faild';
        }
    } else {
        $response['status'] = false;
        $response['message'] = 'Already mobile number or user_name exits. Please do login';
    }
    echo json_encode($response);
}
