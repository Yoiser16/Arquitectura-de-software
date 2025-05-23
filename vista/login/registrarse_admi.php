

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro administradores</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .registro-container {
            background-color: #fff;
            padding: 55px;
            border-radius: px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: transform 0.3s ease;
        }
        .registro-container:hover {
            transform: translateY(-5px);
        }
        .registro-container h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }
        .registro-container input[type="text"],
        .registro-container input[type="email"],
        .registro-container input[type="tel"],
        .registro-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        .registro-container input[type="text"]:focus,
        .registro-container input[type="email"]:focus,
        .registro-container input[type="tel"]:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .registro-container input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        .registro-container input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="registro-container">
    <?php
    include "../../modelo/conexion.php";
    ?>

    
    <h2>Registrarse</h2>
    <form action="login.php" method="POST">
        <input type="text" name="password" placeholder="password" required>
        <input type="text" name="usuario" placeholder="usuario" required>
        <input type="submit" value="Registrarse">
    </form>
</div>

</body>
</html>