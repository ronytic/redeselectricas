<option value="%">Selecciona</option>
<?php
extract($_POST);
include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=$tipo->mostrarTodoRegistro("codtipo IN(SELECT codtipo FROM material WHERE codproveedor=$codproveedor GROUP BY codtipo )",1,"nombre");

foreach($tip as $t){?>
<option value="<?=$t['codtipo']?>"><?=$t['nombre']?></option>
<?php }
?>


