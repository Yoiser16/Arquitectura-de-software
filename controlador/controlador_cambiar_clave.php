<?php

if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtclaveactual"]) && !empty($_POST["txtclavenueva"])) {
        $claveActual = md5($_POST["txtclaveactual"]);
        $nuevaClaveTexto = $_POST["txtclavenueva"];
        $cedula = intval($_POST["txtcedula"]);

        // Validación de seguridad
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $nuevaClaveTexto)) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CONTRASEÑA DÉBIL",
                        type: "error",
                        text: "La nueva contraseña debe tener al menos 8 caracteres, una mayúscula, un número y un carácter especial.",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php return; }

        $nuevaClave = md5($nuevaClaveTexto);

        $verificarClaveActual = $conexion->query("SELECT password FROM usuario WHERE cedula = $cedula");

        if ($verificarClaveActual && $verificarClaveActual->num_rows > 0) {
            $dato = $verificarClaveActual->fetch_object();

            if ($dato->password == $claveActual) {
                $sql = $conexion->query("UPDATE usuario SET password = '$nuevaClave' WHERE cedula = $cedula");

                if ($sql === true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: "La contraseña se ha modificado correctamente",
                                styling: "bootstrap3"
                            });
                        });
                    </script>
                <?php } else { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "ERROR",
                                type: "error",
                                text: "Error al modificar la contraseña",
                                styling: "bootstrap3"
                            });
                        });
                    </script>
                <?php }
            } else { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "ERROR",
                            type: "error",
                            text: "La contraseña actual es incorrecta",
                            styling: "bootstrap3"
                        });
                    });
                </script>
            <?php }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "Usuario no encontrado",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos están vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } ?>

    <!-- Limpiar reenvío -->
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php } ?>
