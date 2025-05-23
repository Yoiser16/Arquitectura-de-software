<?php
   session_start();
   if (empty($_SESSION['nombre1']) and empty($_SESSION['apellido1'])) {
       header('location:login/login.php');
   }
?>

<style>
    ul li:nth-child(1) .activo{
        background: rgb(11, 150, 214) !important;
    }

</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
   <h4 class="text-center text-secondary">LISTA DE USUARIOS</h4>

    <?php
    include "../modelo/conexion.php";
    include "../controlador/controlador_modificar_usuario.php";
    include "../controlador/controlador_eliminar_usuario.php";

    // Se modificó la consulta para obtener todos los usuarios
    $sql = $conexion->query("SELECT * FROM usuario");
    ?>

    <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i>&nbsp;Registrar</a>
    <table class="table table-bordered table-hover col-12" id="example">
      <thead>
          <tr>
            <th scope="col">Cédula</th>
            <th scope="col">PRIMER NOMBRE</th>
            <th scope="col">PRIMER APELLIDO</th>
            <th scope="col">CORREO</th>
            <th scope="col">USUARIO</th>
            <th></th>
          </tr>
      </thead>
      <tbody>
        <?php while($datos = $sql->fetch_object()) { 
            // Aplica la clase 'inactivo' si el estado es 0
            $clase = $datos->estado == 0 ? 'inactivo' : '';
        ?>
           <tr class="<?= $clase ?>">
              <td><?= $datos->cedula ?></td>
              <td><?= $datos->nombre1 ?></td>
              <td><?= $datos->apellido1 ?></td>
              <td><?= $datos->correo ?></td>
              <td><?= $datos->usuario ?></td>
              <td>
                <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->cedula ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="usuario.php?cedula=<?=$datos->cedula ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
              </td>
           </tr>
           <!-- Modal -->
            <div class="modal fade" id="exampleModal<?= $datos->cedula ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST">
                      <div hidden class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Cédula" class="input input__text" name="txtcedula" value="<?= $datos->cedula?>" required>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Nombre1" class="input input__text" name="txtnombre1" value="<?= $datos->nombre1 ?>" required>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Apellido1" class="input input__text" name="txtapellido1" value="<?= $datos->apellido1 ?>" required>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Correo" class="input input__text" name="txtcorreo" value="<?= $datos->correo?>" required>
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Usuario" class="input input__text" name="txtusuario" value="<?= $datos->usuario ?>" required>
                      </div>
                      <div class="text-right p-2">
                        <a href="usuario.php" class="btn btn-secondary btn-rounded">Atras</a>
                        <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>
      </tbody>
    </table>
</div>
<!-- fin del contenido principal -->

<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>
