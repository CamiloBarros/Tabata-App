<?php
    require 'db.php';
    require 'functions/getLogo.php';
    if(isset($_POST['iniciar'])){
        //session_start();

        $user = $_POST['email'];
        $password = $_POST['password'];

        

        $query_count = "SELECT COUNT(*) AS contar FROM usuario WHERE correo = '$user' AND password = '$password' ";
        $query_list =  "SELECT * FROM usuario WHERE correo = '$user' AND password = '$password' ";

        $result_count = mysqli_query($conn, $query_count);
        $array_count = mysqli_fetch_array($result_count);

        $result_list = mysqli_query($conn, $query_list);
        $array_list = mysqli_fetch_array($result_list);

        //Verificamos que la cuenta no este desactivada
        
        if($array_count['contar'] > 0){
            if($array_list['estado'] == 0){
                $_SESSION['message'] = "Su cuenta se encuentra desactivada";
                $_SESSION['message_type'] = "warning";
            }
            else{
                $_SESSION['username'] = $user;
                $_SESSION['first_name'] = $array_list['nombre'];
                $_SESSION['idUser'] = $array_list['id'];
                $_SESSION['root'] = $array_list['root'];
                $_SESSION['logoNick'] = getLogo($conn, $array_list['id']);
                header("Location: Index.php");
            }
        } else {
            $_SESSION['message'] = "contraseña incorrecta";
            $_SESSION['message_type'] = "warning";
            //die("Failed");
        }
        
    }
?>