<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenid@s a YOFE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .header-logo {
            margin-top: 20px;
        }
        .header-logo img {
            width: 150px;
        }
        .portal-cards {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
        }
        .portal-card {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }
        .texto-estilizado {
            font-family: 'Verdana', sans-serif;
            color: green;
}

        .portal-card img {
            width: 100%;
            height: auto;
            border-radius: 50%;

        }
    </style>
</head>
<body>
    Logo y Encabezado
    <img  class="wave" src="img/greenD.avif">
    <div>

    
        <div class="header-logo">
            <img src="img/wastechD.png" alt="Logo Wastech">
            <!-- <h1 class="texto-estilizado" style="font-weight: bold;">YOFE</h1> -->
            <h3 style="font-weight: bold;">Parchate Socio!!!</h3>
        </div>

        <!-- Título -->
        <h2 style="font-weight: bold;">Bienvenidos a YOFE</h2>

        <!-- Portales -->
        <div class="portal-cards">
            <!-- Portal Nuevo Ingreso -->
            <div class="portal-card" onclick="nuevoIngreso()">
            <img src="img/nuevo.webp" alt="Nuevo Ingreso">
            <h5>PORTAL NUEVO INGRESO</h5>
            
      
    </div>

    <!-- JavaScript para ventana de confirmación -->
    <script>
        function nuevoIngreso() {
            const opcion = confirm("¿Deseas crear un nuevo perfil de Administrador o Cliente?");
            if (opcion) {
                const tipoPerfil = prompt("Escribe 'Administrador' o 'Cliente' para continuar:");
                if (tipoPerfil.toLowerCase() === 'administrador') {
                    alert("Has seleccionado crear un perfil de Administrador.");
                    window.location.href = "registrarse_admi.php";
                } else if (tipoPerfil.toLowerCase() === 'cliente') {
                    alert("Has seleccionado crear un perfil de Cliente.");
                    // Aquí podrías redirigir a una página específica para crear el perfil de Cliente
                    window.location.href = "registrarse.php";
                } else {
                    alert("Selección no válida. Por favor, escribe 'Administrador' o 'Cliente'.");
                }
            } else {
                alert("Has cancelado la creación del nuevo perfil.");

            }
        }
    </script>
</body>
</html>
