<?php

session_start();

if(!empty($_POST["btningresar"])){
    if(!empty($_POST["usuario"]) and !empty( $_POST["password"])){
        $usuario=$_POST["usuario"];
        $password=md5($_POST["password"]);
        $sql=$conexion->query(" select * from usuario where usuario='$usuario' and password='$password' ");
        if ($datos=$sql->fetch_object()) {
            $_SESSION["nombre1"]=$datos->nombre1;
            $_SESSION["apellido1"]=$datos->apellido1;
            $_SESSION["cedula"]=$datos->cedula;
            header("location:../usuario.php");
        } else {
            echo"<div class='alert alert-danger'>El usuario no existe</div>";
        }
        
    } else{
        echo"<div class='alert alert-danger'>Los campos está vacíos</div>";
    }

}

?>