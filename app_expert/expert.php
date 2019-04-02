<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();

$getout = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if($getout  != '2'){
	
	echo "<h1> УХАДИ!</h1>";
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	header("Location: http://$host$uri/$extra");
}

?>
<html>
<head>
	<title>Эксперт панель</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container">
		<h2 class="title-ind">Эксперт панель</h2>
		<?php

		include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
		$onass  = $pdo -> query("SELECT * FROM onassessment"); //извлекаем из базы все данные о объекте на оценку
		while ($row = $onass->fetch(PDO::FETCH_LAZY)) {
			$img1 = $row['img'];
			$imgname = $row['nameimg'];
			echo "<div class='imgtov'>";
			echo '<img alt="Ошибка чтения изображения" style="width:100%; max-width:600px;" src="data:image/jpg;base64,'.$img1.'">';
			echo "</div>";
		}
		$mylogin = isset($_SESSION['login']) ? $_SESSION['login'] : '';
		$result  = $pdo -> query("SELECT * FROM quality1 WHERE exp_login='$mylogin'"); 
		$i=0;
		//извлекаем из базы все данные
		?>

		<table class='exptab'>
			<tr>
				<th>uid</th>
				<th>Ваш login</th>
				<th>val</th>
				<th>rel</th>
				<th>rep</th>
				<th>ksm</th>
				<th>Комментарий</th>
			</tr>
			<tr>
				<?php
				while ($myrow = $result ->fetch(PDO::FETCH_LAZY)){
					echo "<td>{$myrow['uid']}</td>";
					echo "<td>{$myrow['exp_login']}</td>";
					echo "<td>{$myrow['val']}</td>";
					echo "<td>{$myrow['rel']}</td>";
					echo "<td>{$myrow['rep']}</td>";
					echo "<td>{$myrow['ksm']}</td>";
					echo "<td>{$myrow['textcom']}</td>";
					$i++;
				}
				?>
			</tr>
		</table>
		<br>
		<div class="clickbtn">
			<a class="btn btn-info" data-toggle="collapse" href="#block" role="button" aria-expanded="false" aria-controls="block">
				Показать элементы управления
			</a>
		</div>

		<?php
		if($i == 0){

			echo "<div class='collapse ' id='block'>";
			echo "<h3 class='title-ind'>Добавить оценку</h3>";
			echo "<form action='addqual.php' class='login-form formq' method='POST'>";
			echo "<label>VAL:</label>";
			echo '<input name="addval" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>REL:</label>";
			echo '<input name="addrel" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>REP:</label>";
			echo '<input name="addrep" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>KSM:</label>";
			echo '<input name="addksm" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>Комментарий к объекту:<br></label>";
			echo '<input name="addtext" type="text" class="form-control"  maxlength="255"><br>';
			echo '<div class="clickbtn">';
			echo '<button type="submit" class="btn btn-primary btadm">Добавить</button>';
			echo "</div>";
			echo "</form>";
			echo "</div>";
		}
		else
		{
			echo "<div class='collapse ' id='block'>";
			echo "<h3 class='title-ind'>Изменить оценку</h3>";
			echo "<form action='changequal.php' class='login-form formq' method='POST'>";
			echo "<label>VAL:</label>";
			echo '<input name="updval" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>REL:</label>";
			echo '<input name="updrel" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>REP:</label>";
			echo '<input name="updrep" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>KSM:</label>";
			echo '<input name="updksm" type="text" class="form-control" pattern="(^| )[0-1](.[0-9]+)*($| )" size="15" maxlength="15"><br>';
			echo "<label>Комментарий к объекту:<br></label>";
			echo '<input name="addtext" type="text" class="form-control"  maxlength="255"><br>';
			echo '<div class="clickbtn">';
			echo '<button type="submit" class="btn btn-primary btadm">Изменить</button>';
			echo "</div>";
			echo "</form>";
			echo "<div class='delq'>";
			echo "<h3 class='title-ind'>Удалить оценку</h3>";
			echo '<form action="delqual.php" method="POST">';
			echo '<div class="clickbtn">';
			echo '<button type="submit" class="btn btn-primary btadm">Удалить</button>';
			echo "</div>";
			echo "</form>";
			echo "</div>";
			echo "</div>";	
		}
		?>

		<div class="on-home">
			<a href="index.php" class="btn btn-danger">На главную</a>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>