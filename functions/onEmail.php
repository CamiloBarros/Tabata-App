<?php
    function comprobarEmail ($conn, $email){
        $query = "SELECT COUNT(*) AS numUser FROM usuario WHERE correo = '$email'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        

        if($row['numUser'] > 0){
            return true;
        }
        else{
            return false;
        }
    }
?>