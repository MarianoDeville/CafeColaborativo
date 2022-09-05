<?php 
	session_start();
	$txtUsuario=(isset($_SESSION['nombre']))?$_SESSION['nombre']:"";
?>

<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
</head>
<body style = "background: url('./img/cafe.jpeg') no-repeat; background-size: cover; background-position: fixed; background-attachment: fixed; margin-top: 0; margin: 0; padding: 0">
	


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#"><i class="fas fa-coffee"></i> CafeColaborativo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
        </li>
		<li class="nav-item">
				<a class="nav-link px-3 text-white" href="nosotros.php">Nosotros </a>
			</li>

			<li class="nav-item">
				<a class="nav-link px-3 text-white" href="productos.php">Comprar</a>
			</li>

			<li class="nav-item">
				<a class="nav-link px-3 text-white" href="carrito.php">Carrito</a>
			</li>
			<?php
				if($txtUsuario==""){ ?>

				<li class="nav-item">
					<a class="nav-link px-3 text-white" href="login.php">LogIn</a>
				</li>
			<?php } else { ?>

				<li class="nav-item">
					<a class="nav-link px-3 text-white" href="perfilUsuario.php"> <?php echo $txtUsuario; ?></a>
				</li>
			<?php } ?>
      </ul>
	  
    </div>
  </div>
</nav>





	<div class="container">
		
		<br/>
		<div class="row">