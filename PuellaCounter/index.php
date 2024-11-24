<?php
session_start();

if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
    header("Location: ./app/views/page/index.php");
    exit();
}

require_once __DIR__ . '/core/auth.php';

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth->authenticate();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            font-family: 'Raleway', sans-serif;
        }
        .container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .container:hover, .container:active {
            .top, .bottom {
                &:before, &:after {
                    margin-left: 200px;
                    transform-origin: -200px 50%;
                    transition-delay: 0s;
                }
            }
            .center {
                opacity: 1;
                transition-delay: 0.2s;
            }
        }
        .top, .bottom {
            &:before, &:after {
                content: '';
                display: block;
                position: absolute;
                width: 200vmax;
                height: 200vmax;
                top: 50%;
                left: 50%;
                margin-top: -100vmax;
                transform-origin: 0 50%;
                transition: all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
                z-index: 10;
                opacity: 0.65;
                transition-delay: 0.2s;
            }
        }
        .top {
            &:before {
                transform: rotate(45deg);
                background: #e46569;
            }
            &:after {
                transform: rotate(135deg);
                background: #ecaf81;
            }
        }
        .bottom {
            &:before {
                transform: rotate(-45deg);
                background: #60b8d4;
            }
            &:after {
                transform: rotate(-135deg);
                background: #3745b5;
            }
        }
        .center {
            position: absolute;
            width: 400px;
            height: 400px;
            top: 50%;
            left: 50%;
            margin-left: -200px;
            margin-top: -200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
            transition-delay: 0s;
            color: #333;
        }
        .center input {
            width: 100%;
            padding: 15px;
            margin: 5px;
            border-radius: 1px;
            border: 1px solid #ccc;
            font-family: inherit;
        }
        .center button {
            padding: 12px 20px;
            background-color: #60b8d4;
            color: white;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 15px;
        }
        .center button:hover {
            background-color: #3745b5;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }
        .center button:active {
            transform: scale(1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="center">
            <h2>Login</h2>
            <form action="" method="POST">
                <input type="text" name="user_login_name" class="input-field" placeholder="Usuario" required />
                <input type="password" name="user_password" class="input-field" placeholder="Contraseña" required />
                <button type="submit">Iniciar Sesión</button>
            </form>
            <?php
            // Mostrar mensaje de error si lo hay
            if (isset($error)) {
                echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
