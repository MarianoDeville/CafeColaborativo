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
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)
?>

<div class="<div class="d-none d-sm-block">
    
    <table class="table table-bordered">

        <thead>
            <tr>
            <th>Img</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Cantidad</th>
            <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($listaProductos as $productos) {?>

                <tr>
                    <form method="post">
                        <td><img src="./img/photo-coffee.png" ></td>
                        <td><?php echo $productos['nombre']; ?></td>
                        <td><?php echo $productos['precio']; ?></td>
                        <td><?php echo $productos['cantidad']; ?></td>
                        <td><input type="text" class="form-control" name="txtCant" id="txtCant" value="1" placeholder="Cant."></td>
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
</div>  
<?php include("./template/pie.php"); ?>