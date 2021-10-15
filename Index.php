<?php include("db.php");
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }
?>



<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4">

                <?php include("includes/message.php") ?>

                <div class="card card-body">
                    <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> Tabata <i class="fas fa-dumbbell"></i></h3>
                    <form action="save_task.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Name" autofocus required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="prepared" class="form-control" min="5" placeholder="Prepared" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="work" class="form-control" min="5" placeholder="Work" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rest" class="form-control" min="5" placeholder="Rest" required>
                        </div>
                        <!--<div class="form-group">
                            <input type="number" name="cooling" class="form-control" min="5" placeholder="Cooling">
                        </div>-->
                        <div class="form-group">
                            <input type="number" name="series" class="form-control" min="1" placeholder="Series" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rounds" class="form-control" min="1" placeholder="Rounds" value= "1" readonly id="rondas" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <h4>Ejercicios/Tabata</h4>
                        <div class="form-group" id="panelEjercicios">
                            <select name="ejercicios1" id="ejercicios" class="custom-select" style="margin-bottom: 2%">
                                <?php
                                    $query = "SELECT * FROM ejercicios";
                                    $result = mysqli_query($conn, $query);
                                    while($row = mysqli_fetch_array($result)){  ?>
                                        <option value='<?php echo $row['id_ejercicio'] ?>'>
                                            <?php echo $row['nombre'] ?>
                                        </option>
                                <?php    }
                                ?>
                            </select> 
                            <div class="form-group" id="secEjercicios"></div>
                            <div class="form-group" id="ejemplo"></div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark" id="agregar"><i class="fas fa-plus"></i> Add</button>
                            <button type="button" class="btn btn-danger" id="eliminar"><i class="fas fa-minus"></i> Delete</button>
                        </div>
                        <div class="dropdown-divider"></div>
                        <input type="submit" class="btn btn-info btn-block" name="save_task" value="Guardar">
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $idUser = $_SESSION['idUser'];
                            $query = "SELECT * FROM tabata WHERE idUsuario = $idUser";
                            $result_tasks = mysqli_query($conn, $query);
                            $count = 1;
                            while($row = mysqli_fetch_array($result_tasks)){ ?>
                                <tr>
                                    <td><?php echo $count?></td>
                                    <td><?php echo $row['nombre'] ?></td>
                                    <td>
                                        <?php 
                                            $id = $row['id'];
                                            $query_notes = "SELECT * FROM notas where id_tabata = $id";
                                            $result_notes = mysqli_query($conn, $query_notes);
                                            $row_notes = mysqli_fetch_array($result_notes);
                                            echo $row_notes['fecha'];
                                        ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']?>&id_nota=<?php echo $row_notes['id_notas'] ?>" class="btn btn-secondary">
                                            <i class="fas fa-marker"></i>
                                        </a>
                                        
                                        <a href="delete_task.php?id=<?php echo $row['id']?>&id_nota=<?php echo $row_notes['id_notas'] ?>" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                        <a href="appTabata.php?id=<?php echo $row['id']?>&id_nota=<?php echo $row_notes['id_notas'] ?>" class="btn btn-info">
                                            <i class="fas fa-file-import"></i>
                                        </a>
                                        <?php 
                                            if($row['share'] == 0){
                                                ?>
                                                <a href="share.php?id=<?php echo $row['id']?>" class="btn btn-dark"><i class="fas fa-share-alt"></i> Share</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a href="xShare.php?id=<?php echo $row['id']?>" class="btn btn-warning"><i class="fas fa-times"></i> Share</a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                        <?php $count++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>