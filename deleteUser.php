<?php

    require "db.php";
    $user_loged = $_SESSION['username'];

    if (!isset($user_loged)) {
        header("Location: login.php");
    }

    $idUser = $_GET['id'];

    $query = "DELETE FROM imagen WHERE idUser = $idUser";
    mysqli_query($conn, $query);

    $query = "DELETE FROM usuario WHERE id = $idUser";
    mysqli_query($conn, $query);

    $_SESSION['message'] = "Task removed Successfully";
    $_SESSION['message_type'] = "danger";

    header("Location: crudUsuario.php");
?>