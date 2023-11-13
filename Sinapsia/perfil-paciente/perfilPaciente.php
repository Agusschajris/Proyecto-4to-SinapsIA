<?php
require_once("../configuracion/dbconfig.php");
require_once("../configuracion/functions.php");
session_start();

if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}

    $sql = "SELECT nombre,apellido,mail,dni FROM paciente WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i",$_SESSION['paciente_seleccionado']);
   
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['dni'];
        $mail = $row['mail'];
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
$errores = [];
    if(post_request()){
        if(empty($_POST['sintomas']) || empty($_POST['momentomanifiesto']) || empty($_POST['antecedente']) || empty($_POST['detalleenfermedad']) || empty($_POST['detallepatologia']) || empty($_POST['medicaciones']) || empty($_POST['familiares']) || empty($_POST['estadoconciencia']) || empty($_POST['parto'])){
            $errores[] = "Debe completar todos los campos";
        }
        if(!preg_match("/^[a-zA-Z ]*$/",$_POST['sintomas'])){
            $errores[] = "El campo 'Síntomas' no es válido.";
        }
       if


    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="perfilPaciente.css">
</head>
<body>
    <div class="contenedor">

        <a href="#"><img src="../logos/back.png" alt="Inicio" class="back" onclick="window.location.href = 'file:///C:/Users/47575525/Documents/GitHub/Proyecto-4to-SinapsIA/Front/home.html'">
        </a> 
        
        <div class="divIzquierda">

        <div class="perfil">

            <div class="applyColumn">

            <div class="pacienteyfoto">

           <div class="pac"> PACIENTE </div>
            <img src="../logos/foto2.png" class="foto">

           </div> 

        <div class="nombreApellido">

            <p class="f1">NOMBRE</p>
            <p class="f2"><?php echo $nombre; ?></p>
            <p class="f3">APELLIDO</p>
            <p class="f4"><?php echo $apellido; ?></p>

        </div>

         </div class=dniCorreo>

         <p class="f5">DNI</p>
         <p class="f6"><?php echo $dni; ?></p>
         <p class="f7">CORREO</p>
         <p class="f8"><?php echo $mail; ?></p>

        </div>

        <button class="botonArchivos"> 

            <div class="texto">
                INGRESA TUS 
                ARCHIVOS 
                EEG AQUI
            </div>
            
            <img src="../logos/doc.png" class="doc">
            </a> 
        
        </button>
        </div>
        <div class="divDerecha">
             

            <form class="datosDelPaciente" method="POST"><p class="datosTitle">DATOS DEL PACIENTE</p> Haga una descripción de los síntomas que presenta el paciente
                <input type="text" name="sintomas" id="sintomas">

                ¿En qué momentos se manifiestan estos síntomas y cómo ceden? (si es que lo hacen)
                <input type="text" name="momentomanifiesto" id="momentomanifesto">
                
                ¿El paciente padece algún antecedente madurativo?
                <input type="radio" name="opcionesmadur" id="opcion1" value="opcion1" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesmadur" id="opcion2" value="opcion2" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De haber sido así, proporcione cualquier detalle necesario acerca de este antecedente
                <input type="text" name="antecedente" id="antecedente">

                ¿El paciente ha padecido alguna enfermedad previamente?
                <input type="radio" name="opcionesprevia" id="opcion1" value="opcion1" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesprevia" id="opcion2" value="opcion2" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione cualquier detalle necesario acerca de esta enfermedad
                <input type="text" name="detalleenfermedad" id="detalleenfermedad">

                ¿El paciente padece alguna patología o existe la posibilidad que la padezca?
                <input type="radio" name="opcionespato" id="opcion1" value="opcion1" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionespato" id="opcion2" value="opcion2" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione cualquier detalle necesario acerca de la misma
                <input type="text" id="detallepatologia" name="detallepatologia">

                ¿El paciente está tomando medicaciones actualmente?
                <input type="radio" name="opcionesmedic" id="opcion1" value="opcion1" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesmedic" id="opcion2" value="opcion2" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione los nombres de las mismas
                <input type="text" name="medicaciones" id="medicaciones">

                ¿Existen antecedentes familiares con respecto a la epilepsia?
                <input type="radio" name="opcionesfami" id="opcion1" value="opcion1" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesfami" id="opcion2" value="opcion2" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione detalles acerca de este
                <input type="text" name="familiares" id="familiares">

                ¿Cuál era el estado de conciencia del paciente a la hora de realizar el estudio?
                <input type="text" name="estadoconciencia" id="estadoconciencia">

                Proporcione detalles acerca del parto del paciente (El tipo de parto, complicaciones que podrían haber sucedido y si hubo intervención médica)
                <input type="text" name="parto" id="parto">

                <div class="guardar-button-container">
                <input type="submit"  value="GUARDAR" class="guardar-button">
                </div>
            </form>

        </div>
       
    </div>
</body>

</html>