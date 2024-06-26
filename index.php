

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/style.css" />
    <link rel="icon" type="image/x-icon" href="./assets/image/favicon-16x16.png">
    <title>Iniciar sesión - Momentum</title>
</head>
<body>
    <div class="form-container">
        <div class="login-container">
            <div class="logo-container">
                <img src="./assets/image/logo.png" alt="Logo Momentum">
            </div>
            <h2>Inicia sesión en Momentum</h2>
            <form action="./controllers/loginController.php" method="post">
                <p>
                    <label for="username">Usuario</label>
                    <input class="login-input" type="text" name="username" id="username" />
                </p>
                <p>
                    <label for="password">Contraseña</label>
                    <input class="login-input" type="password" name="password" id="password" />
                </p>
                <?php
                    if (isset($_GET['error']) && $_GET['error'] === 'credenciales_invalidas') {
                        echo '<div id="mensaje-error">';
                        echo '<span>Contraseña o usuario inválidos</span>';
                        echo '</div>';
                    }
                ?>
                <div class="options">
                    <div>
                        Recordar
                        <input type="checkbox" name="rememberme" id="rememberme" />
                    </div>
                    <div>
                        <a href="#">Olvidé contraseña</a>
                    </div>
                </div>
                <p>
                    <input type="submit" class="btn btn-login" value="Iniciar"/>
                </p>
            </form>
        </div>
        <div class="welcome-screen-container">
            <div>
                <img class="image-welcome" src="./assets/image/paisaje.jfif" alt="Ojo maligno de la codicia">
            </div>
        </div>
    </div>
</body>
</html>