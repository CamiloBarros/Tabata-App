<?php 
    require "db.php";
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    $idE = $_GET['id'];
    $query = "SELECT * FROM ejercicios WHERE id_ejercicio = $idE";
    $result_rows = mysqli_fetch_array(mysqli_query($conn, $query));

    $idTipo = $result_rows['idTipo'];

    if(isset($_POST['update'])){
        echo 'ENTRO';
        $nombre = $_POST['title'];
        $tipo = $_POST['tipo'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        $query = "UPDATE ejercicios SET nombre = '$nombre', idTipo = '$tipo' WHERE id_ejercicio = $idE";
        mysqli_query($conn, $query);

        $query = "UPDATE imagen_tabata SET nombre = '$nombre', imagen = '$imagen' WHERE idEjercicio = $idE";
        mysqli_query($conn, $query);

        $_SESSION['message'] = "Update Successfully";
        $_SESSION["message_type"] = "warning";
        header("Location: crudEjercicios.php");
    }
?>

<?php include("includes/header.php") ?>

    <div class="container p-4 ">
        <div class="row">
            <div class="col-md-4 mx-auto">

                <div class="card card-body">
                    <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> Editar Ejercicio <i class="fas fa-dumbbell"></i></h3>
                    <form action="edit_ejercicio.php?id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" value="<?= $result_rows['nombre'] ?>"  placeholder="Name" autofocus required>
                        </div>
                        <div class="form-group" id="panelEjercicios">
                            <select name="tipo" id="tipo" class="custom-select" style="margin-bottom: 2%">
                                <?php
                                    $query = "SELECT * FROM tipoejercicio";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result)){  
                                        if($row['id'] == $idTipo){
                                            ?>
                                            <option value='<?php echo $row['id'] ?>' selected>
                                                <?php echo $row['nombre'] ?>
                                            </option>
                                            <?php
                                        }
                                        else {
                                        ?>
                                        <option value='<?php echo $row['id'] ?>'>
                                            <?php echo $row['nombre'] ?>
                                        </option>
                                    <?php   } 
                                    }
                                ?>
                            </select> 
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagen" required>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                        <div class="dropdown-divider"></div>
                        <input type="submit" class="btn btn-success btn-block" name="update" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>