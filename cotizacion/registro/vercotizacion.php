<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Ver de Cotización";
extract($_GET);
$url="reporte.php?Cod=$Cod";

include_once("../../cabecerahtml.php");
?>

<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
   <a href="<?=$url;?>" target="_blank" class="btn btn-danger">Ver Reporte en Nueva Ventana</a>
    <iframe src="<?=$url;?>" width="100%" height="600" frameborder="0"></iframe>
</div>

<?php include_once("../../pie.php");?>