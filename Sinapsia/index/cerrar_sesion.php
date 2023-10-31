<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if(isset($_POST['cerrar'])){
    session_destroy();

  header("Location: ../signup/register.php"); // Redirige al usuario a la página de inicio de sesión
  exit();

}





?>