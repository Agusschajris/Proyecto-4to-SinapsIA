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
    <input type="text" id="mail" name="mail" require value =<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>>
    
    
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require value =<?php echo isset($_POST['contrasenia']) ? htmlspecialchars($_POST['contrasenia']): ' ';?>>
    
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

if(!isset($_POST['mail'],$_POST['contrasenia'])){
echo "Ingresar el usuario y la contraseña";
}
if(post_request()){
$mail = test_input($_POST['mail']);
$contraseña = $_POST['contrasenia'];

$query = "SELECT mail,nombre,contrasenia FROM medico WHERE mail = ?";

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