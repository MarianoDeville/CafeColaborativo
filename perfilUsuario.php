<?php

    include("./template/cabecera.php");
    session_unset();
    header('Location:index.php');
    include("./template/pie.php");
?>