<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();

if (isset($_POST['searchid'])) { $searchid = $_POST['searchid']; if ($searchid == '') { unset($searchid);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
$searchid = stripslashes($searchid);
$searchid = htmlspecialchars($searchid);
$searchid = trim($searchid);

include ("bd.php");
$result  = $pdo -> prepare("DELETE FROM users WHERE id ='$searchid'");
$count = $result->execute();
if($count =='0'){
	echo "Failed !";
}
else{
	echo "Success !";
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>