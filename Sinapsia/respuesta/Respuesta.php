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
        if(isset($row['sintomas'])){
            $sintomas = $row["sintomas"];
        }
        else{
            $sintomas = "No hay datos";
        }	

        if(isset($row['manifiesto'])){
            $sintomas = $row['manifiesto'];
        }
        else{
            $sintomas = "No hay datos";
        }	

        if(isset($row['madurativo'])){
            $sintomas = $row['madurativo'];
        }
        else{
            $sintomas = "No hay datos";
        }	

        if(isset($row["previa"])){
                $previa = $row['previa'];
        }
        else{
            $previa ="No hay datos";
        }

        if(isset($row["patologia"])){
            $patologia = $row["patoloGIA"]
        }
        else{
            $patologia = "No hay datos":
        }
        
        if(isset($row["medicaciones"])){
            $medicacion = $row["medicaciones"];
        }
        else{
            $medicacion = "No hay datos";
        }

        if(isset($row["fami"])){
            $fami = $row["fami"];
        }
        else{
            $fami = "No hay datos";
        }
        if(isset($row["conciencia"])){
            $conciencia = $row["conciencia"];
        }
        else{
            $conciencia = "No hay datos";
        }
        if(isset($row["parto"])){
            $parto = $row["parto"];
        }
        else{
            $parto = "No hay datos";
        }
       

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

            <div class="box respuesta1"> <p class="res"><?php  echo $sintomas; ?></p> </div>

            <p class="preg">EN QUÉ MOMENTOS SE MANIFIESTAN ESTOS SÍNTOMAS Y CUANDO CEDEN</p>

            <div class="box respuesta2"><p class="res"><?php echo  $manifiesto; ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGÚN ANTECEDENTE MADURATIVO</p>

            <div class="box respuesta3"> <p class="res"><?php echo $madurativo; ?> </p> </div>

            <p class="preg">SI/NO HA PADECIDO ALGUNA ENFERMEDAD PREVIAMENTE</p>

            <div class="box respuesta4"> <p class="res"><?php echo  $previa; ?> </p> </div>

            <p class="preg">SI/NO PADECE ALGUNA PATOLOGÍA O EXISTE LA POSIBILIDAD QUE LA PADEZCA</p>

            <div class="box respuesta5"> <p class="res"><?php echo $patologia; ?> </p> </div>

            <p class="preg">SI/NO ESTÁ TOMANDO ALGUNA MEDICACIÓN ACTUALMENTE</p>

            <div class="box respuesta6"> <p class="res"><?php echo  $medicacion; ?> </p> </div>

            <p class="preg">SI/NO EXISTEN ANTECEDENTES DE EPILEPSIA EN SU FAMILIA</p>

            <div class="box respuesta7"> <p class="res"><?php echo  $fami; ?> </p> </div>

            <p class="preg">SU ESTADO DE CONCIENCIA A LA HORA DE REALIZAR EL ESTUDIO</p>

            <div class="box respuesta8"> <p class="res"><?php echo  $conciencia; ?> </p> </div>

            <p class="preg">DETALLES ACERCA DEL PARTO DEL PACIENTE</p>

            <div class="box respuesta9"> <p class="res"><?php echo  $parto; ?> </p> </div>
        
            </div>


         </div>
    </div>
</body>

</html>