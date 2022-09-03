<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");

    $usuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    if($accion=="borrar") {

        $sentenciaSQL=$conexion->prepare("DELETE FROM usuarios WHERE email=:usuario");
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->execute();
        $_SESSION['nombre']="";
        header('index.php');
    }
    if($accion=="descartar") {

        header('Location:perfilUsuario.php');
    }
?>

<div class="jumbotron">

    <h1 style="color: white;" class="display-3">Eliminar cuenta.</h1>
    <p class="lead">Se eliminaran todos los datos de la cuenta.</p>
    <hr class="my-2">
</div>

<div class="container">

    <div class="row">

        <div class="col-md-4 fw-bold">

            <div class="card">  

                <div class="card-body">

                    <form method="POST">

                        <p>
                            <p>Está seguro de eliminar la cuenta? </p>
                            <button type="submit" class="btn btn-danger" name="accion" value="borrar">Aceptar</button>
                            <button type="submit" class="btn btn-warning" name="accion" value="descartar">Cancelar</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./template/footer.php"); ?>