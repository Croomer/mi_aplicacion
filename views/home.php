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
                <div class="name">
                    <?php
                    $usuario = $_GET['usuario'];
                    echo "<span>$usuario</span>";
                    ?>
                </div>
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
                    <th class="inicio">Referencia</th>
                    <th>Id</th>
                    <th>Tipo</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Monto (Bs)</th>
                    <th class="fin">Monto ($)</th>
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

                // Verificar si user_id está presente en la URL
                if (isset($_GET['user_id'])) {
                    $usuario_id = $_GET['user_id'];
                } else {
                // Manejar caso donde user_id no está presente
                    echo "Error: No se encontró ID de usuario.";
                }

                //$usuario_id = isset($_GET['usuario_id']) ? $_GET['usuario_id'] : 1; // Valor por defecto

                // Consulta SQL para obtener las entradas del usuario específico
                $sql = "SELECT * FROM users_financial WHERE user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $usuario_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $total_monto_bs = 0;
                $total_monto_usd = 0;
                $monto_actual_bs = 0;
                $monto_actual_usa = 0;

                // Crear las filas de la tabla HTML
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        $monto_actual_bs = $row['bs_value'];
                        $monto_actual_usa = $row['usa_value'];

                        if (!$row['type']) {
                            $monto_actual_bs = $monto_actual_bs * -1;
                            $monto_actual_usa = $monto_actual_usa *-1;
                        }

                        $total_monto_bs += $monto_actual_bs;
                        $total_monto_usd += $monto_actual_usa;

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
                    <th>Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo number_format($total_monto_bs, 2); ?></th>
                    <th><?php echo number_format($total_monto_usd, 2); ?></th>
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