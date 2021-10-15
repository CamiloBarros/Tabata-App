<?php 
    require "db.php";
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    $id = $_GET['id'];
    $query = "DELETE FROM imagen_tabata WHERE idEjercicio = $id";
    mysqli_query($conn, $query);

    $query = "DELETE FROM ejercicios WHERE id_ejercicio = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = "Task removed Successfully";
    $_SESSION['message_type'] = "danger";

    header("Location: crudEjercicios.php");
?>
