<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");

    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $txtUsuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $txtcontraseña=(isset($_POST['pass']))?$_POST['pass']:"";
    $coincidencia=false;

    if($accion=="entrar") {

        if($txtUsuario !="" && $txtcontraseña != "") {

            $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios;");
            $sentenciaSQL->execute( );
            $listaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            foreach($listaUsuarios as $usuario) { 

                if($usuario['email'] == $txtUsuario && $usuario['pass'] == $txtcontraseña) {

                    $coincidencia=true;
                    break;
                }
            }

            if($coincidencia==true){

                $_SESSION["nombre"] = $txtUsuario;
                header('Location:index.php');
            } else {
            
                ?>
                    <p style="color: white;"><?php echo "Usuario o contraseña incorrectos.";?></p> 
                <?php
            }
        } else {

            ?>
                <p style="color: white;"><?php echo "Falta nombre de usuario o contraseña.";?></p> 
            <?php
        }
    }

    if($accion=="crearCuenta") {

        header('Location:crearUsuario.php');
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 fw-bold">
            
            <div class="card">  
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    
                    <form method="POST">

                        <div class = "form-group fw-bold">

                            <p>
                                <label>Usuario:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo  $txtUsuario; ?>" placeholder="Ingrese su email.">
                                <small id="emailHelp" class="form-text text-muted">Nunca comparta sus datos con nadie.</small>
                            </p>
                        </div>

                        <div class="form-group fw-bold">

                            <p>
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="pass" placeholder="Escriba su contraseña">
                            </p>
                        </div>
                        <button type="submit" class="btn btn-primary" name="accion" value="entrar">Entrar</button>
                        <br></br> 
                        <button type="submit" class="btn btn-success" name="accion" value="crearCuenta">Registrarse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>

<?php include("./template/footer.php"); ?>