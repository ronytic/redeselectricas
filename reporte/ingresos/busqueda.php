<?php
include_once("../../login/check.php");
$codproveedor=$_POST['codproveedor'];
$codtipo=$_POST['codtipo'];
$codsubtipo=$_POST['codsubtipo'];
$codmaterial=$_POST['codmaterial'];
$codalmacen=$_POST['codalmacen'];
$fechaIngresoDesde=$_POST['fechaIngresoDesde'];
$fechaIngresoHasta=$_POST['fechaIngresoHasta'];
//print_r($_POST);
$url="reporte.php?codproveedor=$codproveedor&codtipo=$codtipo&codsubtipo=$codsubtipo&codmaterial=$codmaterial&codalmacen=$codalmacen&fechaIngresoDesde=$fechaIngresoDesde&fechaIngresoHasta=$fechaIngresoHasta";

//echo "<br>".$url;
?>
<iframe src="<?=$url;?>" width="100%" height="600" frameborder="0"></iframe>