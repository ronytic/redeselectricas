<?php
include_once("../../login/check.php");
include_once("../../class/creditopagar.php");
$Cod=$_GET['Cod'];
$creditopagar=new creditopagar;
$creditopagar->eliminarRegistro("codcreditopagar=".$Cod);
?>