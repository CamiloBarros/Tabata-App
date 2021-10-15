<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="Img/icon.png">
  <link rel="stylesheet" href="Css/logstyles.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">

      <div class="fadeIn first">
        <img src="Img/icon2.png">
      </div>

      <form name="login" method="post" action="Php/user.php">
        <input type="text" id="login" class="fadeIn second" name="correo" placeholder="User">
        <input type="password" id="password" class="fadeIn third" name="pass" placeholder="Password">
        <input type="submit" value="Iniciar Sesion" class="fadeIn fourth" >
      </form>


      <div id="formFooter">
        <a class="underlineHover" href="register.php"> <strong>¡Registrate!</strong></a>
      </div>

    </div>
  </div>

</body>

</html>