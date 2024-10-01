<?php

require_once "../configuracion/dbconfig.php";
require_once "../configuracion/functions.php";
session_start();
$tipoHabilitado = ["jpg", "jpeg", "png", "gif"];

if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == false) {
    header("Location: index.php");
    exit();
}

if (!post_request()) {
    return;
}

if (!isset($_FILES["archivo"])) {
    echo "No se selecciono ningun archivo";
    return;
}

$nombre_archivo = $_FILES["archivo"]["name"];
$tipo_archivo = $_FILES["archivo"]["type"];
$tamano_archivo = $_FILES["archivo"]["size"];
$temp_archivo = $_FILES["archivo"]["tmp_name"];
$directorio = "../imagenes/";
$ruta = $directorio . $nombre_archivo;
$extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

if (!in_array(strtolower($extension), $tipoHabilitado)) {
    echo "Formato de archivo no permitido";
    return;
}

if (!move_uploaded_file($temp_archivo, $ruta)) {
    echo "Error al subir el archivo";
    return;
}

echo "El archivo se subio correctamente";
/*
$sql = "INSERT INTO electroencefalograma(imagen, mail_paciente) VALUES (?,?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $ruta, $_SESSION["mail"]);
if ($stmt->execute()) {
    echo "Se inserto correctamente";
} else {
    echo "Error al insertar: " . $stmt->error;
}
$stmt->close();
*/

$result = pg_insert($pgsql, "electroencefalograma", [
    "imagen" => $ruta,
    "mail_paciente" => $_SESSION["mail"],
]);
echo $result ? "Se inserto correctamente" : "Error al insertar";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="file" name="archivo" id="archivo" accept="image/*">
        <input type="submit" value="enviar" name="submit">
    </form>
</body>
</html>
