<?php
include("../configuracion/functions.php");
require_once("../configuracion/dbconfig.php");
session_start();
if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}

$mail = $_SESSION['mail'];





/*if(isset($_POST['nombre'],$_POST['apellido'],$_POST['institucion'],$_POST['telefono'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $institucion = $_POST['institucion'];
    $telefono = $_POST['telefono'];
    $query = "UPDATE medico SET nombre = ?, apellido = ?, hospital = ?, telefono = ? WHERE mail = ?";
    $stmt = mysqli_prepare($mysqli,$query);
    $stmt->bind_param("sssss",$nombre,$apellido,$institucion,$telefono,$_SESSION['mail']);
    if($stmt->execute()){
        echo "Datos actualizados";
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
}
else{
    echo "Completa el formulario";
}
*/



$sql = "SELECT id, nombre, apellido FROM paciente WHERE mail_medico = ?";
    $stmt = mysqli_prepare($mysqli,$sql);
    $stmt->bind_param("s",$mail);
    if($stmt->execute()){
        $result = $stmt->get_result();
        /*while($row = $result->fetch_assoc()){
            $id_paciente = $row['id']; // Obtener el ID del paciente
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id_paciente' value='$id_paciente'>";
            echo "<input type='submit' name='select_paciente' value='" . $row['nombre'] . " " . $row['apellido'] . "'>";
            echo "</form>";
        } */
        
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
    if (isset($_POST['select_paciente'])) {
        // Si se ha enviado el formulario (se ha seleccionado un paciente), actualiza la variable de sesión.
        $_SESSION['paciente_seleccionado'] = $id_paciente;
    }


    $doctor = "Dr. " . $_SESSION['nombre'] . " " . $_SESSION['apellido'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="home.css">
    <script src="home.js" type="text/javascript"> </script>
    <title>Document</title>  

</head>
<body>
  
    <div class="contenedor">

      <header>

      <div class="menu">

        <div>
          <a href="#"><img src="../logos/logoS.png" alt="Inicio" class="logo"></a>
        </div>

        <div class="menu-items">
          <a href="#"><img src="../logos/perfil.png" alt="PERFIL" class="perfil"></a>
          <a href="#"><img src="../logos/mail.png" alt="CORREO" class="mail"></a>
          <a href="#"><img src="../logos/configuracion.png" alt="CONFIGURACION" class="configuracion"></a>

        </div>

      </div> 

      </header>

      <div class="bienvenidoDr">

      <p class="Bienvenido"> Bienvenido </p> 

      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Prompt:ital,wght@0,400;0,500;1,200&display=swap" 
      rel="stylesheet">

      <h1 class="nombredoc"> <?php echo $doctor ?> </h1>
      
      </div>

      <h1 class="PACIENTES"> PACIENTES </h1>
      <div class="divPacientes">

      <div class="wrapper">

      <div class="carrusel">
        <?php        
            echo "<ul>";
            echo "<li><div class='agregarpaciente'><a href='../paciente/paciente.php'><img src='../logos/agregarPaciente.png' alt='agregarpaciente' class='agregarpaciente'></a></div></li>";


            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo '<li><div class="paciente"><a href="#"><img src="foto.png" alt="paciente" class="pacientefoto"></a>';
                echo '<br>' ;
                echo $row['nombre'] . '<br>' . $row['apellido'];
                    echo '</div></li>';
                }
                
                echo '</ul>';
            } else {
                echo "No se encontraron pacientes en la base de datos.";
            }
        ?>

      </div>
      </div>

      </div>

    </div>
</body>

</html>

