


<?php
require_once('funciones.php');

if ($_POST) {
  // Utilizando la funcion validarRegistro voy a validar todo lo que el usuario envio. Esta funcion va a retornar errores en caso de que algun campo no hya pasado alguna validacion.
  $errores = validarRegistro($_POST);
  // En caso de no haber errores se va a continuar con l de abajo, si hubiese errores estos se desplegaran en el html.
  if (count($errores) == 0) {
      // En este punto voy a buscar el email que ingreso el usuario en nuestra base de datos. La funcion buscarPorEmail retorna toda la informacion del usuario con ese mail.
      $usuario = buscarPorEmail($_POST["email"]);
      // var_dump($usuario);
      // exit;
      // En este if evaluo que en caso de que el usuario sea distinto de falso, es decir que buscarPorEmail me traiga informacion de un usuario se producira un error ya que implica que el usuario ya se encuentra registrado.
      if ($usuario != null) {
        $errores[] = "El email ya se encuentra registrado";
      } else {
        // En este caso si el usuario no fue registrado voy a utilizar las funciones aramrImagen y armarUsuario que van a armar el usuario para despues guardarlo en la base de datos.
        $imagen = armarImagen($_FILES["imagen"]);
        $usuario = armarUsuario($_POST, $imagen);
        guardarUsuario($usuario);
        // En caso de que toda la validacion sea exitosa se va a mandar al usuario a la pagina de login.
        header("Location:iniciosesion.php");
        exit;
      }
  }
}
var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Pagina de Regisrto - DJG Computer</title>
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>


  <body>
		<?php if (isset($errores)): ?>
			<?php foreach ($errores as $key => $error): ?>
					<li class="alert-danger"><?=$error?></li>
			<?php endforeach; ?>
		<?php endif; ?>
    <!-- <header>
  	          <div class="header-inner">
  	            <a href="index.html" id="logo">
  	            <img src="img/logoJDG.png" alt="logoJDG">
  	            </a>
  						</div>
  	</header> -->
<form class="" action="registro1.php" method="post" enctype="multipart/form-data">


    <div class="container register">

			<div class="header-inner">
				<a href="index.php" id="logo">
				<img src="img/logoJDG.png" alt="logoJDG">
				</a>
			</div>

                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Bienvenido</h3>
                        <p>Por favor complete todos los campos para registrarse como cliente en nuestro sistema</p>
                        <!-- <input src="iniciosesion.php" type="submit" name="" value="Iniciar Sesion"/><br/> -->
												<a class="btnRegister" href="iniciosesion.php" type="submit" Name="enviar" >iniciar sesion</a>

                    </div>



                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ver Carrito</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tu Compra</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">ALTA DE NUEVO CLIENTE</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Nombre*" name="nombre"value="<?=persistir("nombre") ?>"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Apellido *"  name="apellido" value="<?=persistir("apellido")?>" >
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Contraseña *" value="" name="contrasena" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control"  placeholder="Confirmar Contraseña *" value="" name="contrasena2" />
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl">
                                                <label class="radio inline">
                                                    <input type="radio" name="sexo" value="M" >
                                                    <span> Masculino </span>
                                                </label>
                                                <label  for="sexo"class="radio ">
                                                    <input type="radio" name="sexo" value="F">
                                                    <span>Femenino </span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Ingresa tu Email *" value="<?=persistir("email") ?>" name="email"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="10" maxlength="10" name="telefono" class="form-control" placeholder="Ingresa tu Telefono *" value="<?=persistir("telefono") ?>"/>
                                        </div>

                                        <div class="form-group">
																				<div class="">
																					<label for="">img de perfil</label>
																					<input type="file" name="imagen" value="<?=persistir("ext") ?>">
																					<input type="submit" class="btnRegister"  value="Registrarme"/>
																					</div>

																				</div>


						</form>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


  </body>
</html>
