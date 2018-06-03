<?php
include_once("../../login/check.php");
include_once("../../class/creditocobrar.php");
$Cod=$_GET['Cod'];
$creditocobrar=new creditocobrar;
$creditocobrar->eliminarRegistro("codcreditocobrar=".$Cod);
?>