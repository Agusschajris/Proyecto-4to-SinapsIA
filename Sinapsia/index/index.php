<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}
else{
    echo "bienvenido ".$_SESSION['nombre'];
}

$query = "SELECT nombre, apellido, hospital, telefono FROM medico WHERE mail = ?";
$stmt = mysqli_prepare($mysqli,$query);
$stmt->bind_param("s",$_SESSION['mail']);
if($stmt->execute()){
    
    $result = $stmt->get_result();
$row = $result->fetch_assoc();
foreach($row as $key => $value){
    echo $value."<br>";
}
}
else{
echo "Error: ".mysqli_error($mysqli);

}
?>