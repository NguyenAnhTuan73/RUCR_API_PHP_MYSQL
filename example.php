<?php
echo "Cookies in PHP <br>";
setcookie('name', 'Hoang', time() + 24 * 3600);
if (isset($_COOKIE['name'])) {
    echo $_COOKIE['name'];
}
