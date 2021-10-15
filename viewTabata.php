<?php
    include("db.php");
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    if(isset($_GET['id']) && isset($_GET['id_nota'])){
        $id = $_GET['id'];
        $id_nota = $_GET['id_nota'];

        $query = "SELECT * FROM tabata WHERE id = $id";
        $result = mysqli_query($conn, $query);

        $query_notes = "SELECT * FROM notas WHERE id_notas = $id_nota";
        $result_notes = mysqli_query($conn, $query_notes);

        if(mysqli_num_rows($result) == 1 && mysqli_num_rows($result_notes) == 1){
            $row = mysqli_fetch_array($result);
            $row_notes = mysqli_fetch_array($result_notes)  ;
            
            $title = $row['nombre'];
            $description = $row_notes['descripcion'];
            $prepared = $row['tPreparacion'];
            $work = $row['tActividad'];
            $rest = $row['tDescanso'];
            $series = $row['numSeries'];
            $rounds = $row['numRondas'];    


        }
    }
?>

<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> View <i class="fas fa-dumbbell"></i></h3>
                    <form action="edit.php?id=<?php echo $_GET['id'] ?>&id_nota=<?php echo $_GET['id_nota'] ?> " method="POST">
                        <div class="form-group">
                            <input type="text" name="title" value="<?php echo $title ?>" class="form-control" placeholder="Update Title" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" name="prepared" value="<?php echo $prepared ?>" class="form-control" min="5" placeholder="Prepared" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" name="work" value="<?php echo $work ?>" class="form-control" min="5" placeholder="Work" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rest" value="<?php echo $rest ?>" class="form-control" min="5" placeholder="Rest" readonly>
                        </div>
                        <!--<div class="form-group">
                            <input type="number" name="cooling" value="#" class="form-control" min="5" placeholder="Cooling">
                        </div>-->
                        <div class="form-group">
                            <input type="number" name="series" value="<?php echo $series ?>" class="form-control" min="1" placeholder="Series" readonly>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rounds" value="<?php echo $rounds ?>" class="form-control" min="1" placeholder="Rounds" id="rondas" readonly>
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" class="form-control" placeholder="Update Description" readonly><?php echo $description ?></textarea>
                        </div>
                        <h4>Ejercicios/Tabata</h4>
                        <div class="form-group" id="panelEjercicios">
                            <div class="form-group" id="secEjercicios"><?php include("includes/loadOptionView.php") ?></div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="form-group text-center">
                            <a href="home.php" class="btn btn-success">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>
