<?php
include("functions.php");
require_once("dbconfig.php");
session_start();
$tipoHabilitado = array("jpg","jpeg","gif","png");

if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false){
  header("Location: index.php");
  exit();
}

$rutaCompleta ="";
if(post_request()){
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

            $sql = "INSERT INTO electroencefalograma (imagen,mail_paciente) VALUES (?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss",$nombre_archivo,$_SESSION['mail']);
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

if(isset($_POST['enviar'])){
    $sql = "SELECT imagen FROM electroencefalograma WHERE mail_paciente = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s",$_SESSION['mail']);
if($stmt->execute()){
    $stmt->bind_result($imagen);
    $stmt->fetch();
    $rutaCompleta = "imagenes/".$imagen;
    echo "Ruta completa: ".$rutaCompleta."<br>";
}
else{
    echo "No se pudo ejecutar la consulta";
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
        <input type="text" id="nxombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        
        <label for="hospital">Hospital:</label>
        <input type="text" id="hospital" name="hospital"><br><br>
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label for="mail">Correo Electrónico:</label>
        <input type="mail" id="mail" name="mail" required><br><br>

        Añadir imagen: <input name="archivo" id="archivo" type="file"/><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required><br><br>
<br>
      
        
        <input type="submit" name= "enviar" value="Enviar">
        <img src=<?php echo $rutaCompleta?> alt="imagen">
    </form>
</body>
</html>
<?php 
include("functions.php");
require_once("dbconfig.php");

if(post_request()){
    //pasar array asociativo a array normal
    $array = array_values($_POST);
$stmt = modificar_cuenta($mysqli,$array);
if($stmt->affected_rows > 0){
    echo "Se modificó la cuenta";
}
else {
    echo "No se modificó la cuenta";

}

}



?>
