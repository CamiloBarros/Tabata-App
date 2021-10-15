<?php
require 'db.php';
require 'functions/getLogo.php';

$user_loged = $_SESSION['username'];

if (!isset($user_loged)) {
    header("Location: login.php");
}
/************************ */

if (isset($_SESSION['idUser'])) {
    $idUSer = $_SESSION['idUser'];
    $query = "SELECT * FROM usuario WHERE id = $idUSer";
    $result = mysqli_query($conn, $query);
    $rowUser = mysqli_fetch_array($result);

    $queryI = "SELECT * FROM imagen WHERE idUser = $idUSer";
    $resultI = mysqli_query($conn, $queryI);
    $rowUserI = mysqli_fetch_array($resultI);
    $imagen = $rowUserI['imagen'];
    //Separar first name y last name

}

if(isset($_POST['updateUser'])){
    //Variables campos
    $name = $_POST['nombre'];    
    $phone = $_POST['telefono'];
    $date = $_POST['fecha'];
    $password = $_POST['contraseña'];
    $peso = $_POST['peso'];
    $genero = $_POST['sexo'];

    $query = "UPDATE usuario set nombre = '$name', telefono = '$phone', fechanac = '$date', password = '$password', sexo = '$genero', pesokg = '$peso' WHERE id = $idUSer";
    $result = mysqli_query($conn, $query);


    //********Variables y consultas para la imagen */
    if($_FILES['imagen']['tmp_name'] != NULL){
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $query_image =  "UPDATE imagen set imagen = '$imagen', nombre = '$name' WHERE idUser = $idUSer";
        mysqli_query($conn, $query_image);
        $_SESSION['logoNick'] = getLogo($conn, $idUSer);
        $_SESSION['first_name'] = $name;
    }
    
    header("Location: Index.php");
}

?>


<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <h3 class="card-title text-center"><i class="fas fa-user-edit fa-4x text-primary"></i></h3>
                <div class="dropdown-divider"></div>
                <form action="updateUser.php" method="POST" enctype="multipart/form-data">
                    <div class="row form-group">
                        <div class="col">
                            <input type="text" class="form-control" value="<?= $rowUser['nombre'] ?>" placeholder="Name" title="Nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col"><input type="password" class="form-control" value="<?= $rowUser['password'] ?>"  placeholder="Password" title="Contraseña" name="contraseña" required></div>
                        <div class="col"><input type="password" class="form-control" value="<?= $rowUser['password'] ?>"  placeholder="Confirm Password" title="Confirmar Contraseña" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col"><input type="number" class="form-control" value="<?= $rowUser['telefono'] ?>" placeholder="Phone Number" title="Numero de telefono" name="telefono" required></div>
                        <div class="col"><input type="date" class="form-control"  value="<?= $rowUser['fechanac']?>" title="Fecha de nacimiento" name="fecha" required></div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <select name="sexo" id="genero" value="<?= $rowUser['sexo']?>" class="custom-select" required>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                        <div class="col">
                            <input type="number" name="peso" class="form-control" value="<?= $rowUser['pesokg']?>" placeholder="Peso (Kg)" title="Peso: Kg" required>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Perfil</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagen">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <button class="btn btn-primary btn-block" name="updateUser"> Update </button>
                    <?php 
                        if($_SESSION['root'] < 1){ ?>
                            <a href="inhabilitar.php" class="btn btn-danger btn-block">Inhabilitar Cuenta</a>
                            <?php
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>