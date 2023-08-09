<?php 
function post_request(){
    return ($_SERVER['REQUEST_METHOD']) === 'POST';

}

function Mysql($con){
$mysqli = mysqli_init();
$mysqli->ssl_set(NULL, NULL, "cacert.pem", NULL, NULL);
$mysqli->real_connect($con["HOST"], $con["USERNAME"], $con["PASSWORD"], $con["DATABASE"]);
if($mysqli->connect_errno)
exit('Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());

return $mysqli;


}
function checkmmail($mail){
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    exit('El email no es valido');
  }
}
?>