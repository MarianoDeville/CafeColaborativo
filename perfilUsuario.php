<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");

    $txtUsuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios;");
    $sentenciaSQL->execute( );
    $listaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    foreach($listaUsuarios as $usuario) { 

        if($usuario['email'] == $txtUsuario) {

            break;
        }
    }

    $nom=(isset($usuario['nombreUsuario']))?$usuario['nombreUsuario']:"";
    $apell=(isset($usuario['apellido']))?$usuario['apellido']:"";
    $dni=(isset($usuario['dni']))?$usuario['dni']:"";
    $dir=(isset($usuario['direccion']))?$usuario['direccion']:"";
    $email=(isset($usuario['email']))?$usuario['email']:"";

    switch($accion){

        case "logout":
            session_unset();
            header('Location:index.php');
            include("./template/pie.php");
            break;

        case "guardar":
            echo "Presionó el botón guardar.";
            break;

        case "cambiarPass":
            echo "Presionó el botón cambiarPass.";
            break;

        case "borrarUsuario":
            echo "Presionó el botón borrarUsuario.";
            break;
    }
  ?>

<div class="jumbotron">
    
    <h1 class="display-3">Datos usuario</h1>
    <hr class="my-2">
</div>

<div class="container">
    
    <div class="row">

        <div class="col-md-4 fw-bold">
            
            <br/>
            <div class="card">  

                <div class="card-body">
                    
                    <form method="POST">

                        <div class = "form-group fw-bold">

                            <p>
                                <label>Nombre:</label>
                                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo  $nom; ?>">
                            </p>

                            <p>
                                <label>Apellido:</label>
                                <input type="text" class="form-control" name="apell" id="apell" value="<?php echo  $apell; ?>">
                            </p>

                            <p>
                                <label>DNI:</label>
                                <input type="number" class="form-control" name="dni" id="dni" value="<?php echo  $dni; ?>">
                            </p>

                            <p>
                                <label>Email:</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo  $email; ?>">
                            </p>

                            <p>
                                <label>Dirección:</label>
                                <input type="text" class="form-control" name="dir" id="dir" value="<?php echo  $dir; ?>">
                            </p>
                        </div>
                        
                        <p>
                            <button type="submit" class="btn btn-primary" name="accion" value="guardar">Guardar cambio</button>
                            <button type="submit" class="btn btn-primary" name="accion" value="cambiarPass">Cambiar contraseña</button>
                        </p>

                        <p>
                            <button type="submit" class="btn btn-danger" name="accion" value="borrarUsuario">Borrar usuario</button>
                        </p>
                        <p>
                            <button type="submit" class="btn btn-primary" name="accion" value="logout">Salir</button>
                        </p>
                    </form>
                </div>
            </div>
            <br></br> 
            <br></br> 
        </div>
    </div>
</div>

<?php include("./template/footer.php"); ?>