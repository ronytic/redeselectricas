<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/cotizacion.php");
$cotizacion=new cotizacion;
include_once("../../class/cotizaciondetalle.php");
$cotizaciondetalle=new cotizaciondetalle;

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

$valores=array("codalmacen"=>"'$codalmacen'",
               "codcliente"=>"'$codcliente'",
            
               
               "fecha"=>"'$fecha'",
               "tipo"=>"'$tipo'",
               "credito"=>"'$credito'",
               "subtotal"=>"'$subtotal'",
               "descuento"=>"'$descuento'",
               "totalgeneral"=>"'$totalgeneral'",
               "detalle"=>"'$detalle'",

            );


$cotizacion->insertarRegistro($valores);
$codcotizacion=$cotizacion->ultimo();
foreach($p as $f){
    extract($f);
    $valores=array(
               "codcotizacion"=>"'$codcotizacion'",
            
               
               "codproveedor"=>"'$codproveedor'",
               "codtipo"=>"'$codtipo'",
               "codsubtipo"=>"'$codsubtipo'",
               "codmaterial"=>"'$codmaterial'",
               "codigo"=>"'$codigo'",
               "marca"=>"'$marca'",
               "unidad"=>"'$unidad'",
                "cantidad"=>"'$cantidad'",
                "precio"=>"'$precio'",
                "total"=>"'$total'",
            );
    $cotizaciondetalle->insertarRegistro($valores);
}

//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
$botones=array("Ver Cotización"=>array("vercotizacion.php?Cod=$codcotizacion","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");