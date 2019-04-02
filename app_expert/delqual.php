<?php
session_start();
include ("bd.php");
if (isset($_POST['delbyid'])) { $delbyid = $_POST['delbyid'];if ($delbyid == '') { unset($delbyid);} }
$myid = isset($_SESSION['id']) ? $_SESSION['id'] : '';
$delbyrole = isset($_SESSION['role']) ? $_SESSION['role'] : '';

if($delbyrole  == '1')
{
	echo 'удаляет админ';
	$result1  = $pdo -> prepare("DELETE FROM quality1 WHERE uid ='$delbyid'");
	$count1 = $result1->execute();
	if($count1 =='0'){
		echo "Failed !";
	}
} 
else if($delbyrole  == '2')
{
	echo 'удаляет эксперт';
	$result2  = $pdo -> prepare("DELETE FROM quality1 WHERE expid ='$myid'");
	$count2 = $result2->execute();
	if($count2 =='0'){
		echo "Failed !";
	}
}
else
{
	echo "НИЧЕГО !";
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>