<?php
    require "db.php";
    $user_loged = $_SESSION['username'];

    if(!isset($user_loged)){
        header("Location: login.php");
    }

    $idT = $_GET['id'];

    $query = "UPDATE tabata set share = '0' WHERE id = $idT" ;
    mysqli_query($conn, $query);

    header("Location: Index.php");
?>