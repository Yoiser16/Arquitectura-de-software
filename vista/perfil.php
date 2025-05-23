<?php
session_start();
if (empty($_SESSION['nombre1']) && empty($_SESSION['apellido1'])) {
    header('location:login/login.php');
    exit();
}

// Usar la cédula en lugar de ID
$cedula = $_SESSION["cedula"] ?? null;
if (!$cedula) {
    die("Error: Cédula de usuario no válida");
}
?>

<style>
    ul li:nth-child(3) .activo {
        background: rgb(11, 150, 214) !important;
    }
</style>

<?php require('./layout/topbar.php'); ?>
<?php require('./layout/sidebar.php'); ?>

<div class="page-content">
    <h4 class="text-center text-secondary">PERFIL</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_perfil.php";

    try {
        $stmt = $conexion->prepare("SELECT * FROM usuario WHERE cedula = ?");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $resultado = $stmt->get_result();
    } catch (Exception $e) {
        die("Error al consultar la base de datos: " . $e->getMessage());
    }
    ?>

    <div class="row">
        <form action="" method="POST">
            <?php
            if ($resultado->num_rows > 0) {
                while ($datos = $resultado->fetch_object()) {
            ?>
                    <div hidden class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" class="input input__text" name="txtcedula" value="<?= htmlspecialchars($datos->cedula ?? '') ?>">
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Primer nombre" class="input input__text" name="txtnombre1"
                               value="<?= htmlspecialchars($datos->nombre1 ?? '') ?>" maxlength="30" oninput="updateCounter(this, 'nombre1-count', 50)">
                        <small id="nombre1-count" class="form-text text-muted">0 / 30</small>
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Primer apellido" class="input input__text" name="txtapellido1"
                               value="<?= htmlspecialchars($datos->apellido1 ?? '') ?>" maxlength="30" oninput="updateCounter(this, 'apellido1-count', 50)">
                        <small id="apellido1-count" class="form-text text-muted">0 / 30</small>
                    </div>
                    <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                        <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario"
                               value="<?= htmlspecialchars($datos->usuario ?? '') ?>" maxlength="30" oninput="updateCounter(this, 'usuario-count', 30)">
                        <small id="usuario-count" class="form-text text-muted">0 / 30</small>
                    </div>
                    <div class="text-right p-2">
                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-12'><p class='text-danger'>No se encontraron datos del usuario.</p></div>";
            }
            ?>
        </form>
    </div>
</div>

<script>
    function updateCounter(input, counterId, maxLength) {
        const counter = document.getElementById(counterId);
        counter.textContent = input.value.length + " / " + maxLength;
    }

    // Inicializa contadores si hay valores preexistentes
    window.onload = function () {
        const campos = [
            { id: 'txtnombre1', contador: 'nombre1-count', max: 30 },
            { id: 'txtapellido1', contador: 'apellido1-count', max: 30 },
            { id: 'txtusuario', contador: 'usuario-count', max: 30 }
        ];

        campos.forEach(campo => {
            const input = document.getElementsByName(campo.id)[0];
            if (input) {
                updateCounter(input, campo.contador, campo.max);
            }
        });
    };
</script>

<?php require('./layout/footer.php'); ?>
