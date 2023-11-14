<?php
require_once("../configuracion/dbconfig.php");
require_once("../configuracion/functions.php");
session_start();

if($_SESSION['loggedin'] == true){
    header("Location: ../login/Iniciosesion.php")
}

$sql = "SELECT * from problemasprevios WHERE id-paciente = ?"
$stmt = $mysqli->prepare($query);
 $stmt->bind_param("i",$_SESSION['paciente_seleccionado']);
 if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $parto = $row['parto'];
    $sintomas = $row['descripcionsintomas'];
    $manifiesto = $row['manifiesto'];
    $madurativo = $row['antecedentemadur'];
    $madur = $row['descripcionmadur'];
    $previa = $row['enfermedadprevia'];
    $pre = $row['descripcionprevia'];
    $patologia = $row['patologia'];
    $pato = $row['descripcionpatologia'];
    $medi = $row['descripcionmedicaciones'];
    $medicacion = $row['medicaciones'];
    $familia = $row['descripcionfami'];
    $fami = $row['antecedentefami'];
    $conciencia = $row['conciencia'];
    

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

        <a href="#"><img src="back.png" alt="Inicio" class="back" onclick="window.location.href = 'file:///C:/Users/47575525/Documents/GitHub/Proyecto-4to-SinapsIA/Front/home.html'">
        </a> 
        
        <div class="titulo"><h1> RESPUESTA DE SINAPSIA </h1></div>
        
        <div class="centr"><div class="probabilidad"><p class="p1"> PROBABILIDADES DE PRESENCIA EPILEPSIA IDENTIFICADAS: </p><p class="p2"> 90,5%</p></div></div>
       
        <div class="respuestasFormuario"> <p class="p1">
            A la hora de realizar el diagnóstico al paciente, también tenga en cuenta:
        </p>

           <div class="contenedorPreg">

            <p class="preg">LOS SÍNTOMAS DEL PACIENTE</p>

            <div class="box respuesta1"> <p class="res">hola</p> </div>

            <p class="preg">EN QUÉ MOMENTOS SE MANIFIESTAN ESTOS SÍNTOMAS Y CUANDO CEDEN</p>

            <div class="box respuesta2"><p class="res"><?php echo  $manifiesto ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGÚN ANTECEDENTE MADURATIVO</p>

            <div class="box respuesta3"> <p class="res"><?php echo  $madurativo ?> </p> </div>

            <p class="preg">SI/NO HA PADECIDO ALGUNA ENFERMEDAD PREVIAMENTE</p>

            <div class="box respuesta4"> <p class="res"><?php echo  $previa ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGUNA PATOLOGÍA O EXISTE LA POSIBILIDAD QUE LA PADEZCA</p>

            <div class="box respuesta5"> <p class="res"><?php echo  $patologia ?> </p> </div>

            <p class="preg">SI/NO ESTÁ TOMANDO ALGUNA MEDICACIÓN ACTUALMENTE</p>

            <div class="box respuesta6"> <p class="res"><?php echo  $medicacion ?> </p> </div>

            <p class="preg">SI/NO EXISTEN ANTECEDENTES DE EPILEPSIA EN SU FAMILIA</p>

            <div class="box respuesta7"> <p class="res"><?php echo  $fami ?> </p> </div>

            <p class="preg">SU ESTADO DE CONCIENCIA A LA HORA DE REALIZAR EL ESTUDIO</p>

            <div class="box respuesta8"> <p class="res"><?php echo  $conciencia ?> </p> </div>

            <p class="preg">DETALLES ACERCA DEL PARTO DEL PACIENTE</p>

            <div class="box respuesta9"> <p class="res"><?php echo  $manifiesto ?> </p> </div>
        
            </div>


         </div>
    </div>
</body>

</html>