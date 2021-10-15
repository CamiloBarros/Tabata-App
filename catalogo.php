<?php include("db.php");
/******************* */
$user_loged = $_SESSION['username'];

if(!isset($user_loged)){
    header("Location: login.php");
}
/********************* */

if(isset($_POST['ejercicios'])){
    $idEjercicio = $_POST['ejercicios'];

    $query = "SELECT * FROM imagen_tabata WHERE idEjercicio = $idEjercicio";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);


    $query_title = "SELECT * FROM ejercicios WHERE id_ejercicio = $idEjercicio";
    $result_title = mysqli_query($conn,$query_title);
    $row_title = mysqli_fetch_array($result_title);

    $_SESSION['tituloEjercicio'] = $row_title['nombre'];
    $_SESSION['image'] = $row['imagen'];
    $_SESSION['current'] = $idEjercicio;
}
?>

<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-auto mx-auto">

            <div class="card">
                <br>
                <h3 class="card-title text-center col-md-auto"><i class="fas fa-dumbbell"></i> CATALOGO DE EJERCICIOS <i class="fas fa-dumbbell"></i></h3>
                <div class="card-body">
                    <div  class="container">
                        <?php 
                            if(isset($_SESSION['tituloEjercicio'])){
                                ?>
                                <img src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['image']) ?>" class="img-fluid"  alt="imageEjercicio">
                                <?php
                            }
                        ?>
                        
                    </div>
                    <form action="catalogo.php" method="POST" id="catalogo">
                        <div class="card-title">
                            Elegir Ejercicio:
                        </div>
                        <select name="ejercicios" id="ejercicios" class="custom-select" style="margin-bottom: 2%">
                            <option selected hidden>Selecciona un ejercicio</option>
                            <?php
                            $query = "SELECT * FROM ejercicios";    
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {  
                                if(isset($_SESSION['tituloEjercicio']) && ($row['id_ejercicio'] == $_SESSION['current'])){ ?>
                                    <option value='<?php echo $row['id_ejercicio'] ?>' selected>
                                    <?php echo $row['nombre'] ?>
                                    </option> <?php
                                }
                                else {
                                ?>
                                <option value='<?php echo $row['id_ejercicio'] ?>'>
                                    <?php echo $row['nombre'] ?>
                                </option>
                            <?php   } }
                            unset($_SESSION['tituloEjercicio'],$_SESSION['image']);
                        ?>
                        </select>
                        <button class="btn btn-success btn-block" hidden>
                            Ver Ejemplo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>