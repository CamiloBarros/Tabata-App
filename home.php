<?php include("db.php");
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    $query = "SELECT * FROM tabata WHERE share = '1' ";
    $result = mysqli_query($conn, $query);
?>



<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="container form-group text-center p-4">
            <h3>TABATAS COMPARTIDAS</h3>
        </div>
        <div class="row">
            <?php
                while($row = mysqli_fetch_array($result)){
                    $idT = $row['id'];
                    $query = "SELECT * FROM notas WHERE id_tabata = $idT";
                    $result_row = mysqli_fetch_array(mysqli_query($conn, $query));
                    ?>
                    <div class="col-md-4 ">
                        <div class="card card-body form-group ">
                            <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> <?= $row['nombre'] ?> <i class="fas fa-dumbbell"></i></h3>
                            <div class="dropdown-divider"></div>
                            <h6><?= $result_row['descripcion'] ?></h6>
                            <div class="dropdown-divider"></div>
                            <div class="footer"> <?php
                                $idUser = $row['idUsuario'];
                                $queryUser = "SELECT * FROM usuario WHERE id = $idUser";
                                $rowU = mysqli_fetch_array(mysqli_query($conn, $queryUser));
                                ?>
                                Publicado por, <?= $rowU['nombre'] ?>
                                <?php
                            ?> </div>
                            <div class="row">
                                <div class="col"><a href="viewTabata.php?id=<?php echo $row['id']?>&id_nota=<?php echo $result_row['id_notas'] ?>" class="btn btn-success btn-block">View</a></div>
                                <div class="col"><a href="appTabata.php?id=<?php echo $row['id']?>&id_nota=<?php echo $result_row['id_notas'] ?>" class="btn btn-primary btn-block">Subir</a></div>

                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>          
        </div>
    </div>

<?php include("includes/footer.php") ?>