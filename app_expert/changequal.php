<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();



$mylogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
if (isset($_POST['updval'])) { $updval = $_POST['updval']; if ($updval == '') { unset($updval);} }
if (isset($_POST['updrel'])) { $updrel = $_POST['updrel']; if ($updrel == '') { unset($updrel);} } 
if (isset($_POST['updrep'])) { $updrep = $_POST['updrep']; if ($updrep == '') { unset($updrep);} }
if (isset($_POST['updksm'])) { $updksm = $_POST['updksm']; if ($updksm == '') { unset($updksm);} }
if (isset($_POST['addtext'])) { $updtext = $_POST['addtext']; if ($updtext == '') { unset($updksm);} }  

$updval = stripslashes($updval);
$updval = htmlspecialchars($updval);
$updval = trim($updval);

$updrel = stripslashes($updrel);
$updrel = htmlspecialchars($updrel);
$updrel = trim($updrel);

$updrep = stripslashes($updrep);
$updrep = htmlspecialchars($updrep);
$updrep = trim($updrep);

$updksm = stripslashes($updksm);
$updksm = htmlspecialchars($updksm);
$updksm = trim($updksm);



include ("bd.php");
$result  = $pdo -> prepare("UPDATE quality1  SET val = '$updval', rel = '$updrel', rep = '$updrep', ksm = '$updksm', textcom = '$updtext' WHERE exp_login ='$mylogin'");
$count = $result->execute();
if($count =='0'){
	echo "Failed !";
}
else{
	echo "Success !";
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>