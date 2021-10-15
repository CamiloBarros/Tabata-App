<?php
    function getPassword($conn, $correo){
        $query = "SELECT * FROM usuario WHERE correo = '$correo' ";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
    
        $contraseña = $row['password'];

        return $contraseña;
    }
?>