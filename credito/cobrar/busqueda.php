<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/creditocobrar.php");
$creditocobrar=new creditocobrar;
include_once("../../class/cliente.php");
$cliente=new cliente;
include_once("../../class/almacen.php");
$almacen=new almacen;

$fechacancelacion=$fechacancelacion!=""?$fechacancelacion:'%';

$credito=$creditocobrar->mostrarTodoRegistro("codcliente IN(SELECT codcliente FROM cliente WHERE nombre LIKE '$nombre%') and codalmacen LIKE '$codalmacen' and estado LIKE '$estado' and fechacancelacion LIKE '$fechacancelacion'",1,"fechacancelacion");
$datos=array();
$i=0;
foreach($credito as $c){
    $i++;
    $cli=$cliente->mostrarTodoRegistro("codcliente=".$c['codcliente']);
    $cli=array_shift($cli);
    $al=$almacen->mostrarTodoRegistro("codalmacen=".$c['codalmacen']);
    $al=array_shift($al);
    
    $datos[$i]['codcotizacion']=$c['codcotizacion'];
    $datos[$i]['nombre']=$cli['nombre'];
    $datos[$i]['telefonos']=$cli['telefonos'];
    
    $datos[$i]['nombrealmacen']=$al['nombre'];
    
    $datos[$i]['estado']=$c['estado'];
    $datos[$i]['total']=$c['total'];
    $datos[$i]['adelanto']=$c['adelanto'];
     $datos[$i]['saldo']=$c['saldo'];
    
     $datos[$i]['fechacancelacion']=$c['fechacancelacion'];
    $datos[$i]['fechaentrega']=$c['fechaentrega'];
    $datos[$i]['detalle']=$c['detalle'];
}

listadotabla(array("nombre"=>"Nombre Cliente","nombrealmacen"=>"Almacen","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fechaentrega"=>"Fecha Ent.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle"),$datos,1,"","modificar.php","eliminar.php");
?>