<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();

if (isset($_POST['addlogin'])) { $addlogin = $_POST['addlogin']; if ($addlogin == '') { unset($addlogin);} }
if (isset($_POST['addpassword'])) { $addpassword = $_POST['addpassword']; if ($addpassword == '') { unset($addpassword);} } 
if (isset($_POST['addrole'])) { $addrole = $_POST['addrole']; if ($addrole == '') { unset($addrole);} } 
$addlogin = stripslashes($addlogin);
$addlogin = htmlspecialchars($addlogin);
$addlogin = trim($addlogin);

$addpassword = stripslashes($addpassword);
$addpassword = htmlspecialchars($addpassword);
$addpassword = trim($addpassword);

include ("bd.php");
$result2 = $pdo -> query ("INSERT INTO users (login,password,role) VALUES('$addlogin','$addpassword','$addrole')");

header("Location: ".$_SERVER['HTTP_REFERER']);

?>