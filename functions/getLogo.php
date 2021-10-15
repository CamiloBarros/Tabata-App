<?php

    function getLogo($conn, $id){
        $query = "SELECT * FROM imagen WHERE idUser = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $imagen = $row['imagen'];

        return $imagen;
    }
?>