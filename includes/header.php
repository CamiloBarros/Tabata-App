<?php
/******************* */
$user_loged = $_SESSION['username'];

if (!isset($user_loged)) {
  header("Location: login.php");
}


/********************* */
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Tabata Design</title>
  <link rel="shortcut icon" href="img/pics/icon.png" type="image/x-icon">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- FONT AWeSOME-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand navbar-dark bg-info">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <i class="fas fa-dumbbell"></i> DESIGN TABATA
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catalogo.php">Catalogo</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="nick">
              <img src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['logoNick']) ?>" class="img-fluid" style="width: 20px;" alt="logoNick">
              <!--Bienvendio/a--> <?php echo $_SESSION['first_name'] ?>
              <!-- Nick del usuario -->
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="index.php">Mis Tabatas</a>
              <a class="dropdown-item" href="updateUser.php">Gestion de cuenta</a>
              <?php 
                if($_SESSION['root'] > 0){ ?>
                  <a class="dropdown-item" href="crudEjercicios.php">CRUD Ejercicios</a>
                  <a class="dropdown-item" href="crudUsuario.php">CRUD Usuario</a>
                <?php  }
              ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="includes/logout.php">Cerrar Sesion</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>