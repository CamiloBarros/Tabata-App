<?php
require "db.php";

$idUser = $_SESSION['idUser'];

$query = "UPDATE usuario SET estado = '0' WHERE id = $idUser";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_array($result);

header("Location: includes/logout.php");
?>