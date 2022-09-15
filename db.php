<?php
$db = mysqli_connect('localhost', 'root', '', 'crud_api_php_mysql') or die("Connection Failed");
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
