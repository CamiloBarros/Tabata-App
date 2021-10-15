<?php 
    include("db.php");

    if(isset($_POST['save_task'])){
        if(!empty($_POST['title']) and !empty($_POST['prepared']) and !empty($_POST['work'])
        and !empty($_POST['rest']) and !empty($_POST['series']) and !empty($_POST['ejercicios1'])){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $prepared = $_POST['prepared'];
            $work = $_POST['work'];
            $rest = $_POST['rest'];
            /*$cooling = $_POST['cooling'];*/
            $series = $_POST['series'];
            $rounds = $_POST['rounds'];
            $idUser = $_SESSION['idUser'];

            $query = "INSERT INTO tabata(nombre, tPreparacion, tActividad, tDescanso, numSeries, numRondas, idUsuario) VALUES ('$title', '$prepared', '$work', '$rest', '$series', '$rounds', '$idUser')";
            $result = mysqli_query($conn, $query);

            //Escogo el ultimo registro ingresado en la tabla tabata para añadirle la nota(Descripcion)
            $query_select = "SELECT * FROM tabata ORDER BY id DESC LIMIT 1";
            $result_select =  mysqli_query($conn, $query_select);
            $row = mysqli_fetch_array($result_select);

            $id_tabata = $row['id'];
            $query_notes = "INSERT INTO notas(id_tabata, descripcion) VALUES ('$id_tabata', '$description')";
            $result_notes = mysqli_query($conn, $query_notes);
        
            $contador = 1;
            while($contador <= $rounds ){
                $id_ejercicio = $_POST['ejercicios'.$contador];
    
                $query_ejercicio = "INSERT INTO ejercicioxtabata(idTabata, idEjercicio) VALUES ('$id_tabata', '$id_ejercicio' )";
                mysqli_query($conn, $query_ejercicio);
                $contador++;
            }
            
            if(!$result) {
                die("Query Failed");
            }
        
            $_SESSION['message'] = 'Task Saved Succesfully';
            $_SESSION['message_type'] = 'success';  

        } else{
            $_SESSION['message'] = 'Field Empty';
            $_SESSION['message_type'] = 'warning';
        }
        header ("Location: index.php");
    }
?>