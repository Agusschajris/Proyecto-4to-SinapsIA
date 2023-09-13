<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php 
require_once("dbconfig.php");
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false){
  header("Location: index.php");
  exit();
}

$sql = "SELECT imagen FROM electroencefalograma WHERE id_paciente = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i",$_SESSION['id']);
if($stmt->execute()){
    $stmt->bind_result($imagen);
    $stmt->fetch();


}

?>
</body>
</html>