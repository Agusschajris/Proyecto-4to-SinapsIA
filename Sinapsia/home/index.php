<?php
include("../configuracion/functions.php");
require_once("../configuracion/dbconfig.php");
session_start();
if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}
else{
    echo "bienvenido ".$_SESSION['nombre'];
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
        while($row = $result->fetch_assoc()){
            $id_paciente = $row['id']; // Obtener el ID del paciente
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id_paciente' value='$id_paciente'>";
            echo "<input type='submit' name='select_paciente' value='" . $row['nombre'] . " " . $row['apellido'] . "'>";
            echo "</form>";
        }
        
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
    if (isset($_POST['select_paciente'])) {
        // Si se ha enviado el formulario (se ha seleccionado un paciente), actualiza la variable de sesión.
        $_SESSION['paciente_seleccionado'] = $id_paciente;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cierre de Sesión</title>
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <a href="../paciente/paciente.php">Ir a la Página de Pacientes</a>

    <!-- Botón para cerrar la sesión -->
    <form action="cerrar_sesion.php" method="post">
        <input type="submit" value="Cerrar Sesión" />
    </form>
</body>
</html>
