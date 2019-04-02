<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <title>Регистрация</title>
</head>
<body>
 <div class="container login">
    <h2 class="title-ind">Регистрация</h2>
    <form action="save_user.php" class="login-form" method="post">
        <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
        <div class="form-group">
            <label>Ваш логин:<br></label>
            <input  class="form-control" name="login" type="text" size="15" maxlength="15">
        </div>
        <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
        <div class="form-group">
            <label>Ваш пароль:<br></label>
            <input class="form-control"  name="password" type="password" size="15" maxlength="15">
        </div>
        <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
        <div class="form-group sumb">
         <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
         <!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
     </div>
 </form>
</div>
</body>
</html>