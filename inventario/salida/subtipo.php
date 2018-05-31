<option value="%">Selecciona</option>
<?php
extract($_POST);
include_once("../../class/subtipo.php");
$subtipo=new subtipo;
$tip=$subtipo->mostrarTodoRegistro("codsubtipo IN(SELECT codsubtipo FROM material WHERE codtipo=$codtipo and codproveedor=$codproveedor GROUP BY codsubtipo )",1,"nombre");

foreach($tip as $t){?>
<option value="<?=$t['codsubtipo']?>"><?=$t['nombre']?></option>
<?php }
?>


