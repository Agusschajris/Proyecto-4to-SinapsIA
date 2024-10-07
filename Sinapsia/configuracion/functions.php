<?php

function post_request()
{
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

function get_request()
{
    return $_SERVER["REQUEST_METHOD"] === "GET";
}

function obtener_cuenta($pgsql, $mail)
{
    return pg_select($pgsql, "medico", ["mail" => $mail])[0] or
        die("Error: " . pg_last_error());
    /*
  if ($result = pg_select($pgsql, 'medico', array('id' => $id)))
    return $result;
  else
    die('Error: ' . pg_last_error());
  /*
    $sql = "SELECT * FROM medico WHERE id = ?";
    if($stmt = $mysqli->prepare($sql)){
        $stmt -> bind_param("i",$id);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }
    else {
        echo "No se pudo obtener la cuenta";
    }
  */
}

function checkmail($mail)
{
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "El email no es valido";
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function login($mysqli, $query, $stringtocheck)
{
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $stringtocheck);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }
}

function modificar_cuenta($pgsql, $datos)
{
    if (
        $result = pg_update(
            $pgsql,
            "medico",
            [
                "nombre" => $datos[0],
                "apellido" => $datos[1],
                "hospital" => $datos[2],
                "telefono" => $datos[3],
            ],
            ["mail" => $datos[4]]
        )
    ) {
        return $result;
    } else {
        die("Error: " . pg_last_error());
    }
    /*
  $sql = "UPDATE medico SET nombre = ?, apellido = ?, hospital = ?, telefono = ? WHERE mail = ?";
  if ($stmt = $mysqli->prepare($sql)) {
    $stmt -> bind_param("sssss",$datos[0],$datos[1],$datos[2],$datos[3],$datos[4]);
    $stmt->execute();
    $stmt->store_result();
    return $stmt;
  }
  */
}

function capitalizar($string)
{
    $string = strtolower($string);
    $string = ucwords($string);
    return $string;
}

function eliminar_cuenta($mysqli, $mail)
{
    $sql = "DELETE FROM medico WHERE mail = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }
}

function chequear($string)
{
    return isset($string) ? $string : "No hay datos";
    /*
  if (isset($string)) {
    $parto = $string;
    return $parto;
  }
  else {
    $parto = "No hay datos";
    return $parto;
  }
  */
}

?>
