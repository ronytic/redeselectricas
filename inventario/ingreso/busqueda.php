<?php
include_once("../../login/check.php");
extract($_POST);
$fechaIngreso=$fechaIngreso!=""?$fechaIngreso:'%';
include_once("../../class/ingreso.php");
$ingreso=new ingreso;
$ing=$ingreso->mostrarTodoRegistro("codmaterial LIKE '$codmaterial' and codalmacen LIKE '$codalmacen' and fecharegistro LIKE '$fechaIngreso'",1,"");


include_once("../../class/proveedor.php");
$proveedor=new proveedor;


include_once("../../class/unidad.php");
$unidad=new unidad;


include_once("../../class/tipo.php");
$tipo=new tipo;


include_once("../../class/subtipo.php");
$subtipo=new subtipo;

include_once("../../class/material.php");
$material=new material;

include_once("../../class/almacen.php");
$almacen=new almacen;
$i=0;
$total=0;
foreach($ing as $in){
    
    $m=$material->mostrarTodoRegistro("codmaterial=".$in['codmaterial'],1,"nombre");
    $m=array_shift($m);
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$in['codproveedor'],1,"nombre");
    $p=array_shift($pro);
    $uni=$unidad->mostrarTodoRegistro("codunidad=".$m['codunidad'],1,"nombre");
    $u=array_shift($uni);
    $tip=$tipo->mostrarTodoRegistro("codtipo=".$in['codtipo'],1,"nombre");
    $t=array_shift($tip);
    $stipo=$subtipo->mostrarTodoRegistro("codsubtipo=".$in['codsubtipo'],1,"nombre");
    $st=array_shift($stipo);
    $al=$almacen->mostrarTodoRegistro("codalmacen=".$in['codalmacen'],1,"nombre");
    $al=array_shift($al);
    $i++;
    $datos[$i]['codingreso']=$in['codingreso'];
    
    $datos[$i]['proveedor']=$p['nombre'];
    $datos[$i]['nombre']=$m['nombre'];
    $datos[$i]['marca']=$m['marca'];
    $datos[$i]['unidad']=$u['nombre'];
    $datos[$i]['codigo']=$m['codigo'];
    $datos[$i]['tipo']=$t['nombre'];
    $datos[$i]['subtipo']=$st['nombre'];
    $datos[$i]['stockanterior']=$in['stock'];
    $datos[$i]['cantidad']=$in['cantidad'];
    $datos[$i]['stockfin']=$in['stockfinal'];
    
    $datos[$i]['tipoing']=$in['tipo'];
    
    $datos[$i]['almacen']=$al['nombre'];
    $datos[$i]['fechaIng']=$in['fecharegistro'];
    $total=$total+$in['cantidad'];
    
}
$i++;
$datos[$i]['codingreso']=0;
$datos[$i]['stockanterior']="Total";
$datos[$i]['cantidad']=$total;
listadotabla(array("almacen"=>"Almacén","nombre"=>"Nombre","marca"=>"Marca","unidad"=>"Unidad","codigo"=>"Codigo","proveedor"=>"Proveedor","tipo"=>"Tipo","subtipo"=>"SubTipo","stockanterior"=>"StockAnt","cantidad"=>"Cant. ","stockfin"=>"StockFin","tipoing"=>"TipoIng","fechaIng"=>"FechaIngreso"),$datos,1,"","","");
?>