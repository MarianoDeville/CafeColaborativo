<?php 
    include("./template/cabecera.php");

    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $txtUsuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
        
    if($accion=="entrar") {

        if($txtUsuario!="") {

            $_SESSION["nombre"] = $txtUsuario;
            header('Location:index.php');
        }
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            
            <br/>
            <div class="card">
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    
                    <form method="POST">

                        <div class = "form-group">

                            <label>Usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su nombre de usuario.">
                            <small id="emailHelp" class="form-text text-muted">Nunca comparta sus datos con nadie.</small>
                        </div>

                        <div class="form-group">

                            <label>Contraseña:</label>
                            <input type="password" class="form-control" name="contraseña" placeholder="Escriba su contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary" name="accion" value="entrar">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./template/pie.php"); ?>