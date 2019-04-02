<?php

if (isset($_POST['sendbyid'])) { $sendbyid = $_POST['sendbyid']; if ($sendbyid == '') { unset($sendbyid);} }
include ("bd.php");
//$olddate  = $pdo -> prepare("DELETE FROM quality1");
//$del = $olddate->execute();

/*$oldtable = $pdo -> query("SELECT * FROM quality2");
$newtable = $pdo -> query("SELECT * FROM quality1");
while ( $rowold = $oldtable ->fetch(PDO::FETCH_LAZY) && $rownew = $newtable ->fetch(PDO::FETCH_LAZY)) {
	$expid = $rownew['expid']= $rowold['expid'];
	$val = $rownew['val'] = $rowold['val'];
	$rel = $rownew['rel'] = $rowold['rel'];
	$rep = $rownew['rep'] = $rowold['rep'];
	$ksm = $rownew['ksm'] = $rowold['ksm'];
	$textcom = $rownew['textcom'] = $rowold['textcom'];
}*/
$newtable  = $pdo -> prepare("DELETE FROM quality2");
$del = $newtable->execute();
$oldtable = $pdo -> query("SELECT * FROM quality1");
while ( $rowold = $oldtable ->fetch(PDO::FETCH_LAZY)) {
	$expid = $rowold['expid']; 	 
	$val = $rowold['val']; 	 
	$rel = $rowold['rel']; 	 
	$rep = $rowold['rep']; 	 
	$ksm = $rowold['ksm']; 	 
	$textcom = $rowold['textcom'];

	$newtable = $pdo -> prepare ("INSERT INTO quality2 (expid,val,rel,rep,ksm,textcom) VALUES('$expid','$val','$rel','$rep','$ksm','$textcom')");
	$count = $newtable ->execute();
}


$imgs  = $pdo -> query("SELECT * FROM object WHERE imgid = '$sendbyid'");
while ($rowimg = $imgs ->fetch(PDO::FETCH_LAZY)) {
	$imgid = $sendbyid;
	$nameimg = $rowimg['nameimg'];
	$img = $rowimg['img'];
	$img1 = chunk_split(base64_encode($img));
	$tth = $rowimg['tth'];
}

$result  = $pdo -> query("SELECT * FROM onassessment"); //извлекаем из базы все данные о объекте на оценку
while ($myrow = $result->fetch(PDO::FETCH_LAZY)) {
	if (empty($myrow['imgid'])) //проверка на наличие объекта
	{
		// если такого нет, то сохраняем данные
		$result2 = $pdo -> prepare ("INSERT INTO onassessment (nameimg,img,tth) VALUES('$nameimg','$img','$tth')");
	}
	else	
	{
		//если есть, то обновляем значения
		$upd  = $pdo -> prepare("UPDATE onassessment SET nameimg = '$nameimg', img = '$img1', tth = '$tth' WHERE imgid = 4");
		$count = $upd ->execute();

	}
}
header("Location: ".$_SERVER['HTTP_REFERER']);

?>