<?php
include("functions.php");
require_once("dbconfig.php");
session_start();
$tipoHabilitado = array("jpg","jpeg","gif","png");

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false){
  header("Location: index.php");
  exit();
}
if(post_request()){

if(!isset($_POST['nombre'],$_POST['apellido'],$_POST['hospital'],$_POST['telefono'],$_POST['mail'],$_POST['fecha'])){
    echo "Ingresar todos los datos";
    
}

if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['mail']) || empty($_POST['fecha'])){
    echo "Ingresar todos los datos";

}

checkmail($_POST['mail']);


if (preg_match("/^\d{10}$/", $_POST['telefono'])) {
    echo "<p>El número de teléfono ingresado es válido.</p>";
} else {
    echo "<p>El número de teléfono ingresado  no es válido. Debe contener 10 dígitos numéricos.</p>";
}

$hoy = date("Y-m-d");

        // Validar que la fecha sea anterior a hoy
        if ($_POST['fecha'] > $hoy) {
            echo "<p>La fecha ingresada  es anterior a hoy.</p>";
        } 





    $array = array_values($_POST);
$stmt = modificar_cuenta($mysqli,$array);
if($stmt->affected_rows > 0){
    echo "Se modificó la cuenta ";
}
else {
    echo "No se modificó la cuenta";

}

if(isset($_FILES['archivo'])){
    if(isset($_POST['enviar'])){
        $nombre_archivo = $_FILES['archivo']['name'];
        $tipo_archivo = $_FILES['archivo']['type'];
        $tamano_archivo = $_FILES['archivo']['size'];
        $temp_archivo = $_FILES['archivo']['tmp_name'];
        $directorio = "imagenes/";
        $ruta = $directorio.$nombre_archivo;
        $extension = pathinfo($nombre_archivo,PATHINFO_EXTENSION);
        if(!in_array(strtolower($extension),$tipoHabilitado)){
            echo("Formato de archivo no permitido");

            
        }
        else{

        if(move_uploaded_file($temp_archivo,$ruta)){
            echo "El archivo $nombre_archivo se ha subido correctamente";

            $sql = "UPDATE medico SET fotoperfil = ? WHERE mail = ?"; 
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss",$ruta,$_SESSION['mail']);
            if($stmt->execute()){
                echo "Se ha insertado la imagen";
            }
            else{
                echo "No se ha insertado la imagen";
            }
        }



        else{
            echo "Error al subir el archivo";
        }
    }
}

else{
    echo "Archivo no recibido";
}
}
else{
    echo "No se ha recibido ningún archivo";

}


}




?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro de Información</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        
        <label for="hospital">Hospital:</label>
        <input type="text" id="hospital" name="hospital"><br><br>
        
        <label for="POST">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label for="mail">Correo Electrónico:</label>
        <input type="mail" id="mail" name="mail" required><br><br>

        Añadir imagen: <input name="archivo" id="archivo" type="file"/><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required><br><br>
<br>
      
        
        <input type="submit" name= "enviar" value="Enviar">
        
    </form>
    <a href="index.php">Volver</a>
</body>
</html>

