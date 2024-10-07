<?php
include_once "../configuracion/dbconfig.php";
include_once "../configuracion/functions.php";
session_start();
if (isset($_SESSION["loggedin"])) {
    header("Location: ../home/index.php");
}
if(!isset($_SESSION["nombre"], $_SESSION["apellido"], $_SESSION["institucion"], $_SESSION["dni"])){
    header("Location: ../signup/register.php");
}
else{ 
$nombre = $_SESSION["nombre"];
$apellido = $_SESSION["apellido"];
$institucion = $_SESSION["institucion"];
$dni = $_SESSION["dni"];
$errores = [];
}

if(post_request()){

if (!isset($_POST["mail"], $_POST["contrasenia"], $_POST["contrasenia2"])) {
    $errores[] = "Completa el formulario";
}
if (
    empty($_POST["mail"]) ||
    empty($_POST["contrasenia"]) ||
    empty($_POST["contrasenia2"])
) {
    $errores[] = "Debe completar todos los campos";
}
if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El mail ingresado no es válido.";
}
if ($_POST["contrasenia"] != $_POST["contrasenia2"]) {
    $errores[] = "Las contraseñas no coinciden.";
}
if (!empty($_POST["contrasenia"]) && strlen($_POST["contrasenia"]) < 8) {
    $errores[] = "La contraseña debe tener al menos 8 caracteres.";
}
if (
    !empty($_POST["contrasenia"]) &&
    !preg_match("#[0-9]+#", $_POST["contrasenia"])
) {
    $errores[] = "La contraseña debe tener al menos un número.";
}
if (
    !empty($_POST["contrasenia"]) &&
    !preg_match("#[A-Z]+#", $_POST["contrasenia"])
) {
    $errores[] = "La contraseña debe tener al menos una mayúscula.";
}

if (!empty($errores)) {
    foreach ($errores as $error) {
        echo $error . "<br>";
    }
    
}
 }

$contcrypt = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
$mail = $_POST["mail"];

/*
if (
    $stmt = $mysqli->prepare(
        "SELECT mail,contrasenia,nombre FROM medico WHERE mail = ?"
    )
) {
    $stmt->bind_param("s", $_POST["mail"]);
    $stmt->execute();
    $stmt->store_result();
*/

$result = pg_query_params(
    $pgsql,
    "SELECT mail,contrasenia,nombre FROM medico WHERE mail = $1",
    [$_POST["mail"]]
) or die("Error en la consulta SQL: " . pg_last_error());

if (pg_num_rows($result) > 0){ //($stmt->num_rows > 0) {
    echo "Ya existe el usuario";
    return;
}

/*
$sql =
    "INSERT INTO medico (nombre,apellido,contrasenia,hospital,dni,mail) VALUES (?, ?, ?, ?, ?, ?)";
$crearusuario = $mysqli->prepare($sql);
$crearusuario->bind_param(
    "ssssis",
    $nombre,
    $apellido,
    $contcrypt,
    $institucion,
    $dni,
    $mail
);
*/

$result = pg_insert($pgsql, "medico", [
    "nombre" => $nombre,
    "apellido" => $apellido,
    "contrasenia" => $contcrypt,
    "hospital" => $institucion,
    "dni" => $dni,
    "mail" => $mail,
]);

if ($result) { //($crearusuario->execute()) {
    echo "Usuario creado!";
    header("Location: ../home/index.php");
    $_SESSION["loggedin"] = true;
    $_SESSION["mail"] = $mail;
} else {
    echo "Error: " . $pgsql . "<br>" . pg_last_error();//$mysqli->error;
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

               <button class="guardar" type="submit">
                GUARDAR
            </button>

            </form>

            <br><br>
                <!-- errores acá -->

            <br><br>

</div>
                <div>

</body>
</html>
