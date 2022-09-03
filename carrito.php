<?php 
    include("./template/cabecera.php");
    include("./config/bd.php");
    
    $txtUsuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
    $txtIdCarrito=(isset($_POST['txtIdCarrito']))?$_POST['txtIdCarrito']:"";
    $txtCant=(isset($_POST['txtCant']))?$_POST['txtCant']:"";
    $txtTotalCompra=(isset($_POST['txtTotalCompra']))?$_POST['txtTotalCompra']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    $total=0;

    switch($accion) {

        case "Vaciar":
            $sentenciaSQL=$conexion->prepare("DELETE FROM carrito WHERE usuario=:usuario");
            $sentenciaSQL->bindParam(':usuario',$txtUsuario);
            $sentenciaSQL->execute();
            break;

        case "Comprar":
            $sentenciaSQL=$conexion->prepare("DELETE FROM carrito WHERE usuario=:usuario");
            $sentenciaSQL->bindParam(':usuario',$txtUsuario);
            $sentenciaSQL->execute();
            
            $sentenciaSQL=$conexion->prepare("INSERT INTO compras (usuario, total) VALUES (:usuario,:totalcompra)");
            $sentenciaSQL->bindParam(':usuario',$txtUsuario);
            $sentenciaSQL->bindParam(':totalcompra',$txtTotalCompra);
            $sentenciaSQL->execute();
            break;
        
        case "Eliminar":
            $sentenciaSQL=$conexion->prepare("UPDATE productos JOIN cafeteria.carrito ON carrito.idProducto = productos.idproductos SET cantidad = cantidad + :cantidad WHERE idcarrito = :idCarrito");
            $sentenciaSQL->bindParam(':cantidad',$txtCant);
            $sentenciaSQL->bindParam(':idCarrito',$txtIdCarrito);
            $sentenciaSQL->execute( );
            $sentenciaSQL=$conexion->prepare("DELETE FROM carrito WHERE idcarrito=:idCarrito");
            $sentenciaSQL->bindParam(':idCarrito',$txtIdCarrito);
            $sentenciaSQL->execute();
            break;
    }

    $sentenciaSQL=$conexion->prepare("SELECT * FROM cafeteria.carrito 
                                    JOIN cafeteria.productos  ON productos.idproductos = carrito.idProducto 
                                    WHERE carrito.usuario = :usuario;");
    $sentenciaSQL->bindParam(':usuario',$txtUsuario);
    $sentenciaSQL->execute( );
    $listaCarrito=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="<div class="d-none d-sm-block">
    
    <table class="table table-bordered">

        <thead>
            <tr>
            <th style="color: white;">Img</th>
            <th style="color: white;">Producto</th>
            <th style="color: white;">Precio</th>
            <th style="color: white;">Cantidad</th>
            <th style="color: white;">Sub total</th>
            <th style="color: white;">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($listaCarrito as $productos) {?>

                <tr>
                    <form method="post">
                        <td><img src="./img/photo-coffee.png" ></td>
                        <td style="color: white;"><?php echo $productos['nombre']; ?></td>
                        <td style="color: white;"><?php echo $productos['precio']; ?></td>
                        <td style="color: white;"><?php echo $productos['cant']; ?></td>
                        <td style="color: white;"><?php echo $productos['cant']*$productos['precio']; ?></td>
                        <td style="color: white;">
                            <?php $total+=$productos['cant']*$productos['precio']; ?>
                            <input type="hidden" name="txtIdCarrito" id="txtIdCarrito" value="<?php echo $productos['idcarrito']; ?>"/>
                            <input  style="color: white;" type="hidden" name="txtCant" id="txtCant" value="<?php echo $productos['cant']; ?>"/>
                            <input  style="color: white;" type="submit" name="accion" value="Eliminar" class="btn btn-danger btn-sm"/>
                        </td>
                    </form>
                </tr>
            <?php }?>
        </tbody>
    </table>

    <tr>
        <form method="post">
            <td>
                <h2 style="color: white;"><?php echo "Total a pagar: $ ".$total; ?></h2>
                <p align="right">   
                    
                    <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="<?php echo $total; ?>"/>
                    <input type="submit" name="accion" value="Vaciar" class="btn btn-danger btn-sm"/>
                    <input type="submit" name="accion" value="Comprar" class="btn btn-success btn-sm"/>
                </p>
            </td>
        </form>
    </tr>
    <br>
    <br>
</div>
<?php include("./template/footer.php"); ?>