<?php
$cod=$_POST['cod'];
include_once("../../login/check.php");
include_once("../../class/cotizacion.php");
$cotizacion=new cotizacion;
include_once("../../class/cliente.php");
$cliente=new cliente;
$c=$cotizacion->mostrarRegistro($cod);
$c=array_shift($c);
$cli=$cliente->mostrarRegistro($c['codcliente']);
$cli=array_shift($cli);

$valores=array("total"=>number_format($c['totalgeneral'],2,".",""),
              "codcliente"=>$cli['codcliente'],
               "nombre"=>$cli['nombre'],
               "telefonos"=>$cli['telefonos'],
               "codalmacen"=>$c['codalmacen']
              );
echo json_encode($valores);
?>