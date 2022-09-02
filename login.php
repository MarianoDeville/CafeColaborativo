<?php 
    include("./template/cabecera.php");

    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $txtUsuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $txtcontraseña=(isset($_POST['contraseña']))?$_POST['contraseña']:"";
        
    if($accion=="entrar") {

        if($txtUsuario !="" && $txtcontraseña != "") {

            $_SESSION["nombre"] = $txtUsuario;
            header('Location:index.php');
        } else {

            echo "Falta nombre de usuario o contraseña.";
        }
    }

    if($accion=="crearCuenta") {

        header('Location:crearUsuario.php');
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 fw-bold">
            
            <br/>
            <div class="card">  
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    
                    <form method="POST">

                        <div class = "form-group fw-bold">

                            <p><label>Usuario:</label></p>
                            <p><input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su email."></p>
                            <small id="emailHelp" class="form-text text-muted">Nunca comparta sus datos con nadie.</small>
                            <br></br>
                        </div>

                        <div class="form-group fw-bold">

                            <p><label>Contraseña:</label></p>
                            <input type="password" class="form-control" name="contraseña" placeholder="Escriba su contraseña">
                        </div>
                        <br></br>            
                        <button type="submit" class="btn btn-primary" name="accion" value="entrar">Entrar</button>
                        <br></br> 
                        <button type="submit" class="btn btn-primary" name="accion" value="crearCuenta">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./template/footer.php"); ?>