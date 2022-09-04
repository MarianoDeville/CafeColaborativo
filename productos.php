<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");
    
    $txtUsuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtCant=(isset($_POST['txtCant']))?$_POST['txtCant']:"";
    $txtStock=(isset($_POST['txtStock']))?$_POST['txtStock']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    if($accion=="Agregar"){

        if($txtUsuario==""){

            header('Location:login.php');
        } else if($txtStock >= $txtCant){

            $sentenciaSQL=$conexion->prepare("INSERT INTO carrito (usuario, idProducto, cant) VALUES (:usuario,:idpruducto,:cantidad)");
            $sentenciaSQL->bindParam(':usuario',$txtUsuario);
            $sentenciaSQL->bindParam(':cantidad',$txtCant);
            $sentenciaSQL->bindParam(':idpruducto',$txtID);
            $sentenciaSQL->execute();
            $sentenciaSQL=$conexion->prepare("UPDATE productos SET cantidad =cantidad-:cantidad WHERE idproductos=:id;");
            $sentenciaSQL->bindParam(':cantidad',$txtCant);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute( );
        }
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM productos;");
    $sentenciaSQL->execute( );
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="table-responsive-lg">

    <table class="table table-bordered table-dark table-striped table-hover">

        <thead>
            <tr>
            <th style="color: white;">Imagen</th>
            <th style="color: white;">Producto</th>
            <th style="color: white;">Precio</th>
            <th style="color: white;">Stock</th>
            <th style="color: white;">Cantidad</th>
            <th style="color: white;">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($listaProductos as $productos) {?>

                <tr>
                    <form method="post">
                        <td><img src="./img/photo-coffee.png" ></td>
                        <td style="color: white;"><?php echo $productos['nombre']; ?></td>
                        <td style="color: white;"><?php echo $productos['precio']; ?></td>
                        <td style="color: white;"><?php echo $productos['cantidad']; ?></td>
                        <td style="color: white;"><input type="number" class="form-control" name="txtCant" id="txtCant" value="1" placeholder="Cant."></td>
                        <td>

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $productos['idproductos']; ?>"/>
                            <input type="hidden" name="txtStock" id="txtStock" value="<?php echo $productos['cantidad']; ?>"/>
                            <input type="submit" name="accion" value="Agregar" class="btn btn-success btn-sm"/>
                        </td>
                    </form>
                </tr>
            <?php }?>
        </tbody>
    </table>
    <br>
    <br>
</div>  
<?php include("./template/footer.php"); ?>