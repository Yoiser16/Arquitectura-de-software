<?php
$errores = [];
$valores = [];

if (!empty($_POST["btnregistrar"])) {
    // Recolectar y limpiar valores
    $cedula     = trim($_POST["txtcedula"]);
    $nombre1    = trim($_POST["txtnombre1"]);
    $apellido1  = trim($_POST["txtapellido1"]);
    $correo     = trim($_POST["txtcorreo"]);
    $usuario    = trim($_POST["txtusuario"]);
    $password   = trim($_POST["txtpassword"]);

    // Guardar valores para reutilizar si hay error
    $valores = [
        'cedula'    => $cedula,
        'nombre1'   => $nombre1,
        'apellido1' => $apellido1,
        'correo'    => $correo,
        'usuario'   => $usuario
    ];

    // Validaciones
    if (empty($nombre1)) {
        $errores['nombre1'] = "El primer nombre es obligatorio.";
    }
    if (empty($apellido1)) {
        $errores['apellido1'] = "El primer apellido es obligatorio.";
    }
    if (empty($usuario)) {
        $errores['usuario'] = "El usuario es obligatorio.";
    }
    if (empty($password)) {
        $errores['password'] = "La contraseña es obligatoria.";
    }
    if (!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = "El correo no es válido.";
    }

    // Validar duplicado
    if (empty($errores)) {
        $sql = $conexion->query("SELECT COUNT(*) as total FROM usuario WHERE usuario = '$usuario'");
        $existe = $sql->fetch_object()->total;
        if ($existe > 0) {
            $errores['usuario'] = "El usuario ya existe.";
        }
    }

    // Si no hay errores, registrar
    if (empty($errores)) {
        $password_hash = md5($password); // Considera usar password_hash en el futuro

        $registro = $conexion->query("INSERT INTO usuario (cedula, nombre1, apellido1, correo, usuario, password) 
            VALUES ('$cedula', '$nombre1', '$apellido1', '$correo', '$usuario', '$password_hash')");

        if ($registro === TRUE) { ?>
            <script>
                $(function() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Usuario registrado correctamente",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php
            // Limpiar valores después del registro
            $valores = [];
        } else { ?>
            <script>
                $(function() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Error al registrar usuario",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
    }
}
?>
