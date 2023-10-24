<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("Location: http://localhost/Proyecto-4to-SinapsIA/Sinapsia/index/index.php");
  exit;
}
if(post_request()){
if(!isset($_POST['mail'],$_POST['contrasenia'],$_POST['apellido'],$_POST['nombre'])){
echo "Ingresar el usuario y la contraseña";
}
$mail = $_POST['mail'];
$nombre = $_POST['nombre'];
$contraseña = $_POST['contrasenia'];

$query = "SELECT mail,nombre,contrasenia FROM medico WHERE nombre = ? OR mail = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss",$nombre,$mail);
if($stmt->execute()){
    $stmt->store_result();
$stmt->bind_result($mail,$nombre,$contrasenia);
$stmt->fetch();
}
else{
  echo "No se pudo ejecutar";
}

if($stmt->num_rows > 0 && password_verify($contraseña,$contrasenia)){
  echo "Iniciaste sesión";
  $_SESSION['mail'] = $mail;
  $_SESSION['contrasenia'] = $contraseña;
  $_SESSION['nombre'] = $nombre;
  $_SESSION['loggedin'] = true;  
  header("Location: http://localhost/Proyecto-4to-SinapsIA/Sinapsia/index/index.php");


}
else {
echo "El usuario o la contraseña es incorrecta";
}
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="./Login-estilo.css">
    <title>Document</title>  

</head>
<body>
    <div class="contenedor">
        <div class="marco-azul">
            <H1>
                LOG IN
                <br>
            </H1>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Prompt:ital,wght@0,400;0,500;1,200&display=swap" 
                rel="stylesheet">
            <form class="form" action="" method="POST">
                <label for= "NOMBRE">
                NOMBRE
                <br>
                <input type="text" id="nombre" name="nombre"placeholder="Ingresa tu nombre">
                </label>

                <br><br>
                <label for= "APELLIDO">
                APELLIDO
                <br>
                <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido">
                </label>

                <br><br>
                <label for= "CONTRASEÑA">
                CONTRASEÑA
                <br>
                <input type="text" id="contrasenia" name="contrasenia" placeholder="Elige una contraseña">
                </label>

               <!--
                <br><br>
                <label for= "MAIL">
                MAIL
                <br>
                <input type="text" placeholder="Ingresa tu correo">
                </label>

                <br><br>
                <label for= "DNI">
                DNI
                <br>
                <input type="text" placeholder="Ingresa tu DNI">
                </label>

                <br><br>
                <label for= "INSTITUCIÓN">
                INSTITUCIÓN
                <br>
                <input type="text" placeholder="Ingresa tu institución">
                </label>
                -->
            <button type="submit" class="guardar">
                GUARDAR
            </button>
            </form>

            <br><br>

            

            <br><br>
        
            <p class="no-tenes-una-cuenta">
                ¿NO TENÉS UNA CUENTA?
            </p>
            <button class="crea-una"
            onclick="window.location.href = 'file:'">
                ¡CREÁ UNA!
            </button>
    </div>
    </div>
</body>
</html>