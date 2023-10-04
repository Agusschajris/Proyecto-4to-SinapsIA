<?php
include("/functions.php");
require_once("/dbconfig.php");
session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("Location: index.php");
  exit();
}

if(!isset($_POST['mail'],$_POST['contrasenia'])){
echo "Ingresar el usuario y la contraseña";
}
if(post_request()){
$mail = test_input($_POST['mail']);
$contraseña = $_POST['contrasenia'];

$query = "SELECT mail,nombre,contrasenia FROM medico WHERE mail = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s",$mail);
$stmt  = login($mysqli,$query,$mail);
$stmt->bind_result($mail,$nombre,$contrasenia);
$stmt->fetch();


if($stmt->num_rows > 0 && password_verify($contraseña,$contrasenia)){
  echo "Iniciaste sesión";
  $_SESSION['mail'] = $mail;
  $_SESSION['contrasenia'] = $contraseña;
  $_SESSION['nombre'] = $nombre;
  $_SESSION['loggedin'] = true;  
  header("Location: index.php");

}
else {
echo "El usuario o la contraseña es incorrecta";
}
}





?>