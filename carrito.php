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
    $listaCarrito=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)
?>

<div class="<div class="d-none d-sm-block">
    
    <table class="table table-bordered">

        <thead>
            <tr>
            <th>Img</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
            <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach($listaCarrito as $productos) {?>

                <tr>
                    <form method="post">
                        <td><img src="./img/photo-coffee.png" ></td>
                        <td><?php echo $productos['nombre']; ?></td>
                        <td><?php echo $productos['precio']; ?></td>
                        <td><?php echo $productos['cant']; ?></td>
                        <td><?php echo $productos['cant']*$productos['precio']; ?></td>
                        <td>
                            <?php $total+=$productos['cant']*$productos['precio']; ?>
                            <input type="hidden" name="txtIdCarrito" id="txtIdCarrito" value="<?php echo $productos['idcarrito']; ?>"/>
                            <input type="submit" name="accion" value="Eliminar" class="btn btn-danger btn-sm"/>
                        </td>
                    </form>
                </tr>
            <?php }?>
        </tbody>
    </table>

    <tr>
        <form method="post">
            <td>
                <h2><?php echo "Total a pagar: $ ".$total; ?></h2>
                <p align="right">   
                    
                    <input type="hidden" name="txtTotalCompra" id="txtTotalCompra" value="<?php echo $total; ?>"/>
                    <input type="submit" name="accion" value="Vaciar" class="btn btn-danger btn-sm"/>
                    <input type="submit" name="accion" value="Comprar" class="btn btn-success btn-sm"/>
                </p>
            </td>
        </form>
    </tr>
</div>
<?php include("./template/footer.php"); ?>