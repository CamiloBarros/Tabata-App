<?php include("db.php");
$user_loged = $_SESSION['username'];

if (!isset($user_loged)) {
    header("Location: login.php");
}

if(isset($_POST['save'])){
    $name = $_POST['title'];
    $user = $_POST['correo'];        
    $phone = $_POST['phone'];
    $date = $_POST['fecha'];
    $password = $_POST['password'];
    $peso = $_POST['peso'];
    $genero = $_POST['sexo'];
    $tipoUser = $_POST['tipoUser'];
    $estado = $_POST['estado'];

    //**********************Insertamos al nuevo usuario a la BDD *//
    $query = "INSERT INTO usuario(nombre, correo, password, telefono, fechanac, sexo, pesoKg, root, estado) VALUES ('$name', '$user', '$password', '$phone', '$date', '$genero', '$peso', '$tipoUser', '$estado')";
    $result = mysqli_query($conn, $query);

    //********Variables y consultas para la imagen */
    //$type_image = $_FILES['imagen']['type'];
    //$name_image = $_POST['nombre'].$_POST['apellido'];
    $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

    //Obtenemos el id del usuario
    $query_select = "SELECT * FROM usuario ORDER BY id DESC LIMIT 1";
    $result_select = mysqli_query($conn, $query_select);
    $row_select = mysqli_fetch_array($result_select);

    $idUser = $row_select['id'];
    $query_image =  "INSERT INTO imagen(idUser, nombre, imagen) VALUES ('$idUser','$name', '$imagen')";
    mysqli_query($conn, $query_image);
}
?>


<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <?php require "includes/message.php" ?>

            <div class="card card-body">
                <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> Crear Usuario <i class="fas fa-dumbbell"></i></h3>
                <form action="crudUsuario.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Name" autofocus required> </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required> </div>
                    <div class="form-group">
                        <input type="number" name="phone" class="form-control" min="1" placeholder="Telefono" required> </div>
                    <div class="form-group">
                        <input type="date" name="fecha" class="form-control" placeholder="Fecha" required> </div>
                    <div class="form-group">
                        <select name="sexo" id="genero" class="custom-select" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select> </div>
                    <div class="form-group">
                        <input type="number" name="peso" class="form-control" placeholder="Peso (Kg)" title="Peso: Kg" required> 
                    </div>
                    <div class="form-group">
                        <input type="email" name="correo" class="form-control block" placeholder="Email" required>
                    </div>
                    <div class="row form-group">
                        
                        <div class="col">
                            <select name="tipoUser" class="custom-select">
                                <option value="0" selected>Normal</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="col">
                            <select name="estado" class="custom-select col">
                                <option value="0">Desactivada</option>
                                <option value="1" selected>Activada</option>
                            </select>
                        </div>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagen" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <div class="dropdown-divider"></div>
                    <input type="submit" class="btn btn-success btn-block" name="save" value="Guardar">
                </form>
            </div>
        </div>
        <div class="col-md-8 text-center">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Name</th>
                        <th>Correo</th>
                        <th>Actions</th>
                    </tr>
                </thead>    
                <tbody>
                    <?php
                    $query = "SELECT * FROM usuario ";
                    $result_tasks = mysqli_query($conn, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result_tasks)) { 
                        if($row['id'] != 1){
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td>
                                    <?php echo $row['correo'] ?>
                                </td>
                                <td>
                                    <a href="editUser.php?id=<?= $row['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>

                                    <a href="deleteUser.php?id=<?= $row['id'] ?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $count++;
                        }
                        ?>
                        <?php 
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>