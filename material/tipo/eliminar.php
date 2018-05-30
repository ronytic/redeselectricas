<?php
include_once("../../login/check.php");
include_once("../../class/tipo.php");
$Cod=$_GET['Cod'];
$tipo=new tipo;
$tipo->eliminarRegistro("codtipo=".$Cod);
?>