<?php

    include("../config/bd.php");
 
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";
    
    if($accion=="Resetear"){

        $nCant = 100;
        $sentenciaSQL=$conexion->prepare("UPDATE productos SET cantidad =:cantidad WHERE idproductos=:id;");
        $sentenciaSQL->bindParam(':cantidad',$nCant);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute( );
    }
    $sentenciaSQL=$conexion->prepare("SELECT * FROM productos;");
    $sentenciaSQL->execute( );
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html lang="es">
<head background="../img/photo-coffee.jpg">

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Café colaborativo</title>

	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<ul class="nav navbar-nav">

			<li class="nav-item">
				<a class="nav-link" href="../index.php">Home </a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="../nosotros.php">Nosotros </a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="../productos.php">Comprar</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="#">Carrito</a>
			</li>
		</ul>
	</nav>

	<div class="container">
		
		<br/>
		<div class="row">

            <div class="col-md-7">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($listaProductos as $productos) {?>

                            <tr>

                                <td><?php echo $productos['idproductos']; ?></td>
                                <td><?php echo $productos['nombre']; ?></td>
                                <td><?php echo $productos['precio']; ?></td>
                                <td><?php echo $productos['cantidad']; ?></td>
                                <td>
                                                        
                                    <form method="post">

                                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $productos['idproductos']; ?>"/>
                                        <input type="submit" name="accion" value="Resetear" class="btn btn-primary"/>
                                    </form>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</body>
</html>