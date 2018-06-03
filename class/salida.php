<?php
include_once("bd.php");
class salida extends bd{
	var $tabla="salida";

	function cantidadSalidas($codmaterial,$codalmacen){
        $this->campos=array('sum(cantidad) as SalidaTotal');
        return $this->mostrarTodoRegistro("codmaterial=$codmaterial and codalmacen LIKE '$codalmacen'",1,"");
    }
}
?>