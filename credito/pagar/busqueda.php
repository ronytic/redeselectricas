<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/creditopagar.php");
$creditopagar=new creditopagar;
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
include_once("../../class/usuario.php");
$usuario=new usuario;
$nfactura=$nfactura!=""?$nfactura:'%';
$fechacancelacion=$fechacancelacion!=""?$fechacancelacion:'%';

$credito=$creditopagar->mostrarTodoRegistro("nfactura LIKE '$nfactura' and codproveedor LIKE '$codproveedor' and estado LIKE '$estado' and fechacancelacion LIKE '$fechacancelacion'",1,"fechacancelacion");
$datos=array();
$i=0;
foreach($credito as $c){
    $i++;
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$c['codproveedor']);
    $pro=array_shift($pro);
    $usus=$usuario->mostrarTodoRegistro("CodUsuario=".$c['codusuariorecepcion']);
    $usus=array_shift($usus);
    
    $datos[$i]['codcreditopagar']=$c['codcreditopagar'];
    $datos[$i]['nombre']=$pro['nombre'];

    
    $datos[$i]['nombrerecepcion']=$usus['Paterno']." ".$usus['Materno']." ".$usus['Nombres'];
    $datos[$i]['nfactura']=$c['nfactura'];
    $datos[$i]['estado']=$c['estado'];
    $datos[$i]['total']=$c['total'];
    $datos[$i]['adelanto']=$c['adelanto'];
     $datos[$i]['saldo']=$c['saldo'];
    
     $datos[$i]['fecharecepcion']=$c['fecharecepcion'];
    $datos[$i]['fechacancelacion']=$c['fechacancelacion'];
    $datos[$i]['detalle']=$c['detalle'];
}

listadotabla(array("nombre"=>"Nombre Proveedor","nombrerecepcion"=>"Recepción","nfactura"=>"N Factura","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fecharecepcion"=>"Fecha Rec.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle"),$datos,1,"","modificar.php","eliminar.php");
?>