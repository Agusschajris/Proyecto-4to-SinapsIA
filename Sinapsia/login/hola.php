<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if($_SESSION['loggedin']==false){
    header("Location: Iniciosesion.php");
}

else{
    echo "hola ".$_SESSION['nombre'];
}
if(isset($_POST['cerrar'])){
    session_destroy();

  header("Location: Iniciosesion.php"); // Redirige al usuario a la página de inicio de sesión
  exit();


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  method="post">
        <input type="submit" value="cerrar" name="cerrar" id="cerrar">
    </form>
</body>
</html>