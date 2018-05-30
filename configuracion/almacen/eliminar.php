<?php
include_once("../../login/check.php");
include_once("../../class/almacen.php");
$Cod=$_GET['Cod'];
$almacen=new almacen;
$almacen->eliminarRegistro("codalmacen=".$Cod);
?>