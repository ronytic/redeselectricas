<?php
include_once("bd.php");
class ingreso extends bd{
	var $tabla="ingreso";

	function cantidadIngresos($codmaterial,$codalmacen){
        $this->campos=array('sum(cantidad) as IngresoTotal');
        return $this->mostrarTodoRegistro("codmaterial=$codmaterial and codalmacen=$codalmacen",1,"");
    }
}
?>