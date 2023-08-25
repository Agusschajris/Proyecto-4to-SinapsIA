<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method = "POST">
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
    <label for="mail">mail:</label>
    <input type="text" id="mail" name="mail" require >
  <a href="register.php">Registro</a>
    <!-- Botón para enviar el formulario -->
    <button type = "submit" > Verificar</button>
</form>
</body>
</html>

<?php 
include("functions.php");
require_once("dbconfig.php");
session_start();

if(post_request()){
$mail = test_input($_POST['mail']);
$contraseña = test_input($_POST['contrasenia']);



$query = "SELECT mail,nombre,contrasenia FROM medico WHERE mail = ? AND contrasenia = ?";

$stmt  = login($mysqli,$query,$mail,$contraseña);
if($stmt->num_rows > 0){
  echo "Iniciaste sesión";
  $_SESSION["mail"] = $mail;
  header("Location: index.php");


}
else {
echo "El usuario o la contraseña es incorrecta";
}
}


?>