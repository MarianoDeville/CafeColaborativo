<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");

    $usuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
    $pass=(isset($_SESSION['pass']))?$_SESSION['pass']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $oldPass=(isset($_POST['pass']))?$_POST['pass']:"";
    $newPass=(isset($_POST['newPass']))?$_POST['newPass']:"";
    $rePass=(isset($_POST['confirmPass']))?$_POST['confirmPass']:"";

    if($accion=="guardar") {

        if($oldPass == $pass) {

            if($newPass != "" && $rePass == $newPass) {

                $sentenciaSQL=$conexion->prepare("UPDATE usuarios SET pass=:newPass WHERE email=:nom");
                $sentenciaSQL->bindParam(':newPass',$newPass);
                $sentenciaSQL->bindParam(':nom',$usuario);
                $sentenciaSQL->execute();
                $_SESSION['pass']=$newPass;
                ?>
                    <p style="color: white;"><?php echo "Se ha actualizado la contraseña.";?></p> 
                <?php
            } else {

                ?>
                    <p style="color: white;"><?php echo "Error en la nueva contraseña.";?></p> 
                <?php
            }

        } else {

            ?>
                <p style="color: white;"><?php echo "Contraseña incorrecta.";?></p> 
            <?php
        }
    }
    if($accion=="descartar") {

        header('Location:perfilUsuario.php');
    }
?>

<div class="jumbotron">

    <h1 style="color: white;" class="display-3">Cambiar contraseña</h1>
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
                            <label>Contraseña actual:</label>
                            <input type="password" class="form-control" name="pass" id="pass">
                        </p>

                        <p>
                            <label>Nueva contraseña:</label>
                            <input type="password" class="form-control" name="newPass" id="newPass">
                        </p>

                        <p>
                            <label>Repetir contraseña:</label>
                            <input type="password" class="form-control" name="confirmPass" id="confirmPass">
                        </p>
                        </div>

                        <p>
                            <button type="submit" class="btn btn-danger" name="accion" value="guardar">Guardar cambio</button>
                            <button type="submit" class="btn btn-warning" name="accion" value="descartar">Descartar cambio</button>
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