<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();
$mylogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
if (isset($_POST['addval'])) { $addval = $_POST['addval']; if ($addval == '') { unset($addval);} }
if (isset($_POST['addrel'])) { $addrel = $_POST['addrel']; if ($addrel == '') { unset($addrel);} } 
if (isset($_POST['addrep'])) { $addrep = $_POST['addrep']; if ($addrep == '') { unset($addrep);} }
if (isset($_POST['addksm'])) { $addksm = $_POST['addksm']; if ($addksm == '') { unset($addksm);} }  
if (isset($_POST['addtext'])) { $addtext = $_POST['addtext']; if ($addtext == '') { unset($addtext);} }  

$addval = stripslashes($addval);
$addval = htmlspecialchars($addval);
$addval = trim($addval);

$addrel = stripslashes($addrel);
$addrel = htmlspecialchars($addrel);
$addrel = trim($addrel);

$addrep = stripslashes($addrep);
$addrep = htmlspecialchars($addrep);
$addrep = trim($addrep);

$addksm = stripslashes($addksm);
$addksm = htmlspecialchars($addksm);
$addksm = trim($addksm);


include ("bd.php");

 // проверка на существование оценки пользователя
$result  = $pdo -> query("SELECT exp_login FROM quality1 WHERE exp_login ='$mylogin'");
$myrow = $result->fetch(PDO::FETCH_LAZY);
if (!empty($myrow['expid'])) {
	echo "<script>alert(\"Извините, вы уже добавляли оценку, вы можете ее изменить, или удалить.\");</script>"; 
	exit(header("Location: ".$_SERVER['HTTP_REFERER']));
}
else{
 // если такого нет, то сохраняем данные
	$result2 = $pdo -> query ("INSERT INTO quality1 (exp_login,val,rel,rep,ksm,textcom) VALUES('$mylogin','$addval','$addrel','$addrep','$addksm','$addtext')");
	header("Location: ".$_SERVER['HTTP_REFERER']);
}


?>