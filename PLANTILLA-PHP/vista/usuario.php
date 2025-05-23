<?php
   session_start();
   if (empty($_SESSION['nombre1']) and empty($_SESSION['apellido1'])) {
       header('location:login/login.php');
   }

?>


<style>
    ul li:nth-child(2) .activo{
        background: rgb(11, 150, 214) !important;
    }
</style>

<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">
   <h4 class="text-center text-secondary">lista Sensores</h4>

    <?php
  include "../modelo/conexion.php";
  include "../controlador/controlador_modificar_Sensores.php";
  include "../controlador/controlador_eliminar_Sensores.php";
    $sql = $conexion->query(" SELECT * from Sensores");

    ?>

    <a href="registro_usuario.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i>&nbsp;Registrar</a>
   <table class="table table-bordered table-hover col-12" id="example">
      <thead>
          <tr>
          <th scope="col">Cédula</th>
            <th scope="col">PRIMER NOMBRE</th>
            <th scope="col">SEGUNDO NOMBRE</th>
            <th scope="col">PRIMER APELLIDO</th>
            <th scope="col">SEGUNDO APELLIDO</th>
            <th scope="col">TELÉFONO</th>
            <th scope="col">DIRECCIÓN</th>
            <th scope="col">CORREO</th>
            <th scope="col">USUARIO</th>
            <th></th>
          </tr>
      </thead>
      <tbody>
        <?php
        while($datos=$sql->fetch_object()) { ?>
           <tr>
              <td><?= $datos->cedula?></td>
              <td><?= $datos->nombre1?></td>
              <td><?= $datos->nombre2?></td>
              <td><?= $datos->apellido1 ?></td>
              <td><?= $datos->apellido2?></td>
              <td><?= $datos->telefono?></td>
              <td><?= $datos->direccion?></td>
              <td><?= $datos->correo?></td>
              <td><?= $datos->usuario ?></td>
              <td>
                <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->cedula ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="usuario.php?id=<?=$datos->cedula?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
              </td>
           </tr>
           <!-- Modal -->
            <div class="modal fade" cedula="exampleModal<?= $datos->cedula ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" placeholder="Cedula" class="input input__text" name="txtcedula" value="<?= $datos->cedula ?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Primer nombre" class="input input__text" name="txtnombre1" value="<?= $datos->nombre1 ?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Segundo nombre" class="input input__text" name="txtnombre2" value="<?= $datos->nombre2 ?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Primer apellido" class="input input__text" name="txtapellido1" value="<?= $datos->apellido1 ?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Segundo apellido" class="input input__text" name="txtapellido2" value="<?= $datos->apellido2 ?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Telefono" class="input input__text" name="txttelefono" value="<?= $datos->telefono?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Direccion" class="input input__text" name="txtdireccion" value="<?= $datos->direccion?>">
                      </div>
                      <div class="fl-flex-label mb-4 px-2 col-12">
                        <input type="text" placeholder="Correo" class="input input__text" name="txtcorreo" value="<?= $datos->correo?>">
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
        <?php }
        ?>
    
      </tbody>
    </table>
</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>