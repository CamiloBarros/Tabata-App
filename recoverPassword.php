<?php
    require "db.php";
    if(isset($_POST['enviar'])){
        $correo = $_POST['email'];
        require "functions/returnPassword.php";
        require "functions/onEmail.php";

        if(comprobarEmail($conn, $correo)){
            $_SESSION['message'] = 'Mensaje enviado';
            $_SESSION['message_type'] = 'success';
            require "functions/sendEmail.php";
        }
        else{
            $_SESSION['message'] = 'El correo no se encuentra en la base de datos';
            $_SESSION['message_type'] = 'warning';
        }
        unset($_POST);
    }
?>


<?php include('includes/headerLogin.php') ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <?php include('includes/message.php') ?>
            <div class="card">
                <h3 class="card-title text-center"> <!--<img src="Img/icon2.png" alt="logo" class="text text-primary" width="50%">-->
                <br><i class="fas fa-users fa-4x text-primary"></i> </h3>
                <div class="card-body">                    
                    <form action="recoverPassword.php" method="POST">
                        <div class="form-group">
                            <!--<label for="exampleInputEmail1">Email address</label>-->
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" autofocus required>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electronico.</small>
                        </div>
                        <div class="form-group text-center"><a href="login.php">¿Regresar al login?</a></div>
                        <div class="dropdown-divider"></div>
                        <button type="submit" class="btn btn-primary btn-block" id="enviar" name="enviar"><i class="fas fa-sign-in-alt"></i> Enviar</button>
                        <button type="button" class="btn btn-light btn-block" id="eliminar"> <a href="register.php" class="text-primary" style="text-decoration: none"><i class="fas fa-user-plus"></i> Registrar</a></button>
                    </form>       
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footerLogin.php') ?>