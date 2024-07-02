<?php
$servername = "localhost";
$username = "root";
$password = ""; // Sin contraseña
$database = "momentum_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para verificar credenciales
function verificarCredenciales($conn, $usuario, $contrasena) {
    // Preparar una consulta SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND userpassword = ?");
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
     // Obtener el user_id del usuario autenticado
     $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
     $stmt->bind_param("s", $usuario);
     $stmt->execute();
     $stmt->bind_result($user_id);
     $stmt->fetch();
     $stmt->close();
 
     // Redirigir a home.php pasando el user_id como parámetro
     header("Location: ../views/home.php?user_id=" . urlencode($user_id) . "&usuario=" . urlencode($usuario));
     exit();
} else {
    header("Location: ../index.php?error=credenciales_invalidas");
    exit();
}


// Cerrar conexión
$conn->close();
?>