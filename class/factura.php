<?php
include_once("bd.php");
class factura extends bd{
	var $tabla="factura";

	function ObtenerNFactura($NumeroAutorizacion){
        $this->campos=array("MAX(NFactura) +1 AS NFacturaActual");        
        return $this->getRecords("NumeroAutorizacion =  '$NumeroAutorizacion' and activo=1");
    }
    function ObtenerPrimeraFactura($FechaDesde,$FechaHasta,$NumeroAutorizacion){
        $this->campos=array("*");        
        return $this->getRecords("fechaventa BETWEEN '$FechaDesde' and '$FechaHasta'   and NumeroAutorizacion='$NumeroAutorizacion' and activo=1","fechaventa,Nfactura,nit,nombre,total",false,0,0,false);
    }
    //("fechaventa BETWEEN '$FechaDesde' and '$FechaHasta'   and NumeroAutorizacion='$NumeroAutorizacion'",1,"fechaventa,Nfactura,nit,nombre,total")
    function ObtenerUltimaFactura($FechaDesde,$FechaHasta,$NumeroAutorizacion){
        $this->campos=array("*");          
         return $this->getRecords("fechaventa BETWEEN '$FechaDesde' and '$FechaHasta'   and NumeroAutorizacion='$NumeroAutorizacion' and activo=1","Nfactura",false,0,0,true);
    }
    //    function getRecords ($where_str=false, $order_str=false,$group_str=false, $count=false, $start=0, $order_strDesc=false)
}
?>