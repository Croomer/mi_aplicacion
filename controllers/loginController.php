<?php
$servername = "localhost";
$username = "root";
$password = ""; // Sin contraseña
$database = "users";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para verificar credenciales
function verificarCredenciales($conn, $usuario, $contrasena) {
    // Preparar una consulta SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM sesiones WHERE user_name = ? AND user_password = ?");
    $stmt->bind_param("ss", $usuario, $contrasena); // "ss" indica que se están pasando dos cadenas (strings)

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si se encontró un registro
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

// Supongamos que las credenciales se pasan mediante un formulario
$usuario = $_POST['username']; // O cualquier otro método de entrada
$contrasena = $_POST['password'];

// Verificar las credenciales
if (verificarCredenciales($conn, $usuario, $contrasena)) {
    echo "Credenciales válidas. Bienvenido, " . $usuario;
} else {
    echo "Credenciales inválidas. Inténtalo de nuevo.";
}


// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset-"UTF-8>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>


</body>
</html>
