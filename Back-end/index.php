<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="cerrar_sesion.php" method="POST">
 <input type="submit" value="Cerrar sesión" name ="cerrar">
 <a href="configuracion.php">configuracion</a>
 <input type="submit" value="Eliminar cuenta" name="eliminar">
   </form>  

 
  
</body>
</html>


<?php 
session_start();
require_once("dbconfig.php");

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $id_mail = $_SESSION['mail'];
    $query = "SELECT nombre FROM medico WHERE mail = ?"  ;
    if($stmt = $mysqli->prepare($query)){
        $stmt -> bind_param("s",$id_mail);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nombre);
        $stmt->fetch();
        echo "Bienvenido ".$nombre;       
}



}
else{
    header("Location: Iniciosesion.php");
    exit();
}



?>