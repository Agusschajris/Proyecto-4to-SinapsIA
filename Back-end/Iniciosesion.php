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
    <label for="mail">mail:</label>
    <input type="text" id="mail" name="mail" require >
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
    
  <a href="register.php">Registro</a>
    <!-- Botón para enviar el formulario -->
    <button type = "submit" > Verificar</button>
    <a href="configuracion.php">configuracion</a>

</form>
</body>
</html>

<?php 
include("functions.php");
require_once("dbconfig.php");
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("Location: index.php");
  exit();
}


if(post_request()){
$mail = test_input($_POST['mail']);
$contraseña = test_input($_POST['contrasenia']);

$query = "SELECT mail,nombre,contrasenia FROM medico WHERE mail = ? AND contrasenia = ?";

$stmt  = login($mysqli,$query,$mail,$cont);
if($stmt->num_rows > 0){
  echo "Iniciaste sesión";
  $_SESSION['mail'] = $mail;
  $_SESSION['contrasenia'] = $contraseña;
  $_SESSION['nombre'] = $nombre;
  $_SESSION['id'] = $id;
  $_SESSION['loggedin'] = true;
  

  header("Location: index.php");
}
else {
echo "El usuario o la contraseña es incorrecta";
}
}
else{
  echo "La contraseña no es valida";
}







?>