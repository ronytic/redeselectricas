<?php
include_once("../../login/check.php");
include_once("../../class/material.php");
$Cod=$_GET['Cod'];
$material=new material;
$material->eliminarRegistro("codmaterial=".$Cod);
?>