<?php

include("../configuracion/functions.php");
require_once("../configuracion/dbconfig.php");
session_start();
if(post_request()){
  if(!isset($_POST['nombre'],$_POST['apellido'],$_POST['institucion'],$_POST['dni'])){
        echo "Completa el formulario";

    }
  
  $nombre = test_input($_POST['nombre']);
  $apellido = test_input($_POST['apellido']);
  $institucion = test_input($_POST['institucion']);
  $dni = test_input($_POST['dni']);
    

    if(empty($_POST['nombre'])  || empty($_POST['apellido']) || empty($_POST['institucion']) || empty($_POST['dni'])){
      echo("Completa el formulario");
    }
    
    if(!is_numeric($dni) || strlen($dni) != 8){
      echo("El dni debe ser un numero de 8 digitos");
    } 

    if (!preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
      echo("El campo 'nombre' tiene que contener solo letras.");
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $apellido)) {
      echo("El campo 'apellido' tiene que contener solo letras.");
    }
   
    $usuario = capitalizar($nombre);
    $apellido = capitalizar($apellido);
    if($_POST["siguiente"]){
      $_SESSION['nombre'] = $nombre;
      $_SESSION['apellido'] = $apellido;
      $_SESSION['institucion'] = $institucion;
      $_SESSION['dni'] = $dni;
      header("Location: ../signup2/signup2.php");
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
                SIGN UP
                <br>
            </H1>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Prompt:ital,wght@0,400;0,500;1,200&display=swap" 
                rel="stylesheet">


            <form class="formulario needs-validation" novalidate method="POST" action="">

                 NOMBRE
                <br>
                <input type="text" id="nombre" name="nombre" required minlength="2" maxlength="30">
    

                <br><br>
                APELLIDO
                <br>
                <input type="text" name="apellido" required minlength="2" maxlength="30">

                <br><br>
                DNI
                <br>
                <input type="text" id="dni" name="dni" required min="0">

                <br><br>
                INSTITUCIÓN
                <br>
                <input type="text" id="institucion" name="institucion" required minlength="2" maxlength="40">
                <input type="submit" name="siguiente" value="SIGUIENTE" class="SIGUIENTE">
            </form>
            

<br><br>
 
               <!-- <input type="submit" name="siguiente" value="SIGUIENTE" class="SIGUIENTE"
            onclick="window.location.href = './controller.php'"> -->

</body>

</html>