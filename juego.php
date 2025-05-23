<?php
session_start();
if (empty($_SESSION['nombre1']) && empty($_SESSION['apellido1'])) {
    header('location:login/login.php');
    exit();
}

// Construir el nombre completo desde la sesión
$nombreJugador = htmlspecialchars($_SESSION['nombre1'] . ' ' . $_SESSION['apellido1']);
?>

<link rel="stylesheet" href="public/css/style.css" />

<h1 id="title">Yofe Dodge</h1>

<div id="logo">
    <img src="vista\login\img\logo.png" alt="Logo Yofe Dodge" />
</div>


<div id="menu">
    <button class="btn" onclick="Controller.selectDifficulty('easy')">Fácil</button>
    <button class="btn" onclick="Controller.selectDifficulty('medium')">Medio</button>
    <button class="btn" onclick="Controller.selectDifficulty('hard')">Difícil</button>
</div>

<canvas id="gameCanvas" width="800" height="600"></canvas>

<script>
    // Pasar el nombre de usuario desde PHP a JavaScript
    const nombreJugador = "<?php echo $nombreJugador; ?>";
</script>

<script src="public/js/model.js"></script>
<script src="public/js/view.js"></script>
<script src="public/js/controller.js"></script>

<?php require('./vista/layout/footer.php'); ?>
