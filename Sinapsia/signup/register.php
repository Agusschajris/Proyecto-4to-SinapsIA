<?php

include("../functions.php");
require_once("../dbconfig.php");
session_start();
if(post_request()){
  if(!isset($_POST['nombre'],$_POST['contrasenia'],$_POST['mail'],$_POST['apellido'],$_POST['institucion'],$_POST['dni'])){
        echo "Completa el formulario";

    }
  
  $nombre = test_input($_POST['nombre']);
  $contraseña = $_POST['contrasenia'];
  $mail = $_POST['mail'];
  $apellido = test_input($_POST['apellido']);
  $institucion = test_input($_POST['institucion']);
  $dni = test_input($_POST['dni']);
    

    if(empty($_POST['nombre']) || empty($_POST['contrasenia'])|| empty($_POST['mail']) || empty($_POST['apellido']) || empty($_POST['institucion']) || empty($_POST['dni'])){
        echo("Completa el formulario");
    }
    
    if(!is_numeric($dni) || strlen($dni) != 8){
      exit("El dni debe ser un numero de 8 digitos");
    } 

    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
      exit("El campo 'nombre' tiene que contener solo letras.");
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $apellido)) {
      exit("El campo 'apellido' tiene que contener solo letras.");
    }
    if(strlen($_POST['contrasenia'])>20 ||strlen($_POST['contrasenia'])<5 ){
      exit("La contraseña es muy corta");
    }
    checkmail($_POST['mail']);
    


      $usuario = capitalizar($nombre);
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
echo"Usuario creado!";
header("Location: ../login/hola.php");      } 
else {

          echo "Hubo un error";
      }
    }
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
    <link rel="stylesheet" href="Signup1.css">
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
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
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


                <br><br>
                <label for= "MAIL">
                MAIL
                <br>
                <input type="text" id="mail" name="mail" placeholder="Ingresa tu correo">
                </label>

                <br><br>
                <label for= "DNI">
                DNI
                <br>
                <input type="text" id="dni" name="dni" placeholder="Ingresa tu DNI">
                </label>

                <br><br>
                <label for= "INSTITUCIÓN">
                INSTITUCIÓN
                <br>
                <input type="text" id="institucion" name="institucion" placeholder="Ingresa tu institución">
                </label>
                <button type="submit" class="guardar">
                GUARDAR
            </button>
            </form>

            <br><br>

            

</body>
</html>