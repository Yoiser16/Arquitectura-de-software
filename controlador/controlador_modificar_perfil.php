<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre1"]) && !empty($_POST["txtapellido1"]) && !empty($_POST["txtusuario"])) {
        include "../modelo/conexion.php"; // Asegúrate de incluir la conexión aquí si no está incluida

        $nombre1 = $_POST["txtnombre1"];
        $apellido1 = $_POST["txtapellido1"];
        $usuario = $_POST["txtusuario"];
        $cedula = $_POST["txtcedula"];

        // Validación de los límites de caracteres
        if (strlen($nombre1) > 50 || strlen($apellido1) > 50 || strlen($usuario) > 30) {
            ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Uno o más campos exceden el límite de caracteres",
                        styling: "bootstrap3"
                    });
                });
            </script>
            <?php
        } else {
            // Usamos consulta preparada para evitar inyección SQL
            $stmt = $conexion->prepare("UPDATE usuario SET nombre1 = ?, apellido1 = ?, usuario = ? WHERE cedula = ?");
            $stmt->bind_param("ssss", $nombre1, $apellido1, $usuario, $cedula);

            if ($stmt->execute()) {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "Datos modificados correctamente",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Error al modificar los datos",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            }
        }

    } else {
        ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Los campos están vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php
    }
    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php
}
?>
