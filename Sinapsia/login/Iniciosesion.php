<?php
include("../configuracion/functions.php");
require_once("../configuracion/dbconfig.php");
session_start();


$errors = [];
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
    header("Location: ../home/index.php");

if (post_request()) {
    if (!isset($_POST['mail'], $_POST['contrasenia']))
        echo "Ingresar el usuario y la contraseña";

    if (empty($_POST['mail']) || empty($_POST['contrasenia']))
        $errors[] = "Debe completar todos los campos";

    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
        $errors[] = "El mail ingresado no es válido.";

    if ($errors) {
        foreach ($errors as $error)
            echo $error;
        return;
    }

    $mail = $_POST['mail'];
    $contraseña = $_POST['contrasenia'];

    //$query = "SELECT mail,nombre,contrasenia,apellido FROM medico WHERE mail = ?";
    $result = pg_query_params($pgsql, 'SELECT mail,nombre,contrasenia,apellido FROM medico WHERE mail = $1', array($mail))
        or die('Error: ' . pg_last_error());

    /*
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s",$mail);
    if($stmt->execute()){
        $stmt->store_result();
        $stmt->bind_result($mail,$nombre,$contrasenia,$apellido);
        $stmt->fetch();
    }
    else{
    echo "No se pudo ejecutar";
    }
    */

    $row = pg_fetch_row($result);

    if (!password_verify($contraseña, $row['contrasenia'])) {
        echo "El usuario o la contraseña es incorrecta";
        return;
    }

    echo "Iniciaste sesión";
    $_SESSION['mail'] = $row['mail']; // $mail;
    $_SESSION['nombre'] = $row['nombre']; // $nombre;
    $_SESSION['apellido'] = $row['apellido'] // $apellido;
    $_SESSION['loggedin'] = true;  
    header("Location: ../home/index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" type="text/css" href="./Login-estilo.css">
    <title>Document</title>  

</head>
<body>
    <div class="contenedor">
        <div class="marco-azul">
            <H1>
                LOG IN
                <br>
            </H1>
            <form class="formulario" method="POST">
                MAIL
                <br>
                <input type="email" id="mail" name="mail">
            
                <br><br>
                CONTRASEÑA
                <br>
                <input type="password" id="contraseña" name="contrasenia">

                <br><br>


                <input type="submit" value="INGRESAR" class="ingresar">


<br><br>
                
            </form>


        
            <p class="no-tenes-una-cuenta" class="cuenta">
                ¿NO TENÉS UNA CUENTA?
            </p>
            <button class="crea-una" 
            onclick="window.location.href = '/Proyecto-4to-SinapsIA/Sinapsia/signup/register.php'">
                ¡CREÁ UNA!
            </button>
    </div>
    </div>
    
</body>
</html>