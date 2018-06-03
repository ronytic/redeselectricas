<option value="%">Selecciona</option>
<?php
extract($_POST);
include_once("../../class/material.php");
$material=new material;
$tip=$material->mostrarTodoRegistro("codsubtipo=$codsubtipo and codtipo=$codtipo and codproveedor=$codproveedor",1,"nombre");

foreach($tip as $t){?>
<option value="<?=$t['codmaterial']?>"><?=$t['nombre']?></option>
<?php }
?>


