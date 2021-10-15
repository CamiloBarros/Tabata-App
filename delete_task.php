<?php
    include("db.php");

    if(isset($_GET['id']) & isset($_GET['id_nota'])){
        $id = $_GET['id'];
        $id_nota = $_GET['id_nota'];

        $query_ejercicio = "DELETE FROM ejercicioxtabata WHERE idTabata = $id";
        $result_ejercicio = mysqli_query($conn, $query_ejercicio);

        $query_notes = "DELETE FROM notas WHERE id_tabata = $id AND id_notas = $id_nota";
        $resul_notes = mysqli_query($conn, $query_notes);

        $query = "DELETE FROM tabata WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if(!result){
            die("Query Failed");
        }

        $_SESSION['message'] = "Task removed Successfully";
        $_SESSION['message_type'] = "danger";

        header("Location: index.php");
    }
?>