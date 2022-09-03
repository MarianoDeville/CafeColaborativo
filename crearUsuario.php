<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");

    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $nom=(isset($_POST['nom']))?$_POST['nom']:"";
    $apell=(isset($_POST['apell']))?$_POST['apell']:"";
    $dni=(isset($_POST['dni']))?$_POST['dni']:"";
    $dir=(isset($_POST['dir']))?$_POST['dir']:"";
    $email=(isset($_POST['email']))?$_POST['email']:"";
    $pass=(isset($_POST['pass']))?$_POST['pass']:"";
    $repass=(isset($_POST['repass']))?$_POST['repass']:"";
    $existe = false;
    
    if($accion=="crearCuenta") {

        if($pass == $repass){

            if($nom != "" && $apell != "" && $dni != "" && $dir != "" && $email != "" && $pass != "") {

                $sentenciaSQL=$conexion->prepare("SELECT * FROM usuarios;");
                $sentenciaSQL->execute( );
                $listaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
         
                if(isset($listaUsuarios)){

                    foreach($listaUsuarios as $usuario) { 

                        if($usuario['email'] == $email) {
    
                            $existe=true;
                        }
                    }
                }

                if($existe == false) {

                    $sentenciaSQL=$conexion->prepare("INSERT INTO usuarios (nombreUsuario, apellido, dni, email, direccion, pass) VALUES (:nombre, :apellido, :dni, :email, :direccion, :pass)");
                    $sentenciaSQL->bindParam(':nombre', $nom);
                    $sentenciaSQL->bindParam(':apellido', $apell);
                    $sentenciaSQL->bindParam(':dni', $dni);
                    $sentenciaSQL->bindParam(':email', $email);
                    $sentenciaSQL->bindParam(':direccion', $dir);
                    $sentenciaSQL->bindParam(':pass', $pass);
                    $sentenciaSQL->execute( );
                    $_SESSION["nombre"] = $email;
                    header('Location:index.php');
                } else {

                    ?>
                        <p style="color: white;"><?php echo "El nombre de usuario ya existe.";?></p> 
                    <?php
                }
            } else {

                ?>
                    <p style="color: white;"><?php echo "Los campos están incompletos.";?></p> 
                <?php
            }
        } else {

            ?>
                <p style="color: white;"><?php echo "Las contraseñas son distintas";?></p> 
            <?php
        }
    }
?>

<div class="jumbotron">
    
    <h1 style="color: white;" class="display-3">Registro</h1>
    <p class="lead">Por favor ingrese sus datos:</p>
    <hr class="my-2">
</div>

<div class="container">
    
    <div class="row">

        <div class="col-md-4 fw-bold">
            
            <div class="card">  

                <div class="card-body">
                    
                    <form method="POST">

                        <div class = "form-group fw-bold">

                            <p><label>Nombre:</label><input type="text" class="form-control" name="nom" id="nom" value="<?php echo  $nom; ?>"></p>
                            <p><label>Apellido:</label><input type="text" class="form-control" name="apell" id="apell" value="<?php echo  $apell; ?>"></p>
                            <p><label>DNI:</label><input type="number" class="form-control" name="dni" id="dni" value="<?php echo  $dni; ?>"></p>
                            <p><label>Email:</label><input type="text" class="form-control" name="email" id="email" value="<?php echo  $email; ?>"></p>
                            <p><label>Dirección:</label><input type="text" class="form-control" name="dir" id="dir" value="<?php echo  $dir; ?>"></p>
                        </div>

                        <div class="form-group fw-bold">

                            <p><label>Contraseña:</label><input type="password" class="form-control" name="pass"></p>
                            <p><input type="password" class="form-control" name="repass" placeholder="Repita la contraseña."></p>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="accion" value="crearCuenta">Crear cuenta</button>
                    </form>
                </div>
            </div>
            <br></br> 
            <br></br> 
        </div>
    </div>
</div>

<?php include("./template/footer.php"); ?>