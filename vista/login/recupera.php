<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        p {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 30px;
        }

        input[type="email"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Botón verde */
        button {
            width: 100%;
            padding: 15px;
            background-color: #27ae60; /* Verde */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #229954; /* Verde más oscuro */
        }

        .message {
            margin-top: 20px;
            font-size: 14px;
            color: #2c3e50;
        }

        a {
            color: #27ae60;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <p>Introduce tu correo electrónico para recibir un enlace y restablecer tu contraseña.</p>
        <form action="recuperar_contraseña.php" method="POST">
            <input type="email" name="email" placeholder="Tu correo electrónico" required>
            <button type="submit">Enviar código</button>
        </form>

        <div class="message">
            <p>¿Ya recuerdas tu contraseña? <a href="login.php">Inicia sesión aquí</a>.</p>
        </div>
    </div> 
</body>
</html>