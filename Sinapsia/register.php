<?php

include("functions.php");
$_ENV = parse_ini_file(".env");
$mysqli= Mysql($_ENV);
 
  if(post_request()){
  $nombrecambio = $_POST['nombre'];
  $contraseña = $_POST['contrasenia'];
  $mail = $_POST['mail'];
  }
  
  /*$sql = "UPDATE medico SET nombre = ?, contrasenia = ? WHERE idmedico = 1";
  
    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param("s", $nombrecambio);
  
    if ($stmt->execute()) {
      echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: ";
    }
    */
    
  
      
  /*$nombreagregado = $_POST['nombre2'];
  $sqlcambio = "INSERT INTO medico (nombre) VALUES (?)";
  $change = $mysqli->prepare($sqlcambio);
  $change->bind_param("s", $nombreagregado);
  if($change->execute()){
    echo "cambio";
      } else {
          echo "no cambio ";
      }
  */
  
  
  
  
  
  
  
    
  ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
    </head>
    <body>
    <form action = "" method = 'POST'>
    <!-- Campo de entrada para el nombre -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" require >
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
    <label for="mail">mail:</label>
    <input type="text" id="mail" name="mail" require >
  <a href="Iniciosesion.php">Inicio sesion</a>
    <!-- Botón para enviar el formulario -->
    <input type="submit" value="Enviar">
    
   
  
  
  </form>
    </body>
    </html>
    
    <?php 
    
    if(!isset($_POST['nombre'],$_POST['contrasenia'],$_POST['mail'])){
        exit("Completa el formulario");

    }

    if(empty($_POST['nombre']) || empty($_POST['contrasenia'])|| empty($_POST['mail'])){
        exit("Completa el formulario");
    }
    

    if(strlen($_POST['contrasenia'])>20 ||strlen($_POST['contrasenia'])<5 ){
      exit("La contraseña es muy corta");
    }
    
    checkmail($_POST['mail']);

if($stmt= $mysqli->prepare("SELECT mail,contrasenia,nombre FROM medico WHERE mail = ?")){
    $stmt->bind_param("s",$_POST['mail']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        echo "Ya existe el usuario";

    }else{
       
        $sql = "INSERT INTO medico (nombre,contrasenia,mail) VALUES (?,?,?)";
  $change = $mysqli->prepare($sql);
  $change->bind_param("sss", $nombrecambio, $contraseña, $mail);
  if($change->execute()){
echo"Usuario creado!";      } 
else {
          echo "Hubo un error";
      }
    }
}
    ?>
  
    

