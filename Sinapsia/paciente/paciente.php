<?php
    include_once("../functions.php");
    require_once("../dbconfig.php");
    session_start();
    if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
        header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
    }
    else{
        echo "bienvenido ".$_SESSION['nombre'];
    }
    $mail = $_SESSION['mail'];
    $id = $_SESSION['pacientes'];


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
