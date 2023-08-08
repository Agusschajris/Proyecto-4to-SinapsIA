<?php

$_ENV = parse_ini_file('.env');
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "cacert.pem", NULL, NULL);
$mysqli->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);

 
  var_dump($_POST);
  if($_SERVER['REQUEST_METHOD']=== "POST"){
  $nombrecambio = $_POST['nombre'];
  $contraseña = $_POST['contrasenia'];
  }
  
  /*$sql = "UPDATE medico SET nombre = ?, contrasenia = ? WHERE idmedico = 1";
  
    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param("s", $nombrecambio);
  
    if ($stmt->execute()) {
      echo "Actualización exitosa";
    } else {
        echo "Error al actualizar: ";
    }
    */
    
  
      
  /*$nombreagregado = $_POST['nombre2'];
  $sqlcambio = "INSERT INTO medico (nombre) VALUES (?)";
  $change = $mysqli->prepare($sqlcambio);
  $change->bind_param("s", $nombreagregado);
  if($change->execute()){
    echo "cambio";
      } else {
          echo "no cambio ";
      }
  */
  
  
  
  
  
  
  
    
  ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
    </head>
    <body>
    <form action = "" method = 'POST'>
    <!-- Campo de entrada para el nombre -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" require >
    <label for="contrasenia">contraseña:</label>
    <input type="text" id="contrasenia" name="contrasenia" require >
  
    <!-- Botón para enviar el formulario -->
    <input type="submit" value="Enviar">
    
   
  
  
  </form>
    </body>
    </html>
    
    <?php 
    
    if(!isset($_POST['nombre'],$_POST['contrasenia'])){
        exit("Completa el formulario");

    }
    if(empty($_POST['nombre']) || empty($_POST['contrasenia'])){
        exit("Completa el formulario");

    }
if($stmt= $mysqli->prepare("SELECT idmedico,contrasenia FROM medico WHERE nombre = ?")){
    $stmt->bind_param("s",$_POST['nombre']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        echo "Ya existe el usuario";

    }else{
       
        $sql = "INSERT INTO medico (nombre,contrasenia) VALUES (?,?)";
  $change = $mysqli->prepare($sql);
  $change->bind_param("ss", $nombrecambio, $contraseña);
  if($change->execute()){
echo"Usuario creado!";      } else {
          echo "no cambio ";
      }
    }
}
    ?>
  
    

