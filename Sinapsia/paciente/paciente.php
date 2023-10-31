<?php
    include_once("../configuracion/functions.php");
    require_once("../configuracion/dbconfig.php");
    session_start();
    if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
        header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
    }
   
    $mail = $_SESSION['mail'];
    if (isset($_POST['id_paciente'])) {
        $_SESSION['paciente_seleccionado'] = $_POST['id_paciente'];
        $id = $_SESSION['paciente_seleccionado'];

    } 
    
    $sql = "SELECT nombre, apellido, genero, peso, altura, fecha_nacimiento FROM paciente WHERE mail_medico = ? AND id = ?";
    $stmt = mysqli_prepare($mysqli,$sql);
    $stmt->bind_param("si",$mail,$id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            echo "Nombre: ".$row['nombre']."<br>";
            echo "Apellido: ".$row['apellido']."<br>";
            echo "Género: ".$row['genero']."<br>";
            echo "Peso: ".$row['peso']."<br>";
            echo "Altura: ".$row['altura']."<br>";
            echo "Fecha de Nacimiento: ".$row['fecha_nacimiento']."<br>";
        }
        
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</form>

<form action="" method="POST">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required><br><br>

    <label>Género:</label>
    <input type="radio" id="genero-masculino" name="genero" value="Masculino">
    <label for="genero-masculino">Masculino</label>
    <input type="radio" id="genero-femenino" name="genero" value="Femenino">
    <label for="genero-femenino">Femenino</label>
    <input type="radio" id="genero-otro" name="genero" value="Otro">
    <label for="genero-otro">Otro</label><br><br>

    <label for="peso">Peso (kg):</label>
    <input type="number" id="peso" name="peso" step="0.01" required><br><br>

    <label for="altura">Altura (cm):</label>
    <input type="number" id="altura" name="altura" step="0.01" required><br><br>

    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" max="<?php echo date('Y-m-d'); ?>" required><br><br>

    <input type="submit"  value="Guardar">


</form>



</body>
</html>