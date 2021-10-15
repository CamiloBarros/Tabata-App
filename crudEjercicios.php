<?php include("db.php");
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    if(isset($_POST['save'])){
        $nombre = $_POST['title'];
        $tipo = $_POST['tipo'];

        $query = "INSERT INTO ejercicios(nombre, idTipo) VALUES ('$nombre', '$tipo')";
        mysqli_query($conn, $query);
        $query = "SELECT * FROM ejercicios ORDER BY id_ejercicio DESC LIMIT 1";
        $result_row = mysqli_fetch_array(mysqli_query($conn, $query));

        $idE = $result_row['id_ejercicio'];

        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
        $query_image =  "INSERT INTO imagen_tabata(nombre, imagen, idEjercicio) VALUES ('$nombre', '$imagen', '$idE')";
        mysqli_query($conn, $query_image);

        
        $_SESSION['message'] = 'Task Saved Succesfully';
        $_SESSION['message_type'] = 'success'; 
        header("Location: crudEjercicios.php");
    }
?>



<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">

                <?php include("includes/message.php") ?>

                <div class="card card-body">
                    <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> Crear Ejercicio <i class="fas fa-dumbbell"></i></h3>
                    <form action="crudEjercicios.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Name" autofocus required>
                        </div>
                        <div class="form-group" id="panelEjercicios">
                            <select name="tipo" id="tipo" class="custom-select" style="margin-bottom: 2%">
                                <?php
                                    $query = "SELECT * FROM tipoejercicio";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result)){  ?>
                                        <option value='<?php echo $row['id'] ?>'>
                                            <?php echo $row['nombre'] ?>
                                        </option>
                                <?php    }
                                ?>
                            </select> 
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
            <div class="col-md-7">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            $query = "SELECT * FROM ejercicios";
                            $result_tasks = mysqli_query($conn, $query);
                            $count = 1;
                            while($row = mysqli_fetch_array($result_tasks)){ ?>
                                <tr>
                                    <td><?php echo $count?></td>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td>
                                        <a href="edit_ejercicio.php?id=<?= $row['id_ejercicio'] ?>" class="btn btn-secondary">
                                            <i class="fas fa-marker"></i> Edit
                                        </a>
                                        
                                        <a href="delete_ejercicio.php?id=<?= $row['id_ejercicio'] ?>" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>