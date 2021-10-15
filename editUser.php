<?php 
require "db.php";
require "functions/getLogo.php";
$user_loged = $_SESSION['username'];

if (!isset($user_loged)) {
    header("Location: login.php");
}

$idUser = $_GET['id'];

if (isset($_POST['save'])) {
    $nombre = $_POST['title'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $telefono = $_POST['phone'];
    $fecha = $_POST['fecha'];
    $genero = $_POST['sexo'];
    $peso = $_POST['peso'];
    $tipoUser = $_POST['tipoUser'];
    $estado = $_POST['estado'];

    $query = "UPDATE usuario SET nombre = '$nombre', correo = '$correo', password = '$password', telefono = '$telefono', fechanac = '$fecha', sexo = '$genero', pesokg = '$peso', root = '$tipoUser', estado = '$estado' WHERE id = $idUser";
    mysqli_query($conn, $query);

    //********Variables y consultas para la imagen */
    if($_FILES['imagen']['tmp_name'] != NULL){
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $query_image =  "UPDATE imagen set imagen = '$imagen', nombre = '$nombre' WHERE idUser = $idUser";
        mysqli_query($conn, $query_image);
    }
    $_SESSION['message'] = "Update Successfully";
    $_SESSION["message_type"] = "warning";
    header("Location: crudUsuario.php");
}


$query = "SELECT * FROM usuario WHERE id = $idUser";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>



<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">

            <div class="card card-body">
                <h3 class="card-title text-center"><i class="fas fa-dumbbell"> </i> Editar Usuario <i class="fas fa-dumbbell"></i></h3>
                <form action="editUser.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" value="<?= $row['nombre'] ?>" class="form-control" placeholder="Name" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" value="<?= $row['password'] ?>" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="phone" value="<?= $row['telefono'] ?>" class="form-control" min="1" placeholder="Telefono" required>
                    </div>
                    <div class="form-group">
                        <input type="date" name="fecha" value="<?= $row['fechanac'] ?>" class="form-control" placeholder="Fecha" required>
                    </div>
                    <div class="form-group">
                        <select name="sexo" id="genero" class="custom-select" required>
                            <?php
                            if ($row['sexo'] == "M") {
                                ?>
                                <option value="M" selected>Masculino</option>
                                <option value="F">Femenino</option>
                            <?php
                        } else {
                            ?>
                                <option value="M">Masculino</option>
                                <option value="F" selected>Femenino</option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="peso" value="<?= $row['pesokg'] ?>" class="form-control" placeholder="Peso (Kg)" title="Peso: Kg" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="correo" value="<?= $row['correo'] ?>" class="form-control block" placeholder="Email" required>
                    </div>
                    <div class="row form-group">
                        
                        <div class="col">
                            <select name="tipoUser" class="custom-select">
                                <?php
                                if($row['root'] == "0"){
                                    ?>
                                    <option value="0" selected>Normal</option>
                                    <option value="1">Admin</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="0">Normal</option>
                                    <option value="1" selected>Admin</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <select name="estado" class="custom-select col">
                            <?php
                                if($row['estado'] == "0"){
                                    ?>
                                    <option value="0" selected>Desactivada</option>
                                    <option value="1">Activada</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="0">Desactivada</option>
                                    <option value="1" selected>Activada</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagen">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <div class="dropdown-divider"></div>
                    <input type="submit" class="btn btn-success btn-block" name="save" value="Guardar">
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>