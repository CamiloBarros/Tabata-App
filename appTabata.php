<?php
include("db.php");

$user_loged = $_SESSION['username'];

if (!isset($user_loged)) {
    header("Location: login.php");
}

if (isset($_GET['id']) && isset($_GET['id_nota'])) {
    $id = $_GET['id'];
    $id_nota = $_GET['id_nota'];

    $query = "SELECT * FROM tabata WHERE id = $id";
    $result = mysqli_query($conn, $query);

    $query_notes = "SELECT * FROM notas WHERE id_notas = $id_nota";
    $result_notes = mysqli_query($conn, $query_notes);

    if (mysqli_num_rows($result) == 1 && mysqli_num_rows($result_notes) == 1) {
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
?>

<?php include("includes/header.php") ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">

            <div class="card">
                <br>
                <h3 class="card-title text-center"><i class="fas fa-dumbbell"></i> <?php echo $title ?> <i class="fas fa-dumbbell"></i></h3>
                <div class="card-body">
                    <div class="card-title text-center">
                        <h2 id="currentEj" class="text-primary"></h2>
                        
                        <h3 id="time">
                            <span id="Horas">00</span><span id="Minutos">:00</span><span id="Segundos">:00</span>
                        </h3>
                        
                        <div class="container">
                            <div class="float-left" id="series" title="Series">
                                <h6> <span id="currentSerie">1</span>/<?php echo $series ?></h6>
                            </div>
                            <div class="float-right" id="rondas" title="Rondas">
                                <h6><span id="currentRound">1</span>/<?php echo $rounds ?></h6>
                            </div>
                        </div>
                        <h6 id="time-secondary">
                            <span id="Horas_secondary">00</span><span id="Minutos_secondary">:00</span><span id="Segundos_secondary">:00</span>
                        </h6>
                    </div>
                    <div class="progress clear">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" id="bar"></div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="form-group">
                        <input type="number" name="prepared" value="<?php echo $prepared ?>" class="form-control" min="5" placeholder="Prepared" readonly hidden>
                    </div>
                    <div class="form-group">
                        <input type="number" name="work" value="<?php echo $work ?>" class="form-control" min="5" placeholder="Work" readonly hidden>
                    </div>
                    <div class="form-group">
                        <input type="number" name="rest" value="<?php echo $rest ?>" class="form-control" min="5" placeholder="Rest" readonly hidden>
                    </div>
                    <div class="form-group">
                        <input type="number" name="series" value="<?php echo $series ?>" class="form-control" min="1" placeholder="Series" readonly hidden>
                    </div>
                    <div class="form-group">
                        <input type="number" name="rounds" value="<?php echo $rounds ?>" class="form-control" min="1" placeholder="Rounds" readonly id="rondas" hidden>
                    </div>
                    <div class="form-group">
                        <textarea name="description" rows="2" class="form-control" placeholder="Description" readonly><?php echo $description ?></textarea>
                    </div>
                    <!-- Modificar esta parte, qu   e me muestre los ejercicios de forma dinamica, con respecto a la ronda -->
                    <h4>Ejercicios/Tabata</h4>
                    <div class="form-group" id="panelEjercicios">
                        <div class="form-group" id="secEjercicios"><?php include("includes/loadOptionView.php") ?></div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-block" id="estado">Iniciar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php") ?>