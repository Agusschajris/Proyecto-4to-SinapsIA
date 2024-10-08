<?php

include_once "../configuracion/functions.php";
require_once "../configuracion/dbconfig.php";
session_start();
if ($_SESSION["loggedin"] == false || !isset($_SESSION["loggedin"])) {
    header(
        "Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php"
    );
}

$mail = $_SESSION["mail"];
$errores = [];

if (post_request()) {
  


if (
    empty($_POST["nombre"]) ||
    empty($_POST["apellido"]) ||
    empty($_POST["mail"]) ||
    empty($_POST["dni"])
) {
    $errores[] = "Debe completar todos los campos";
}

if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El mail ingresado no es válido.";
}

if (!is_numeric($_POST["telefono"])) {
    $errores[] = "El teléfono ingresado no es válido.";
}

if (!is_numeric($_POST["edad"]) || $_POST["edad"] < 0 || $_POST["edad"] > 120) {
    $errores[] = "La edad ingresada no es válida.";
}

if (
    !is_numeric($_POST["dni"]) ||
    $_POST["dni"] < 0 ||
    $_POST["dni"] > 99999999
) {
    $errores[] = "El DNI ingresado no es válido.";
}

if (
    !is_numeric($_POST["numeroHistClinica"]) ||
    $_POST["numeroHistClinica"] < 0 ||
    $_POST["numeroHistClinica"] > 99999999
) {
    $errores[] = "El número de historia clínica ingresado no es válido.";
}

if (
    !empty($_POST["obrasocial"]) &&
    !preg_match("/^[a-zA-Z ]*$/", $_POST["obrasocial"])
) {
    $errores[] = "La obra social ingresada no es válida.";
}

if (
    !empty($_POST["nombre"]) &&
    !preg_match("/^[a-zA-Z ]*$/", $_POST["nombre"])
) {
    $errores[] = "El nombre ingresado no es válido.";
}

if (
    !empty($_POST["apellido"]) &&
    !preg_match("/^[a-zA-Z ]*$/", $_POST["apellido"])
) {
    $errores[] = "El apellido ingresado no es válido.";
}

if (!empty($errores)) {
    foreach ($errores as $error) {
        echo $error . "<br>";
    }
    return;
}

/*
$query = "SELECT * FROM paciente WHERE mail_medico = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $mail);
$stmt->execute();

$result = $stmt->get_result();
$paciente = $result->fetch_assoc();
*/

$result = pg_query_params($pgsql, "SELECT nombre,apellido,hospital,dni FROM medico WHERE mail = $1", [$mail]) or
    die("Error en la consulta" . pg_last_error($pgsql));

if (pg_num_rows($result) > 0){  //if ($stmt->num_rows > 0) {
    echo "Ya existe el usuario";
}

/*
$sql =
    "INSERT INTO paciente (nombre, apellido, mail, telefono, edad, dni, obrasocial, numeroHistClinica, mail_medico) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param(
    "sssiiisis",
    $_POST["nombre"],
    $_POST["apellido"],
    $_POST["mail"],
    $_POST["telefono"],
    $_POST["edad"],
    $_POST["dni"],
    $_POST["obrasocial"],
    $_POST["numeroHistClinica"],
    $mail
);
*/

$result = pg_insert(
    $pgsql,
    "paciente",
    [
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "mail" => $_POST["mail"],
        "telefono" => $_POST["telefono"],
        "edad" => $_POST["edad"],
        "dni" => $_POST["dni"],
        "obrasocial" => $_POST["obrasocial"],
        "numerohistclinica" => $_POST["numeroHistClinica"],
        "mail_medico" => $mail,
    ]
);

if ($result) {
    echo "Paciente creado!";
    header("Location:../home/index.php");
} else {
    echo "Error: " . $result . "<br>" .    pg_last_error($pgsql);
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
    <link rel="stylesheet" href="nuevoPaciente.css">
    <title>Document</title>

</head>
<body>
    <div class="contenedor">
        <a href="#"><img src="../logos/back.png" alt="Inicio" class="back" onclick="window.location.href = '../home/index.php'">
        </a>

        <div class="nuevoPaciente">

            <h1 class="agregarPaciente">
                AGREGAR PACIENTE
            </h1>

            <div class="anamnesisWrapper">
                <form class="anamnesis" method="POST">

                  <div class="applyColumn">
                    <p>
                    <label>NOMBRE</label>
                     <input type="text" name="nombre" id="nombre">
                    </p>

                    <p>
                    <label>APELIDO</label>
                    <input type="text" name="apellido" id="apellido">
                    </p>

                    <p>
                    <label>MAIL</label>
                    <input type="email" name="mail" id="mail">
                    </p>


                    <p>
                    <label>TELÉFONO</label>
                    <input type="text" name="telefono"id="telefono">
                    </p>


                    <P>
                    <label>EDAD</label>
                    <input type="text" name="edad" id="edad">
                    </P>


                    <P>
                    <label>DNI</label>
                    <input type="text" name="dni" id="dni">
                    </P>


                    <P>
                    <label>OBRA SOCIAL</label>
                     <input type="text" name="obrasocial" id="obrasocial">
                    </P>

                    <P>
                    <label>NÚMERO DE HISTORIA CLÍNICA</label>
                     <input type="text" name="numeroHistClinica" id="numeroHistClinica">
                    </P>

                </div>

                <p class="block guardar-button">
                    <input type="submit" value="GUARDAR" class="guardar">
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
