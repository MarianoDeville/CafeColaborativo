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
    $idusuario=(isset($usuario['idusuarios']))?$usuario['idusuarios']:"";

    switch($accion){

        case "logout":
            session_unset();
            header('Location:index.php');
            break;

        case "guardar":
            $nom=$_POST['nom'];
            $apell=$_POST['apell'];
            $dni=$_POST['dni'];
            $email=$_POST['email'];
            $dir=$_POST['dir'];
            $sentenciaSQL=$conexion->prepare("UPDATE usuarios SET nombreUsuario=:nom, apellido=:apell, dni=:dni, email=:email, direccion=:dir 
                                            WHERE idusuarios=:id");
            $sentenciaSQL->bindParam(':nom',$nom);
            $sentenciaSQL->bindParam(':apell',$apell);
            $sentenciaSQL->bindParam(':dni',$dni);
            $sentenciaSQL->bindParam(':email',$email);
            $sentenciaSQL->bindParam(':dir',$dir);
            $sentenciaSQL->bindParam(':id',$idusuario);
            $sentenciaSQL->execute();
            ?>
                <p style="color: white;"><?php echo  "Se han actualizado los datos."; ?></p> 
            <?php
            break;

        case "cambiarPass":
            $_SESSION['pass'] = $usuario['pass'];
            header('Location:cambiarContraseña.php');
            break;

        case "borrarUsuario":
            header('Location:borrarUsuario.php');
            break;
    }
  ?>

<div class="jumbotron">
    
    <h1 style="color: white;" class="display-3">Datos usuario</h1>
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
                            <button type="submit" class="btn btn-success" name="accion" value="logout">Salir</button>
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