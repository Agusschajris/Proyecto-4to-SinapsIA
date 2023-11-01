<?php
include_once("../configuracion/dbconfig.php");
include_once("../configuracion/functions.php");
session_start();
echo $_POST['nombre'];



if(post_request()){
    if(!isset($_POST['mail'],$_POST['contrasenia'],$_POST['contrasenia2'])){
        echo "Completa el formulario";
    }
if(validate($_POST['contrasenia'],$_POST['contrasenia2'],$_POST['mail'])){

    $contcrypt = hash('sha256',$_POST['contrasenia']);
    $mail = $_POST['mail'];
    
    if($stmt= $mysqli->prepare("SELECT mail,contrasenia,nombre FROM medico WHERE mail = ?")){
        $stmt->bind_param("s",$_POST['mail']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0){
            echo "Ya existe el usuario";
    
        }else{
           
      $sql = "INSERT INTO medico (nombre,apellido,contrasenia,hospital,dni,mail) VALUES (?, ?, ?, ?, ?, ?)";
      $crearusuario = $mysqli->prepare($sql);
    $crearusuario -> bind_param("ssssis",$nombre,$apellido,$contcrypt,$institucion,$dni,$mail);

      
      if($crearusuario->execute()){
    echo"Usuario creado!";
    header("Location: ../home/index.php"); 
    $_SESSION['loggedin'] = true;
         
    } 
    else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
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
    <link rel="stylesheet" href="signup2.css">
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
            <form class="formulario" method="POST">
                
                <br><br>
                MAIL
                <br>
                <input type="mail" name="mail" id="mail">

                <br><br>
                CONTRASEÑA
                <br>
                <input type="password" name="contrasenia" id="contrasenia">

                <br><br>
                CONFIRMAR CONTRASEÑA
                <br>
                <input type="text" name="contrasenia2" id="contrasenia2">

                <input type="submit" value="guardar" class="guardar">
                
            </form>

            <br><br>

            

</body>
</html>

