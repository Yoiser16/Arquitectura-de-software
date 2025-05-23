<?php
include "../modelo/conexion.php";

if (!empty($_GET["cedula"])) {
    $cedula = intval($_GET["cedula"]);
    $sql = $conexion->query("DELETE FROM usuario WHERE cedula=$cedula");

    if ($sql) { ?>
        <script>
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Usuario eliminado correctamente",
                styling: "bootstrap3",
                hide: false  // La notificación permanece hasta que el usuario la cierre manualmente
            });
            // Redirigir a usuario.php sin tiempo de espera
            window.location.href = "usuario.php";
        </script>
    <?php } else { ?>
        <script>
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "Error al eliminar usuario",
                styling: "bootstrap3",
                hide: false  // La notificación permanece hasta que el usuario la cierre manualmente
            });
            // Redirigir a usuario.php sin tiempo de espera
            window.location.href = "usuario.php";
        </script>
    <?php }
}
