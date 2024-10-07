<?php
$_ENV = parse_ini_file(".env");
($pgsql = pg_connect(
    "host=" .
        $_ENV["PGHOST"] .
        " dbname=" .
        $_ENV["PGDATABASE"] .
        " user=" .
        $_ENV["PGUSER"] .
        " password=" .
        $_ENV["PGPASSWORD"] .
        " options='endpoint=" . $_ENV["PGENDPOINTID"] . "' sslmode=require"
)) or die("No se ha podido conectar: " . pg_last_error());
//$mysqli = mysqli_init();
//$mysqli->ssl_set(NULL, NULL, "..\configuracion\cacert.pem", NULL, NULL);
//$mysqli->real_connect($_ENV["HOST"], $_ENV["USERNAME"], $_ENV["PASSWORD"], $_ENV["NAME"]);
//if($mysqli->connect_errno)
//exit('Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
?>
