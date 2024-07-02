<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/home.css" />
    <link rel="icon" type="image/x-icon" href="../assets/image/favicon-16x16.png">
    <title>Home - Momentum</title>
</head>
<body>
    <nav>
        <header>
            <div class="bar">

            </div>
            <div class="user">
                <img src="../assets/image/profile1.jpg" width="100" alt=""/>
                <div class="name">Croomer</div>
            </div>
        </header>

        <div class="links">
            <a href="./formulario.php">
                <div class="icon">
                    <iconify-icon icon="streamline:customer-support-1" height="32"></iconify-icon>
                </div>
                <div class="title">Soporte</div>
            </a>

            <a href="../index.php">
                <div class="icon">
                <iconify-icon icon="tabler:logout-2" height="32"></iconify-icon>
                </div>
                <div class="title">Cerrar Sesión</div>
            </a>
        </div>
    </nav>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <div id="table-container">
        <table>
            <thead>
                <tr>
                    <th class="inicio">Titulo 1</th>
                    <th>Titulo 2</th>
                    <th>Titulo 3</th>
                    <th>Titulo 4</th>
                    <th>Titulo 5</th>
                    <th class="fin">Titulo 6</th>
                </tr>
            </thead>
            <tbody>
            <?php
                // Configuración de la base de datos
                $servername = "localhost";
                $username = "root";
                $password = ""; // Sin contraseña
                $database = "momentum_db";

                // Crear la conexión
                $conn = new mysqli($servername, $username, $password, $database);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Obtener el id de usuario desde la solicitud GET
                $usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : 1; // Valor por defecto

                // Consulta SQL para obtener las entradas del usuario específico
                $sql = "SELECT * FROM users_financial WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $usuario_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Crear las filas de la tabla HTML
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        foreach($row as $cell) {
                            echo "<td>" . htmlspecialchars($cell) . "</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>0 resultados</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>1000</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="buttoms">
        <button class="add-buttom"><iconify-icon icon="tabler:plus" height="32"></iconify-icon></button>
        <button class="add-buttom"><iconify-icon icon="tabler:edit-circle" height="32"></iconify-icon></button>
        <button class="add-buttom"><iconify-icon icon="tabler:trash" height="32"></iconify-icon></button>
    </div>
</body>
</html>