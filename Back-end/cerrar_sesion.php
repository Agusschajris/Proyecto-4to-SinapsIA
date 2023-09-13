<?php
include("functions.php");
require_once("dbconfig.php");
session_start();
if(isset($_POST['eliminar'])){
  $mail = $_SESSION['mail'];
  $stmt = eliminar_cuenta($mysqli,$mail);
  if($stmt->affected_rows > 0){
    echo "Se eliminó la cuenta";
    session_destroy();
    header("Location: Iniciosesion.php"); 
    exit();

  }
  else {
    echo "No se eliminó la cuenta";
  }
}

elseif(isset($_POST['cerrar'])){
    session_destroy();

  header("Location: Iniciosesion.php"); // Redirige al usuario a la página de inicio de sesión
  exit();

}




?>