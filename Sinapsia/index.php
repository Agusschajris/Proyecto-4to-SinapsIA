<?php
$_ENV = parse_ini_file('.env');

  $mysqli = mysqli_init();
  $mysqli->ssl_set(NULL, NULL, "cacert.pem", NULL, NULL);
  $mysqli->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["DATABASE"]);


  $mysqli->close();
?>