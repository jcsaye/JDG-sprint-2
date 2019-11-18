<?php
require_once("funciones.php");


if ($_POST) {

  $errores = validarLogin($_POST);
  if (count($errores) == 0) {

    $usuario = buscarPorEmail($_POST["email"]);

    inicioSesion($usuario, $datos);

    armarImagen($imagen);



  header("Location:perfil.php");
  }
}
// var_dump($_COOKIE);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Pagina de Inicio - DJG Computer</title>
	<link rel="stylesheet" href="css/estilo.css">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
  <?php if (isset($errores)): ?>
    <?php foreach ($errores as $key => $error): ?>
        <li class="alert alert-danger"><?=$error?></li>
    <?php endforeach; ?>
  <?php endif; ?>
	<header>
	          <div class="header-inner">
	            <a href="index.php" id="logo">
	            <img src="img/logoJDG.png" alt="logoJDG">
	            </a>
						</div>
	</header>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Iniciar Sesion</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form class="" action="iniciosesion.php" method="POST" >
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" name="email" value="">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control"  name="contrasena" value"">

					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" name="recordar" value="S">Recordame
					</div>
					<div class="form-group">
						<!-- <input  type="submit" value="Ingresar" class="btn float-right login_btn"> -->
						<button type="submit" name="button">Iniciar Sesion</button>
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					No tienes una Cuenta?<a href="registro1.php">Registrate</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Olvidaste tu Contraseña?</a>
				</div>
			</div>
		</div>
	</div>
</div>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</body>
</html>
