<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();

$getout = isset($_SESSION['role']) ? $_SESSION['role'] : '';
if($getout  != '1'){
	
	echo "<h1> УХАДИ!</h1>";
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'index.php';
	header("Location: http://$host$uri/$extra");
}

?>
<html>
<head>
	<title>Админ панель</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container contain">
		
		<?php
		include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
		$result  = $pdo -> query("SELECT * FROM users"); //извлекаем из базы users все данные
		$result1  = $pdo -> query("SELECT * FROM quality1");//извлекаем из базы quality1 все данные
		$imgs  = $pdo -> query("SELECT * FROM object");//извлекаем из базы object все данные
		$srval =0;
		$srrel=0;
		$srrep=0;
		$srksm=0;
		$arrimgid = array();	
		$arrimg = array();
		$arrimgname = array();
		$arrimgtext = array();
		$i = 0;
		$j=0;
		?>


		<div class="clickbtn">
			<a class="btn btn-dark" data-toggle="collapse" href="#block0" role="button" aria-expanded="false" aria-controls="block0">
				Информация о пользователях
			</a>
		</div>

		<div class="users collapse" id="block0">
			<h2 class="title-ind">Пользователи</h2>
			<table class='usertab '>
				<tr>
					<th>id</th>
					<th>Логин</th>
					<th>Пароль</th>
					<th>Роль</th>
				</tr>
				
					<?php while ($myrow = $result ->fetch(PDO::FETCH_LAZY)) {
						echo "<tr><td>{$myrow['id']}</td>";
						echo "<td>{$myrow['login']}</td>";
						echo "<td>{$myrow['password']}</td>";
						echo "<td>{$myrow['role']}</td></tr>";
					}?>
				
			</table>
			
			<div class="clickbtn">
				<a class="btn btn-secondary" data-toggle="collapse" href="#block1" role="button" aria-expanded="false" aria-controls="block1">
					Управление пользователями
				</a>
			</div>
			<div class="usersadm collapse row norow" id="block1">

				<div class="col-12 col-md-4">
					<div class="clickbtn">
						<a class="btn btn-info" data-toggle="collapse" href="#block11" role="button" aria-expanded="false" aria-controls="block11">
							Изменение роли пользователя
						</a>
					</div>
					<form action="changeuser.php" class='login-form formq collapse' id="block11" method="POST">
						<label>Искомый id пользователя :<br></label>
						<input name="searchid" type="number" class="form-control" size="15" maxlength="15">
						<br>
						<label>Новая роль:<br></label>
						<select name="newr" class="form-control" id="newr">
							<option value="0">Без роли</option>
							<option value="1">Админ</option>
							<option value="2">Эксперт</option>
						</select>
						<br>

						<div class="clickbtn">
							<button type="submit" class="btn btn-primary btadm">Измененить</button>
						</div>
					</form>
				</div>

				<div class="col-12 col-md-4">
					<div class="clickbtn">
						<a class="btn btn-info" data-toggle="collapse" href="#block12" role="button" aria-expanded="false" aria-controls="block12">
							Удалить пользователя
						</a>
					</div>
					<form action="deluser.php" class='login-form formq collapse' id="block12" method="POST">
						<label>Искомый id пользователя :<br></label>
						<input name="searchid" type="number"  class="form-control" size="15" maxlength="15">
						<br>
						<div class="clickbtn">
							<button type="submit" class="btn btn-primary btadm">Удалить</button>
						</div>
					</form>
				</div>

				<div class="col-12 col-md-4">
					<div class="clickbtn">
						<a class="btn btn-info" data-toggle="collapse" href="#block13" role="button" aria-expanded="false" aria-controls="block13">
							Добавить пользователя
						</a>
					</div>
					<form action="adduser.php" class='login-form formq collapse' id="block13" method="POST">
						<label>Логин нового пользователя:<br></label>
						<input name="addlogin" type="text" class="form-control" size="15" maxlength="15">
						<br>
						<label>Пароль нового пользователя:<br></label>
						<input name="addpassword" type="text" class="form-control" size="15" maxlength="15">
						<br>
						<label>Роль нового пользователя:<br></label>
						<select name="addrole" class="form-control" id="newr">
							<option value="0">Без роли</option>
							<option value="1">Админ</option>
							<option value="2">Эксперт</option>
						</select>
						<br>
						<div class="clickbtn">
							<button type="submit" class="btn btn-primary btadm">Добавить</button>
						</div>
					</form>
				</div>

			</div>
		</div>

		

		<div class="clickbtn">
			<a class="btn btn-dark" data-toggle="collapse" href="#block01" role="button" aria-expanded="false" aria-controls="block01">
				Информация о оценках
			</a>
		</div>

		<div class="costs collapse row norow" id="block01">
			<?php $onass  = $pdo -> query("SELECT * FROM onassessment"); //извлекаем из базы все данные о объекте на оценку
			while ($row = $onass->fetch(PDO::FETCH_LAZY)) {
				$imgname = $row['nameimg'];
			} ?>
			<div class="col-12">
				<h3 class="title-ind">Информация о оценках объекта <br> <?php echo $imgname; ?></h3>
			</div>
			<div class="col-12 col-md-6">
				<h2 class="title-ind">Оценки экспертов</h2>
				<table class='exptab'>
					<tr>
						<th>uid</th>
						<th>exp-login</th>
						<th>val</th>
						<th>rel</th>
						<th>rep</th>
						<th>ksm</th>
						<th>Комментарий</th>
					</tr>
					
					<?php while ($myrow = $result1 ->fetch(PDO::FETCH_LAZY)) {
						echo "<tr><td>{$myrow['uid']}</td>";
						echo "<td>{$myrow['exp_login']}</td>";
						echo "<td>{$myrow['val']}</td>";
						echo "<td>{$myrow['rel']}</td>";
						echo "<td>{$myrow['rep']}</td>";
						echo "<td>{$myrow['ksm']}</td>";
						echo "<td>{$myrow['textcom']}</td></tr>";

						$srval=($srval+$myrow['val']);
						$srrel=($srrel+$myrow['rel']);
						$srrep=($srrep+$myrow['rep']);
						$srksm=($srksm+$myrow['ksm']);
						$j++;
					}?>
					
				</table>

				<div class="clickbtn">
					<a class="btn btn-info" data-toggle="collapse" href="#block2" role="button" aria-expanded="false" aria-controls="block2">
						Удалить оценку
					</a>
				</div>
				<div class="collapse" id="block2">
					<form action="delqual.php" class='login-form formq' method="POST">
						<label>Искомый uid оценки :<br></label>
						<input name="delbyid" type="number" class="form-control" size="15" maxlength="15">
						<br>
						<div class="clickbtn">
							<button type="submit" class="btn btn-primary btadm">Удалить</button>
						</div>
					</form>									
				</div>
			</div>


			<div class="col-12 col-md-6">
				<h3 class='title-ind'>Средняя оценка</h3>
				<table class='srtab'>
					<tr>
						<th>val</th>
						<th>rel</th>
						<th>rep</th>
						<th>ksm</th>
					</tr>
					<tr>
						<?php
						$srval=$srval/$j;
						$srrel=$srrel/$j;
						$srrep=$srrep/$j;
						$srksm=$srksm/$j;

						$srval=round($srval,3);
						$srrel=round($srrel,3);
						$srrep=round($srrep,3);
						$srksm=round($srksm,3);

						echo "<td id='srval'>{$srval}</td>";
						echo "<td id='srrel'>{$srrel}</td>";
						echo "<td id='srrep'>{$srrep}</td>";
						echo "<td id='srksm'>{$srksm}</td>";
						?>
					</tr>
				</table>
			</div>

		</div>



		<div class="clickbtn">
			<a class="btn btn-dark" data-toggle="collapse" href="#block3" role="button" aria-expanded="false" aria-controls="block3">
				Показать расчеты
			</a>
		</div>
		<div class="diagram collapse row norow" id="block3">
			<div class="col-12 col-md-6">
				<h3 class='title-ind'>Диаграмма Кивиата</h3>
				<div class="canva">
					
					<canvas width="300" height="300" id="canvas"></canvas>
					<script>
						var val = 150 - <?php echo $srval ?>*150;
						var rel = 150+<?php echo $srrel ?>*150;
						var rep = 150+<?php echo $srrep ?>*150;
						var ksm = 150 - <?php echo $srksm ?>*150;
						var canvas = document.getElementById('canvas'); 
						var c = canvas.getContext('2d'); 
						c.fillStyle = "black"; 
						c.fillRect(149,0,1,300); 
						c.fillRect(0,149,300,1); 
						var prevAngle = 0; 
						var angle = prevAngle +Math.PI*2;
						c.font = "14px Verdana";
						c.arc(150,150, 150, prevAngle, angle, false); 
						c.moveTo(150,val);
						c.lineTo(rel,150);
						c.moveTo(rel,150);
						c.lineTo(150,rep);
						c.moveTo(150,rep);
						c.lineTo(ksm,150);
						c.moveTo(ksm,150);
						c.lineTo(150,val);
						c.moveTo(150,val);
						c.lineWidth =4;
						c.strokeStyle = "black"; 
						c.stroke(); 

						c.strokeStyle = "red";
						c.lineWidth =1;


						c.strokeText('val ',125,val-5);
						c.strokeText(<?php echo $srval ?>, 155,val-5);
						c.strokeText('rel ', rel,140);
						c.strokeText(<?php echo $srrel ?>, rel,165);
						c.strokeText('ksm ',ksm-25,140);
						c.strokeText(<?php echo $srksm ?>,ksm-25,165);
						c.strokeText('rep ', 120,rep+10);
						c.strokeText(<?php echo $srrep ?>, 160,rep+10);

					</script>
				</div>
			</div>

			<div class="col-12 col-md-6">
				<h3 class='title-ind'>Интегральная Оценка</h3>
				<div class='integ'>
					<?php echo "<p><strong>E</strong> = SQRT(SQRT($srval*$srrel*$srrep*$srksm)) = <strong>".round(sqrt(sqrt($srval*$srrel*$srrep*$srksm)),3)."</strong></p>";?>
				</div>
			</div>

		</div>

		<div class="clickbtn">
			<a class="btn btn-dark" data-toggle="collapse" href="#block4" role="button" aria-expanded="false" aria-controls="block4">
				Объекты на оценку
			</a>
		</div>
		<div class="collapse toqual" id="block4">
			<div class="tabimg">
				<table class='objecttable'>
					<tr><th>ID</th><th>Название</th><th>Описание и ттх</th><th>Фото</th></tr>
					<?php while ($rowimg = $imgs ->fetch(PDO::FETCH_LAZY)) {
						$arrimgid[$i] = $rowimg['imgid'];
						$arrimgname[$i] = $rowimg['nameimg'];
						$arrimgtext[$i] = $rowimg['tth'];
						$arrimg[$i] = chunk_split(base64_encode($rowimg['img']));
						$i++;
					}
					for ($i = 0; $i < count($arrimg); $i++)
					{	
						echo '<tr><td>'.$arrimgid[$i].'</td><td>'.$arrimgname[$i].'</td><td>'.$arrimgtext[$i].'</td><td><img alt="Ошибка чтения изображения" style="max-width:100%; max-height:300px;" src="data:image/jpg;base64,'.$arrimg[$i].'"></td></tr>';								
					}?>
				</table>
				<form action="object.php" class='login-form formq' method="POST">
					<label>Отправить объект по id на оценку :<br></label>
					<input name="sendbyid" type="number" class="form-control" size="15" maxlength="15">
					<br>
					<div class="clickbtn">
						<button type="submit" class="btn btn-primary btadm">Отправить на оценку</button>
					</div>
				</form>	
			</div>
		</div>
		<div class="on-home">
			<a href="index.php" class="btn btn-danger">На главную</a>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>