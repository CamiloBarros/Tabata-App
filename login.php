<?php require "user.php" ?>

<?php include('includes/headerLogin.php') ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card">
                <?php include('includes/message.php') ?>
                <h3 class="card-title text-center"> <!--<img src="Img/icon2.png" alt="logo" class="text text-primary" width="50%">-->
                <br><i class="fas fa-users fa-4x text-primary"></i> </h3>
                <div class="card-body">                    
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <!--<label for="exampleInputEmail1">Email address</label>-->
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" autofocus required>
                            <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electronico.</small>
                        </div>
                        <div class="form-group">
                            <!--<label for="exampleInputPassword1">Password</label>-->
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Recuérdame</label>
                        </div>
                        <div class="form-group text-center">
                            <a href="recoverPassword.php">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <button type="submit" class="btn btn-primary btn-block" id="agregar" name="iniciar"><i class="fas fa-sign-in-alt"></i> Iniciar</button>
                        <a href="register.php" class="text-primary btn btn-light btn-block" style="text-decoration: none"><i class="fas fa-user-plus"></i> Registrar</a>
                    </form>       
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footerLogin.php') ?>