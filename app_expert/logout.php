<?php
session_start();
unset($_SESSION['name']); // или $_SESSION = array() для очистки всех данных сессии
session_destroy();
echo "<h1> УХАДИ!</h1>";
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("Location: http://$host$uri/$extra");
?>