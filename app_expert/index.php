<?php
    //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
session_start();

?>
<html>
<head>
	<title>Главная страница</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<div class="container login">
		<h2 class="title-ind">Авторизация</h2>
		<form action="testreg.php" class="login-form" method="post">
			<div class="form-group">
				<label>Ваш логин:<br></label>
				<input name="login" class="form-control" placeholder="Логин" pattern="|^[a-z-A-Z0-9]+$|i" type="text" maxlength="15">
			</div>
			<div class="form-group">	
				<label>Ваш пароль:<br></label>
				<input name="password" class="form-control" placeholder="Пароль"  pattern="|^[a-z-A-Z0-9]+$|i"  type="password" maxlength="15">
			</div>
			
			<!--<?php 
			if (($_SESSION['errlogin'] == 1) or ($_SESSION['errpass'] == 1))
			{
				echo '<small class="form-text text-muted sml">Логин или пароль введеный неправильно</small>';
				$_SESSION['errlogin'] = $_SESSION['errpass'] = 0;
			}
			?>-->
			<div class="form-group sumb">
				<button type="submit" class="btn btn-primary">Войти</button>
				<a href="reg.php">Зарегистрироваться</a> 
			</div>
		</form>
		<br>
		<div class="controls-ind">
			<?php
			if (empty($_SESSION['login']) or empty($_SESSION['id']))
			{
  		  		// Если пусты, то мы не выводим ссылку
				//echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
			}
			else
			{
				if($_SESSION['role'] == '1'){
					$adm = "<br><a class='btn btn-info' href='adminpanel.php'>Панель Администратора</a>";
					echo $adm;
				}
				if($_SESSION['role'] == '2'){
					$adm = "<br><a class='btn btn-info' href='expert.php'>Панель Эксперта</a>";
					echo $adm;
				}
    			// Если не пусты, то мы выводим ссылку
				echo "<br> Вы вошли на сайт, как <strong>".$_SESSION['login'].'</strong>';
				$content = "<br><a class='btn btn-danger' href='logout.php'>Выйти</a>";
				echo $content;
			}
			?>
		</div>
	</div>
</body>
</html>