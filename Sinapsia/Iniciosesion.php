<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method = "POST">
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
    <label for="email">email:</label>
    <input type="text" id="email" name="email" require >
  <a href="register.php">Registro</a>
    <!-- Botón para enviar el formulario -->
    <button type = "submit" > Verificar</button>
</form>
</body>
</html>

<?php 
include("functions.php");
$_ENV = parse_ini_file(".env");
$mysqli = Mysql($_ENV);
var_dump($_POST);

if($_SERVER['REQUEST_METHOD']=== "POST"){
$email = $_POST['email'];
$contraseña = $_POST['contrasenia'];
}



$query = "SELECT idmedico,nombre,contrasenia FROM medico WHERE email = ? AND contrasenia = ?";

if($stmt = $mysqli->prepare($query)){
    $stmt -> bind_param("ss",$email,$contraseña);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        echo "Iniciaste sesión";
}
else {
    echo "El usuario o la contraseña es incorrecta";
}
}
else{
    echo "error";
}


?>