<?php include('includes/headerLogin.php') ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-auto mx-auto">
            <div class="card">
                <h3 class="card-title text-center"> <!--<img src="Img/icon2.png" alt="logo" class="text text-primary" width="50%">-->
                <br><i class="fas fa-user-plus fa-4x text-primary"></i> </h3>
                <div class="card-body ">                    
                    <form action="registerUser.php" method="POST" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col">
                            <input type="text" class="form-control" placeholder="First name" title="Nombre" name="nombre" required>
                            </div>
                            <div class="col">
                            <input type="text" class="form-control" placeholder="Last name" title="Apellido" name="apellido" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col"><input type="password" class="form-control" placeholder="Password" title="Contraseña" name="contraseña" required></div>
                            <div class="col"><input type="password" class="form-control" placeholder="Confirm Password" title="Confirmar Contraseña" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col"><input type="number" class="form-control" placeholder="Phone Number" title="Numero de telefono" name="telefono" required></div>
                            <div class="col"><input type="date" class="form-control" title="Fecha de nacimiento" name="fecha" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col">
                                <select name="sexo" id="genero" class="custom-select" required>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" name="peso" class="form-control" placeholder="Peso (Kg)" title="Peso: Kg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Adress" name="email" required> 
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Perfil</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="imagen" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group text-center"><a href="login.php">¿Regresar al login?</a></div>
                        <div class="dropdown-divider"></div>
                        <button class="btn btn-primary btn-block" name="registrarse"> Registrarse </button>
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>
<?php include('includes/footerLogin.php') ?>