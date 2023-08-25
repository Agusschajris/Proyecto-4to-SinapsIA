<?php 
function post_request(){
    return ($_SERVER['REQUEST_METHOD']) === 'POST';

}




function checkmail($mail){
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    exit('El email no es valido');
  }


  
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function login($mysqli,$query,$stringtocheck,$pass){
  if($stmt = $mysqli->prepare($query)){
    $stmt -> bind_param("ss",$stringtocheck,$pass);
    $stmt->execute();
    $stmt->store_result();
    return $stmt; 
}

}

function modificar_cuenta($datos){
  $sql = "UPDATE medico SET 
  mail = ?
  nombre = ?,
  apellido = ?,
  hospital = ?,
  telefono = ?,
  WHERE mail = ?";
  if($stmt= $mysqli->prepare($sql)){
    $stmt->bind_param("ssssss");
    $stmt->execute();
    echo "Cambios en el usuario hecho!";
  }



  

}
?>