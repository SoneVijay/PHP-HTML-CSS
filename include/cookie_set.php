<?php
$cookie_name = $username;
SETCOOKIE("User", $cookie_name, time() + (5), "/"); // 86400 = 1 day
?>