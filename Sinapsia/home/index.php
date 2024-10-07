<?php
include "../configuracion/functions.php";
require_once "../configuracion/dbconfig.php";
session_start();
if ($_SESSION["loggedin"] == false || !isset($_SESSION["loggedin"])) {
    header(
        "Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php"
    );
}

$mail = $_SESSION["mail"];

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

$doctor = "Dr. " . $_SESSION["nombre"] . " " . $_SESSION["apellido"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="home.css">
    <title>Document</title>

</head>
<body>

    <div class="contenedor">

      <header>

      <div class="menu">

        <div>
        <a href="#" onclick="refreshPage();">
        <img src="../logos/logoS.png" alt="Inicio" class="logo">
    </a>

    <script>
        function refreshPage() {
            location.reload(); // Esto recarga la página
        }
    </script>
        </div>

        <div class="menu-items">
          <a href="#"><img src="../logos/perfil.png" alt="PERFIL" class="perfil"></a>

          <form action="cerrar_sesion.php" method="post" id="formCerrarSesion">

          <button type="submit" class="nomostrar" name="cerrarSesion">
            <div>
          <img src="../logos/logout.png" alt="LOGOUT" class="logout">
         </div>

          </button>
          </form>

        </div>

      </div>

      </header>

      <div class="bienvenidoDr">

      <p class="Bienvenido"> Bienvenido </p>

      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Prompt:ital,wght@0,400;0,500;1,200&display=swap"
      rel="stylesheet">

      <h1 class="nombredoc"> <?php echo $doctor; ?> </h1>

      </div>

      <h1 class="PACIENTES"> PACIENTES </h1>
      <div class="divPacientes">

      <div class="wrapper">

      <div class="carrusel">
        <?php
        echo "<ul>";
        echo "<li><div class='agregarpaciente'><a href='../paciente/paciente.php'><img src='../logos/agregarPaciente.png' alt='agregarpaciente' class='agregarpaciente'></a></div></li>";

        //$sql = "SELECT id, nombre, apellido FROM paciente WHERE mail_medico = ? ORDER BY id DESC";
        //$stmt = mysqli_prepare($mysqli,$sql);
        //$stmt->bind_param("s",$mail);
        //if($stmt->execute()){
        //    $result = $stmt->get_result();
        /*while($row = $result->fetch_assoc()){
                $id_paciente = $row['id']; // Obtener el ID del paciente
                echo "<form action='' method='post'>";
                echo "<input type='hidden' name='id_paciente' value='$id_paciente'>";
                echo "<input type='submit' name='select_paciente' value='" . $row['nombre'] . " " . $row['apellido'] . "'>";
                echo "</form>";
            } */

        $result = pg_query_params(
            $pgsql,
            "SELECT id, nombre, apellido FROM paciente WHERE mail_medico = $1 ORDER BY id DESC",
            [$mail]
        );

        if (!$result) {
            die("Error: " . pg_last_error());
        }

        if (pg_num_rows($result) > 0) {
            while ($row = pg_fetch_row($result)) {
                //$result->fetch_assoc()) {
                $id_paciente = $row["id"];
                echo "<li><div class='paciente'><a href='../perfil-paciente/perfilPaciente.php?id_paciente=$id_paciente'><img src='foto.png' alt='paciente' class='pacientefoto'></a>";

                echo "<br>";
                echo $row["nombre"] . "<br>" . $row["apellido"];

                echo "</div></li>";
            }

            echo "</ul>";
        }

        $medico = obtener_cuenta($pgsql, $mail);//[0];
        /*
            $medico = "SELECT * FROM medico WHERE mail = ?";
            $stmt = mysqli_prepare($mysqli,$medico);
            $stmt->bind_param("s",$mail);
            if($stmt->execute()){
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()){*/
        $nombre = $medico["nombre"];
        $apellido = $medico["apellido"];
        $institucion = $medico["hospital"];
        $dni = $medico["dni"];

/*
                }
            }
            */
?>

      </div>
      </div>

      </div>
<div class="perfilDoctor">

        <div class="infoDoc">

        <p class="miPerfil"> MI PERFIL </p>
        <div class="separador s1"> . </div>

        <img src="../logos/perfilAzul.png" alt="perfilAzul" class="perfilAzul">


        <p class="p1"> NOMBRE </p>
        <p class="p2"><?php echo $nombre; ?></p>
        <div class="separador s2"> . </div>

        <p class="p3"> APELLIDO </p>
        <p class="p4"> <?php echo $apellido; ?> </p>
        <div class="separador s3"> . </div>

        <p class="p5"> MAIL </p>
        <p class="p6"> <?php echo $mail; ?> </p>
        <div class="separador s4"> . </div>

        <p class="p7"> DNI </p>
        <p class="p8"><?php echo $dni; ?> </p>
        <div class="separador s5"> . </div>

        <p class="p9"> INSTITUCIÓN </p>
        <p class="p10"> <?php echo $institucion; ?> </p>
        <div class="separador"> . </div>


        <form action="cerrar_sesion.php" method="post" id="formCerrarSesion">
    <button type="submit" class="cerrarSesion" name="cerrarSesion"> CERRAR SESIÓN </button>
</form>

        <div>

         </div>
    </div>



    <script src="home.js"></script>
</body>

</html>
