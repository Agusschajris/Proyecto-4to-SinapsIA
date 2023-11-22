<?php
require_once("../configuracion/dbconfig.php");
require_once("../configuracion/functions.php");
session_start();
if(!isset($_SESSION['paciente_seleccionado'])){
    header("Location: ../home/index.php");
}

if(isset($_GET['resultado'])){
 
$fecha = date("Y-m-d");
$insert = "INSERT INTO electroencefalograma (resultado, fecha, id_paciente) VALUES (?,?,?)";
$stmt = $mysqli->prepare($insert);
$stmt->bind_param("ssi",$_GET['resultado'],$fecha,$_SESSION['paciente_seleccionado']);
if($stmt->execute()){
    echo "";
}
else{
    echo "Error: ".mysqli_error($mysqli);
}
}



$sql = "SELECT * from problemasprevios WHERE id_paciente = ?";
$stmt = $mysqli->prepare($sql);
 $stmt->bind_param("i",$_SESSION['paciente_seleccionado']);
 if($stmt->execute()){
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
        // Acceder directamente a las variables
        if($row['sintomas'] == 1){
            $sintomas = "SI";
        }
        else{
            $sintomas = "NO";
        }	
        $manifiesto = $row['manifiesto'];
        $madurativo = $row['madurativo'];
        $previa = $row['previa'];
        $patologia = $row['patologia'];
        $medicacion = $row['medicacion'];
        $fami = $row['fami'];
        $conciencia = $row['conciencia'];
        $parto = $row['parto'];

    }
   
    
    

 
 else{
        echo "Error: ".mysqli_error($mysqli);
    
 }

 $query ="SELECT * FROM electroencefalograma where id_paciente = ?";
 $stmt = $mysqli->prepare($query);
 $stmt->bind_param("i",$_SESSION["paciente_seleccionado"]);
 if($stmt->execute()){
    $resultados = $stmt->get_result();
    while ($row = $resultados->fetch_assoc()) {
        // Acceder directamente a las variables
        $id = $row['id'];
        $fecha = $row['fecha'];
        $resultado = $row['resultado'];

    }

 }
 else
{
    echo "hubo un error". mysqli_error($mysqli);
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
        
        <div class="centr"><div class="probabilidad"><p class="p1"> PROBABILIDADES DE PRESENCIA EPILEPSIA IDENTIFICADAS: </p><p class="p2"><?php echo $resultado ;?>  </p></div></div>
       
        <div class="respuestasFormuario"> <p class="p1">
            A la hora de realizar el diagnóstico al paciente, también tenga en cuenta:
        </p>

           <div class="contenedorPreg">

            <p class="preg">LOS SÍNTOMAS DEL PACIENTE</p>

            <div class="box respuesta1"> <p class="res"><?php echo show($sintomas)?></p> </div>

            <p class="preg">EN QUÉ MOMENTOS SE MANIFIESTAN ESTOS SÍNTOMAS Y CUANDO CEDEN</p>

            <div class="box respuesta2"><p class="res"><?php echo  show($manifiesto) ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGÚN ANTECEDENTE MADURATIVO</p>

            <div class="box respuesta3"> <p class="res"><?php echo  show($madurativo) ?> </p> </div>

            <p class="preg">SI/NO HA PADECIDO ALGUNA ENFERMEDAD PREVIAMENTE</p>

            <div class="box respuesta4"> <p class="res"><?php echo  show($previa) ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGUNA PATOLOGÍA O EXISTE LA POSIBILIDAD QUE LA PADEZCA</p>

            <div class="box respuesta5"> <p class="res"><?php echo show($patologia) ?> </p> </div>

            <p class="preg">SI/NO ESTÁ TOMANDO ALGUNA MEDICACIÓN ACTUALMENTE</p>

            <div class="box respuesta6"> <p class="res"><?php echo  show($medicacion) ?> </p> </div>

            <p class="preg">SI/NO EXISTEN ANTECEDENTES DE EPILEPSIA EN SU FAMILIA</p>

            <div class="box respuesta7"> <p class="res"><?php echo  show($fami) ?> </p> </div>

            <p class="preg">SU ESTADO DE CONCIENCIA A LA HORA DE REALIZAR EL ESTUDIO</p>

            <div class="box respuesta8"> <p class="res"><?php echo  show($conciencia) ?> </p> </div>

            <p class="preg">DETALLES ACERCA DEL PARTO DEL PACIENTE</p>

            <div class="box respuesta9"> <p class="res"><?php echo  show($parto) ?> </p> </div>
        
            </div>


         </div>
    </div>
</body>

</html>