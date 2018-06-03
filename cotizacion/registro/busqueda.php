<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/cotizacion.php");
$cotizacion=new cotizacion;
include_once("../../class/cliente.php");
$cliente=new cliente;
include_once("../../class/almacen.php");
$almacen=new almacen;

$coti=$cotizacion->mostrarTodoRegistro("codcliente IN(SELECT codcliente FROM cliente WHERE nombre LIKE '$nombre%') and codalmacen LIKE '$codalmacen' and tipo LIKE '$tipo' and credito LIKE '$credito' ",1,"fecha");
$datos=array();
$i=0;
foreach($coti as $c){
    $i++;
    $cli=$cliente->mostrarTodoRegistro("codcliente=".$c['codcliente']);
    $cli=array_shift($cli);
    $al=$almacen->mostrarTodoRegistro("codalmacen=".$c['codalmacen']);
    $al=array_shift($al);
    
    $datos[$i]['codcotizacion']=$c['codcotizacion'];
    $datos[$i]['nombre']=$cli['nombre'];
    $datos[$i]['nombrealmacen']=$al['nombre'];
    $datos[$i]['credito']=$c['credito'];
    $datos[$i]['fecha']=$c['fecha'];
    $datos[$i]['subtotal']=$c['subtotal'];
    $datos[$i]['descuento']=$c['descuento'];
    $datos[$i]['total']=$c['totalgeneral'];
}

listadotabla(array("nombre"=>"Nombre Cliente","nombrealmacen"=>"Almacen","fecha"=>"Fecha","credito"=>"Credito","subtotal"=>"Subtotal","descuento"=>"Descuento","total"=>"Total"),$datos,1,"vercotizacion.php","","eliminar.php");
?>