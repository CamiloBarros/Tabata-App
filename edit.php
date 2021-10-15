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
            $row_notes = mysqli_fetch_array($result_notes);
            
            $title = $row['nombre'];
            $description = $row_notes['descripcion'];
            $prepared = $row['tPreparacion'];
            $work = $row['tActividad'];
            $rest = $row['tDescanso'];
            $series = $row['numSeries'];
            $rounds = $row['numRondas'];    


        }
    }
    
    if(isset($_POST['update'])){
        $id = $_GET['id'];
        $id_nota = $_GET['id_nota'];
        $title = $_POST["title"];
        $description = $_POST["description"];
    
        $prepared = $_POST['prepared'];
        $work = $_POST['work'];
        $rest = $_POST['rest'];
    
        //$cooling = $_POST['cooling'];
        $series = $_POST['series'];
        $rounds = $_POST['rounds'];
        //Query de la tabla tabata
        $query = "UPDATE tabata set nombre = '$title', tPreparacion = '$prepared', tActividad = '$work', tDescanso = '$rest', numSeries = '$series', numRondas = '$rounds' WHERE id = $id";
    
        //Query de la tabla notas
        $query_notes = "UPDATE notas set descripcion = '$description' WHERE id_notas = $id_nota ";

        //Query de los ejercicio de la tabata 
        $query_ejercicio = "DELETE FROM ejercicioxtabata WHERE idTabata = $id";
    
        mysqli_query($conn, $query);
        mysqli_query($conn, $query_notes);
        mysqli_query($conn, $query_ejercicio);
    
        $contador = 1;
        while($contador <= $rounds ){
            $id_ejercicio = $_POST['ejercicios'.$contador];
    
            $query_ejercicio = "INSERT INTO ejercicioxtabata(idTabata, idEjercicio) VALUES ('$id', '$id_ejercicio' )";
            mysqli_query($conn, $query_ejercicio);
            $contador++;
        }     

        $_SESSION['message'] = "Update Successfully";
        $_SESSION["message_type"] = "warning";
        header("Location: Index.php");
    }
  
?>

<?php include("includes/header.php") ?>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> Edit Tabata   <i class="fas fa-dumbbell"></i></h3>
                    <form action="edit.php?id=<?php echo $_GET['id'] ?>&id_nota=<?php echo $_GET['id_nota'] ?> " method="POST">
                        <div class="form-group">
                            <input type="text" name="title" value="<?php echo $title ?>" class="form-control" placeholder="Update Title" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="prepared" value="<?php echo $prepared ?>" class="form-control" min="5" placeholder="Prepared" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="work" value="<?php echo $work ?>" class="form-control" min="5" placeholder="Work" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rest" value="<?php echo $rest ?>" class="form-control" min="5" placeholder="Rest" required>
                        </div>
                        <!--<div class="form-group">
                            <input type="number" name="cooling" value="#" class="form-control" min="5" placeholder="Cooling">
                        </div>-->
                        <div class="form-group">
                            <input type="number" name="series" value="<?php echo $series ?>" class="form-control" min="1" placeholder="Series" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="rounds" value="<?php echo $rounds ?>" class="form-control" min="1" placeholder="Rounds" readonly="readonly" id="rondas" required>
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="2" class="form-control" placeholder="Update Description" required><?php echo $description ?></textarea>
                        </div>
                        <h4>Ejercicios/Tabata</h4>
                        <div class="form-group" id="panelEjercicios">
                            <div class="form-group" id="secEjercicios"><?php include("includes/loadOption.php") ?></div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="agregar"><i class="fas fa-plus"></i> Add</button>
                            <button type="button" class="btn btn-danger" id="eliminar"><i class="fas fa-minus"></i> Delete</button>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button class="btn btn-success btn-block" name="update">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>
