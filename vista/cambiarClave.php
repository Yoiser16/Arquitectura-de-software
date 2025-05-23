<?php
session_start();

if (empty($_SESSION['nombre1']) && empty($_SESSION['apellido1'])) {
    header('location:login/login.php');
    exit;
}

// Verificamos que haya una cédula guardada en la sesión
if (!isset($_SESSION["cedula"]) || !is_numeric($_SESSION["cedula"])) {
    die("Error: Cedula de sesión no válida.");
}

$cedula = intval($_SESSION["cedula"]);
?>

<style>
    ul li:nth-child(3) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<div class="page-content">
    <h4 class="text-center text-secondary">CAMBIAR CONTRASEÑA</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_cambiar_clave.php";

    $sql = $conexion->query("SELECT * FROM usuario WHERE cedula = $cedula");

    if ($sql && $sql->num_rows > 0) {
        $datos = $sql->fetch_object();
    ?>
        <div class="row">
            <form action="" method="POST">
                <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                    <input type="text" class="input input__text" name="txtcedula" value="<?= $datos->cedula ?>">
                </div>

                <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="password" placeholder="Contraseña Actual" class="input input__text" name="txtclaveactual" required>
                </div>

                <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="password" placeholder="Contraseña Nueva" class="input input__text" name="txtclavenueva" required>
                </div>

                <div class="text-right p-2">
                    <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                </div>
            </form>
        </div>
    <?php
    } else {
        echo "<p class='text-danger text-center'>Usuario no encontrado.</p>";
    }
    ?>
</div>

<?php require('./layout/footer.php'); ?>
