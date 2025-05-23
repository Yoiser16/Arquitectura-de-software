<?php
session_start();
session_destroy();
header("location:/PLANTILLA-PHP/vista/login/login.php");
?>