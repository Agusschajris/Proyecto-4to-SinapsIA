<?php

include("functions.php");
require_once("dbconfig.php");

 
  
  
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
    <label for="apellido">apellido:</label>
    <input type="text" id="apellido" name="apellido" require >
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
    <label for="mail">mail:</label>
    <input type="text" id="mail" name="mail" require >
    <label for="image">Imagen:</label>
    <input type="file" id = "image" name= "image">

  <a href="Iniciosesion.php">Inicio sesion</a>
    <!-- Botón para enviar el formulario -->
    <input type="submit" value="Enviar">
    
   
  
  
  </form>
    </body>
    </html>
    
    <?php 
    
    if(!isset($_POST['nombre'],$_POST['contrasenia'],$_POST['mail'],$_POST['apellido'])){
        exit("Completa el formulario");

    }

    if(empty($_POST['nombre']) || empty($_POST['contrasenia'])|| empty($_POST['mail'] || empty($_POST['apellido']))){
        exit("Completa el formulario");
    }
    

    if(strlen($_POST['contrasenia'])>20 ||strlen($_POST['contrasenia'])<5 ){
      exit("La contraseña es muy corta");
    }
    checkmail($_POST['mail']);
    if(post_request()){
      $nombrecambio = test_input($_POST['nombre']);
      $contraseña = $_POST['contrasenia'];
      $mail = test_input($_POST['mail']);
      $apellido = test_input($_POST['apellido']);
      }


      $usuario = capitalizar($nombrecambio);
      $contcrypt = password_hash($contraseña,PASSWORD_DEFAULT);

if($stmt= $mysqli->prepare("SELECT mail,contrasenia,nombre FROM medico WHERE mail = ?")){
    $stmt->bind_param("s",$_POST['mail']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        echo "Ya existe el usuario";

    }else{
       
  $sql = "INSERT INTO medico (nombre,apellido,contrasenia,mail) VALUES (?,?,?,?)";
  $crearusuario = $mysqli->prepare($sql);
  $crearusuario->bind_param("ssss",$usuario,$apellido,$contcrypt,$mail);
  if($crearusuario->execute()){
echo"Usuario creado!";      } 
else {
          echo "Hubo un error";
      }
    }
}




    ?>