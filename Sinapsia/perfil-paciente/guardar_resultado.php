<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el resultado enviado desde el cliente
    $resultado = $_POST['resultado'];

    // Guardar el resultado en una variable PHP (puedes almacenarlo en una base de datos, archivo, etc.)
    // Por ejemplo, almacenarlo en una variable de sesión para su uso posterior
    session_start();
    $_SESSION['resultado'] = $resultado;

    // Puedes enviar una respuesta al cliente si es necesario
    echo 'Resultado guardado exitosamente.';
} else {
    // Manejar solicitudes no permitidas, si es necesario
    http_response_code(405);
    echo 'Método no permitido';
}
?>
