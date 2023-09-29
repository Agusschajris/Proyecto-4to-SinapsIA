<?php

include("../functions.php");
require_once("../dbconfig.php");
session_start();
if(post_request()){
  $nombre = test_input($_POST['nombre']);
  $contraseña = $_POST['contrasenia'];
  $mail = test_input($_POST['mail']);
  $apellido = test_input($_POST['apellido']);
  $institucion = test_input($_POST['institucion']);
  $dni = test_input($_POST['dni']);
  }
    
    if(!isset($_POST['nombre'],$_POST['contrasenia'],$_POST['mail'],$_POST['apellido'],$_POST['institucion'],$_POST['dni'])){
        exit("Completa el formulario");

    }

    if(empty($_POST['nombre']) || empty($_POST['contrasenia'])|| empty($_POST['mail']) || empty($_POST['apellido']) || empty($_POST['institucion']) || empty($_POST['dni'])){
        exit("Completa el formulario");
    }
    
    if(!is_numeric($dni)){
      exit("El dni debe ser un numero");
    } 

    if (!preg_match("/^[a-zA-Z]+$/", $nombre)) {
      exit("El campo 'nombre' tiene que contener solo letras.");
    }
    if (!preg_match("/^[a-zA-Z]+$/", $apellido)) {
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
header("Location: ../login/Iniciosesion.php");      } 
else {
          echo "Hubo un error";
      }
    }
}


    ?>