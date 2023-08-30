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

function modificar_cuenta($mysqli,$datos){
  $sql = "UPDATE medico SET nombre = ?, apellido = ?, hospital = ?, telefono = ? WHERE mail = ?";
  if($stmt = $mysqli->prepare($sql)){
    $stmt -> bind_param("sssss",$datos[0],$datos[1],$datos[2],$datos[3],$datos[4]);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;


  

}
}
function capitalizar($string){
  $string = strtolower($string);
  $string = ucwords($string);
  return $string;
}



?>