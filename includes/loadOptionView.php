<?php 
    $contador = 1;
    $query = "SELECT * FROM ejercicioxtabata WHERE idTabata = $id";
    $result = mysqli_query($conn, $query);
    $query_ejercicio = "SELECT * FROM ejercicios";
                                    
    while($row = mysqli_fetch_array($result)){  ?>
        <select name="<?php echo 'ejercicios'.$contador ?>" id="ejercicios" class="custom-select" style="margin-bottom: 2%" value='<?php echo $row['idEjercicio']?>' disabled>   <?php
            $result_ejercicio = mysqli_query($conn, $query_ejercicio);
            while($row_ejercicio = mysqli_fetch_array($result_ejercicio)){
                                                
                if($row_ejercicio['id_ejercicio'] == $row['idEjercicio']){
                    echo '<option value="'.$row_ejercicio['id_ejercicio'].'" selected>'.$row_ejercicio['nombre'].'</option>';
                } else {    ?>      
                    <option value="<?= $row_ejercicio['id_ejercicio'] ?>"><?= $row_ejercicio['nombre']?></option>   <?php 
                }
            }   ?>
        </select>   <?php
        $contador++;
    }   
?>