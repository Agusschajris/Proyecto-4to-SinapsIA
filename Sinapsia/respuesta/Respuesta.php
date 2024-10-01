<?php
require_once "../configuracion/dbconfig.php";
require_once "../configuracion/functions.php";
session_start();
if (!isset($_SESSION["paciente_seleccionado"])) {
    header("Location: ../home/index.php");
}

if (isset($_GET["resultado"])) {
    $fecha = date("Y-m-d");
    /*
    $insert =
        "INSERT INTO electroencefalograma (resultado, fecha, id_paciente) VALUES (?,?,?)";
    $stmt = $mysqli->prepare($insert);
    $stmt->bind_param(
        "ssi",
        $_GET["resultado"],
        $fecha,
        $_SESSION["paciente_seleccionado"]
    );
    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
    */
    $result = pg_insert($mysqli, "electroencefalograma", [
        "resultado" => $_GET["resultado"],
        "fecha" => $fecha,
        "id_paciente" => $_SESSION["paciente_seleccionado"],
    ]);
}

/*
$sql = "SELECT * from problemasprevios WHERE id_paciente = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $_SESSION["paciente_seleccionado"]);
if ($stmt->execute()) {
    $result = $stmt->get_result();
*/
($result = pg_select($mysqli, "problemasprevios", [
    "id_paciente" => $_SESSION["paciente_seleccionado"],
])) or die("Error: " . mysqli_error($mysqli));
$row = $pg_fetch_assoc($result); //$result->fetch_assoc();
// Acceder directamente a las variables
$sintomas = $row["descripcionsintomas"];
$manifiesto = $row["manifiesto"];
$madurativo = $row["descripcionmadur"];
$siante = chequear($row["antecedentemadur"]);
$siprevia = chequear($row["enfermedadprevia"]);
$previa = chequear($row["descripcionprevia"]);
$patologia = $row["descripcionpatologia"];
$sipato = chequear($row["patologia"]);
$medicacion = chequear($row["descripcionmedicaciones"]);
$simedi = chequear($row["medicaciones"]);
$fami = chequear($row["descripcionfami"]);
$sifami = chequear($row["antecedentesfami"]);
$conciencia = chequear($row["conciencia"]);
$parto = chequear($row["parto"]);

/*
$query = "SELECT * FROM electroencefalograma where id_paciente = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $_SESSION["paciente_seleccionado"]);
if ($stmt->execute()) {
    $resultados = $stmt->get_result();
*/

($result = pg_select($mysqli, "electroencefalograma", [
    "id_paciente" => $_SESSION["paciente_seleccionado"],
])) or die("Error: " . mysqli_error($mysqli));

while ($row = pg_fetch_assoc($result)) {
    //$resultados->fetch_assoc()) {
    // Acceder directamente a las variables
    $id = $row["id"];
    $fecha = $row["fecha"];
    $resultado = $row["resultado"];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="respuesta.css">
</head>
<body>
    <div class="contenedor">

        <a href="#"><img src="../logos/back.png" alt="Inicio" class="back" onclick="window.location.href = '../home/index.php'">
        </a>

        <div class="titulo"><h1> RESPUESTA DE SINAPSIA </h1></div>

        <div class="centr"><div class="probabilidad"><p class="p1"> PROBABILIDADES DE PRESENCIA EPILEPSIA IDENTIFICADAS: </p><p class="p2"><?php echo $resultado .
            "%"; ?>  </p></div></div>

        <div class="respuestasFormuario"> <p class="p1">
            A la hora de realizar el diagnóstico al paciente, también tenga en cuenta:
        </p>

           <div class="contenedorPreg">

            <p class="preg">LOS SÍNTOMAS DEL PACIENTE</p>

            <div class="box respuesta1"> <p class="res"><?php echo $sintomas; ?></p> </div>

            <p class="preg">EN QUÉ MOMENTOS SE MANIFIESTAN ESTOS SÍNTOMAS Y CUANDO CEDEN</p>

            <div class="box respuesta2"><p class="res"><?php echo $manifiesto; ?> </p> </div>

            <p class="preg"><?php echo $siante; ?> PADECE ALGÚN ANTECEDENTE MADURATIVO</p>

            <div class="box respuesta3"> <p class="res"><?php echo $madurativo; ?> </p> </div>

            <p class="preg"><?php echo $siprevia; ?>  HA PADECIDO ALGUNA ENFERMEDAD PREVIAMENTE</p>

            <div class="box respuesta4"> <p class="res"><?php echo $previa; ?> </p> </div>

            <p class="preg"><?php echo $sipato; ?>  PADECE ALGUNA PATOLOGÍA O EXISTE LA POSIBILIDAD QUE LA PADEZCA</p>

            <div class="box respuesta5"> <p class="res"><?php echo $patologia; ?> </p> </div>

            <p class="preg"><?php echo $simedi; ?>  ESTÁ TOMANDO ALGUNA MEDICACIÓN ACTUALMENTE</p>

            <div class="box respuesta6"> <p class="res"><?php echo $medicacion; ?> </p> </div>

            <p class="preg"><?php echo $sifami; ?>  EXISTEN ANTECEDENTES DE EPILEPSIA EN SU FAMILIA</p>

            <div class="box respuesta7"> <p class="res"><?php echo $fami; ?> </p> </div>

            <p class="preg">SU ESTADO DE CONCIENCIA A LA HORA DE REALIZAR EL ESTUDIO</p>

            <div class="box respuesta8"> <p class="res"><?php echo $conciencia; ?> </p> </div>

            <p class="preg">DETALLES ACERCA DEL PARTO DEL PACIENTE</p>

            <div class="box respuesta9"> <p class="res"><?php echo $parto; ?> </p> </div>

            </div>


         </div>
    </div>
</body>

</html>
