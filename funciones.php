<?php
session_start();

function validarRegistro($datos){

  $errores = [];

  if ($datos) {
    if (strlen($datos["nombre"])==0) {
      $errores[] = "El campo nombre se encuentra vacio";
    }
    if (strlen($datos["apellido"])==0) {
      $errores[] = "El campo apellido se encuentra vacio";
    }
    if (!filter_var($datos["email"],FILTER_VALIDATE_EMAIL)) {
      $errores[] = "El email tiene un formato incorrecto";
    }
    if (strlen($datos["contrasena"])<=6) {
      $errores[] ="La contraseña tiene menos de 6 caracteres";
    }
    if ($datos["contrasena"] != $datos["contrasena2"]) {
      $errores[] = "Las contraseñas no coinciden";
    }

    if ($_FILES != null){
      if ($_FILES["imagen"]["error"]!=0){
        $errores["imagen"] = "No recibi la imagen";
      }
      $nombimg = $_FILES["imagen"]["name"];
      $ext = pathinfo($nombimg, PATHINFO_EXTENSION);
      if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
        $errores["imagen"] = "La extension del archivo es incorrecto";
      }
    }
  }
  return $errores;
}


function validarLogin($datos){

  $errores = [];

  $usuario = buscarPorEmail($datos["email"]);

  if ($usuario == null) {
    $errores[] = "Usuario no se encuentra registrado";
  }

  if (password_verify($datos["contrasena"], $usuario["contrasena"]) == false) {
    $errores[] = "La contraseña es incorrecta";
  }

  return $errores;
}


function armarUsuario($datos, $imagen){


  $contraHash = password_hash($datos["contrasena"], PASSWORD_DEFAULT);

  $usuario = [
    "nombre" => $datos["nombre"],
    "apellido" => $datos["apellido"],
    "email" => $datos["email"],
    "contrasena" => $contraHash,
    "imagen" => $imagen,
  ];

  return $usuario;
}


function guardarUsuario($usuario){
  $json = json_encode($usuario);
  file_put_contents("usuarios.json",$json.PHP_EOL, FILE_APPEND);
}

function persistir($input){
  if(isset($_POST[$input])){
    return $_POST[$input];
  }
}


function abrirBaseDatos(){
    if(file_exists("usuarios.json")){

        $baseDatosJson= file_get_contents("usuarios.json");


        $baseDatosJson = explode(PHP_EOL,$baseDatosJson);


        array_pop($baseDatosJson);


        foreach ($baseDatosJson as  $usuarios) {
            $arrayUsuarios[]= json_decode($usuarios,true);
        }

        return $arrayUsuarios;

    }else{
        return null;
    }
}

function buscarPorEmail($email){

  $baseDeDatos = abrirBaseDatos();

  foreach ($baseDeDatos as $usuario) {

    if ($email == $usuario["email"]) {
      return $usuario;
    }
}
return null;
}

function armarImagen($imagen){

  $nombre = $_FILES["imagen"]["name"];
  $ext = pathinfo($nombre, PATHINFO_EXTENSION);

  $archivoOrigen = $_FILES["imagen"]["tmp_name"];

  $rutaDestino = dirname(__FILE__);
  $rutaDestino = $rutaDestino."/fotos/";

  $nombreImg = uniqid();


  $rutaDestino = $rutaDestino.".".$nombreImg.".".$ext;


  move_uploaded_file ($archivoOrigen, $rutaDestino);

  return $nombreImg.".".$ext;
}


function inicioSesion($usuario, $datos){
  $_SESSION["nombre"] = $usuario["nombre"];
  $_SESSION["apellido"] = $usuario["apellido"];
  $_SESSION["email"] = $usuario["email"];
  $_SESSION["imagen"] = $usuario["imagen"];
  if(isset($dato["recordar"])){
        setcookie("email",$dato["email"],time()+3600);
        setcookie("password",$dato["contrasena"],time()+3600);
    }
}








 ?>
