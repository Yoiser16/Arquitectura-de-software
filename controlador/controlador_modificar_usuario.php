<?php

if(!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre1"]) and !empty($_POST["txtapellido1"]) and !empty($_POST["txtusuario"]) ) {
        $nombre1=$_POST["txtnombre1"];
        $apellido1=$_POST["txtapellido1"];
        $correo=$_POST["txtcorreo"];
        $usuario=$_POST["txtusuario"];
        $cedula=$_POST["txtcedula"];
        $sql=$conexion->query("select count(*) as 'total' from usuario where usuario='$usuario' and cedula!=$cedula");
        if ($sql->fetch_object()->total > 0) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                       title:"ERROR",
                       type:"error",
                       text:"El usuario <?= $usuario ?> ya existe",
                       styling:"bootstrap3" 
                    }) 
                }) 
            </script>
       <?php } else {
       $modificar=$conexion->query(" update usuario set nombre1='$nombre1',apellido1='$apellido1',correo='$correo',usuario='$usuario' where cedula=$cedula  ");
       if ($modificar == true) { ?>
          <script>
             $(function notificacion() {
                new PNotify({
                  title:"CORRECTO",
                  type:"success",
                  text:"El usuario se ha modificado correctamente",
                  styling:"bootstrap3" 
                })
             })
           </script>
           <?php } else { ?>
            <script>
               $(function notificacion() {
                    new PNotify({
                       title:"INCORRECTO",
                       type:"error",
                       text:"Error al modificar usuario",
                       styling:"bootstrap3" 
                    })
                })
            </script>
            <?php }
            
        }
        
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                   title:"ERROR",
                   type:"error",
                   text:"Los campos están vacíos",
                   styling:"bootstrap3" 
                })
            })
        </script>
    <?php } ?>

<script>
        setTimeout(() => {
            window.history.replaceState(null,null,window.location.pathname);
        }, 0);
    </script>

    <?php }

?>