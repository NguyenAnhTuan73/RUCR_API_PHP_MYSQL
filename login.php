<?php

require_once 'db.php';
$user_name = $_POST['user_name'];
$password = $_POST['password'];
$login_query = "SELECT * FROM users WHERE user_name='$user_name' AND password='$password'";
$query = mysqli_query($db, $login_query);
if (mysqli_num_rows($query) > 0) {
    $useObj = mysqli_fetch_assoc($query);
    $response['status'] = true;
    $response['message'] = 'Login sucessfully';
    $response['data'] = $useObj;
} else {
    $response['status'] = false;
    $response['message'] = 'Login faild';
}
header('Content-Type:application/json; charset=UFT-8');
echo json_encode($response);
