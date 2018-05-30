<?php
include_once("../../login/check.php");
include_once("../../class/subtipo.php");
$Cod=$_GET['Cod'];
$subtipo=new subtipo;
$subtipo->eliminarRegistro("codsubtipo=".$Cod);
?>