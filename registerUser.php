<?php 
    include("db.php");
    if(isset($_POST['registrarse'])){
        //Variables campos
        $name = $_POST['nombre'].' '.$_POST['apellido'];
        $user = $_POST['email'];        
        $phone = $_POST['telefono'];
        $date = $_POST['fecha'];
        $password = $_POST['contraseña'];
        $peso = $_POST['peso'];
        $genero = $_POST['sexo'];


        //**********************Insertamos al nuevo usuario a la BDD *//
        $query = "INSERT INTO usuario(nombre, correo, password, telefono, fechanac, sexo, pesoKg) VALUES ('$name', '$user', '$password', '$phone', '$date', '$genero', '$peso')";
        $result = mysqli_query($conn, $query);

        //********Variables y consultas para la imagen */
        //$type_image = $_FILES['imagen']['type'];
        //$name_image = $_POST['nombre'].$_POST['apellido'];
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

        //Obtenemos el id del usuario
        $query_select = "SELECT * FROM usuario ORDER BY id DESC LIMIT 1";
        $result_select = mysqli_query($conn, $query_select);
        $row_select = mysqli_fetch_array($result_select);

        $idUser = $row_select['id'];
        $query_image =  "INSERT INTO imagen(idUser, nombre, imagen) VALUES ('$idUser','$name', '$imagen')";
        mysqli_query($conn, $query_image);


        if(!$result) {
            die("Query Failed");
        }

        header("Location: login.php");
    }
?>