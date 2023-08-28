<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro de Información</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>
        
        
        <label for="hospital">Hospital:</label>
        <input type="text" id="hospital" name="hospital"><br><br>
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label for="mail">Correo Electrónico:</label>
        <input type="mail" id="mail" name="mail" required><br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
<?php 
include("functions.php");
require_once("dbconfig.php");

if(post_request()){
    $conf = array_values($);

   foreach($_POST as $clave => $valor){
       echo $clave . "  ";
       echo $valor. "";
   }
    modificar_cuenta($mysqli,$conf);
}



?>
