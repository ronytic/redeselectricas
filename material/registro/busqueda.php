<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/material.php");
$material=new material;
$mat=$material->mostrarTodoRegistro("codproveedor LIKE '$codproveedor' and nombre LIKE '$nombre%' and codigo LIKE '$codigo%' and codtipo LIKE '$codtipo' and codsubtipo LIKE '$codsubtipo' and procedencia LIKE '$procedencia%'",1,"nombre");


include_once("../../class/proveedor.php");
$proveedor=new proveedor;


include_once("../../class/unidad.php");
$unidad=new unidad;


include_once("../../class/tipo.php");
$tipo=new tipo;


include_once("../../class/subtipo.php");
$subtipo=new subtipo;



$i=0;
foreach($mat as $m){
    
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$m['codproveedor'],1,"nombre");
    $p=array_shift($pro);
    $uni=$unidad->mostrarTodoRegistro("codunidad=".$m['codunidad'],1,"nombre");
    $u=array_shift($uni);
    $tip=$tipo->mostrarTodoRegistro("codtipo=".$m['codtipo'],1,"nombre");
    $t=array_shift($tip);
    $stipo=$subtipo->mostrarTodoRegistro("codsubtipo=".$m['codsubtipo'],1,"nombre");
    $st=array_shift($stipo);
    
    $i++;
    $datos[$i]['codmaterial']=$m['codmaterial'];
    $datos[$i]['proveedor']=$p['nombre'];
    $datos[$i]['nombre']=$m['nombre'];
    $datos[$i]['marca']=$m['marca'];
    $datos[$i]['unidad']=$u['nombre'];
    $datos[$i]['codigo']=$m['codigo'];
    $datos[$i]['tipo']=$t['nombre'];
    $datos[$i]['subtipo']=$st['nombre'];
    $datos[$i]['stockminimo']=$m['stockminimo'];
    $datos[$i]['costocompra']=$m['costocompra'];
    $datos[$i]['precioventa']=$m['precioventa'];
    $datos[$i]['procedencia']=$m['procedencia'];
}


listadotabla(array("nombre"=>"Nombre","marca"=>"Marca","unidad"=>"Unidad","codigo"=>"Codigo","proveedor"=>"Proveedor","tipo"=>"Tipo","subtipo"=>"SubTipo","stockminimo"=>"StockMin","costocompra"=>"C. Compra","precioventa"=>"P. Venta","procedencia"=>"Proce"),$datos,1,"","modificar.php","eliminar.php");
?>