<?php 
	session_start();
	$txtUsuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
?>

<!DOCTYPE html>
<html lang="eS">
<head background="./img/photo-coffee.jpg">

	<meta charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ejemplo de página - Hola mundo</title>

	<link rel="stylesheet" href="./css/bootstrap.min.css" />
	
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<ul class="nav navbar-nav">

			<li class="nav-item">
				<a class="nav-link" href="index.php">Home </a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="nosotros.php">Nosotros </a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="productos.php">Comprar</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="carrito.php">Carrito</a>
			</li>

			<?php
				if($txtUsuario==""){ ?>

					<li class="nav-item">
					<a class="nav-link" href="login.php">LogIn</a>
					</li>
			<?php } else { ?>

				<li class="nav-item">
				<a class="nav-link" href="logout.php">LogOut</a>
				</li>
			<?php } ?>
		</ul>
	</nav>

	<div class="container">
		
		<br/>
		<div class="row">