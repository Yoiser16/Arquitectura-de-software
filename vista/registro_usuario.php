<?php
session_start();
if (empty($_SESSION['nombre1']) and empty($_SESSION['apellido1'])) {
    header('location:login/login.php');
}
?>

<style>
    ul li:nth-child(1) .activo {
        background: rgb(11, 150, 214) !important;
    }
    .is-invalid {
        border: 1px solid red !important;
    }
    .text-danger {
        color: red;
        font-size: 0.875em;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
    <h4 class="text-center text-secondary">REGISTRO DE USUARIOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_registrar_usuario.php";
    include "../controlador/controlador_eliminar_usuario.php";
    ?>

    <div class="row">
        <form action="" method="POST" autocomplete="off">
            <!-- Cédula -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="number" 
                    placeholder="Cédula" 
                    class="input input__text <?= isset($errores['cedula']) ? 'is-invalid' : '' ?>" 
                    name="txtcedula" 
                    required 
                    value="<?= $valores['cedula'] ?? '' ?>"
                    maxlength="10"
                    oninput="if(this.value.length>10)this.value=this.value.slice(0,10)">
                <?php if (isset($errores['cedula'])): ?>
                    <small class="text-danger"><?= $errores['cedula'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Primer Nombre -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="text" 
                    placeholder="Nombre1" 
                    class="input input__text <?= isset($errores['nombre1']) ? 'is-invalid' : '' ?>" 
                    name="txtnombre1" 
                    required 
                    maxlength="20"
                    value="<?= $valores['nombre1'] ?? '' ?>">
            </div>

            <!-- Primer Apellido -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="text" 
                    placeholder="Apellido1" 
                    class="input input__text <?= isset($errores['apellido1']) ? 'is-invalid' : '' ?>" 
                    name="txtapellido1" 
                    required 
                    maxlength="20"
                    value="<?= $valores['apellido1'] ?? '' ?>">
            </div>

            <!-- Correo -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="email" 
                    placeholder="Correo" 
                    class="input input__text <?= isset($errores['correo']) ? 'is-invalid' : '' ?>" 
                    name="txtcorreo" 
                    maxlength="50"
                    value="<?= $valores['correo'] ?? '' ?>">
                <?php if (isset($errores['correo'])): ?>
                    <small class="text-danger"><?= $errores['correo'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Usuario -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="text" 
                    placeholder="Usuario" 
                    class="input input__text <?= isset($errores['usuario']) ? 'is-invalid' : '' ?>" 
                    name="txtusuario" 
                    required 
                    maxlength="20"
                    value="<?= $valores['usuario'] ?? '' ?>">
                <?php if (isset($errores['usuario'])): ?>
                    <small class="text-danger"><?= $errores['usuario'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Contraseña -->
            <div class="fl-flex-label mb-4 px-2 col-12 col-md-6">
                <input 
                    type="password" 
                    placeholder="Contraseña" 
                    class="input input__text <?= isset($errores['password']) ? 'is-invalid' : '' ?>" 
                    name="txtpassword" 
                    required 
                    maxlength="30">
                <?php if (isset($errores['password'])): ?>
                    <small class="text-danger"><?= $errores['password'] ?></small>
                <?php endif; ?>
            </div>

            <!-- Botones -->
            <div class="text-right p-2">
                <a href="usuario.php" class="btn btn-secondary btn-rounded">Atrás</a>
                <button type="submit" value="ok" name="btnregistrar" class="btn btn-primary btn-rounded">Registrar</button>
            </div>
        </form>
    </div>
</div>

<!-- fin del contenido principal -->
<?php require('./layout/footer.php'); ?>
