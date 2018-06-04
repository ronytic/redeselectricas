<?php
extract($_POST);
include_once("../../class/material.php");
$material=new material;
$mat=$material->mostrarTodoRegistro("codmaterial=$codmaterial",1,"nombre");

$mat=array_shift($mat);

include_once("../../class/unidad.php");
$unidad=new unidad;
$uni=$unidad->mostrarTodoRegistro("codunidad=".$mat['codunidad'],1,"nombre");
$uni=array_shift($uni);

include_once("../../class/ingreso.php");
$ingreso=new ingreso;
$ing=$ingreso->cantidadIngresos($codmaterial,$codalmacen);
$ing=array_shift($ing);

include_once("../../class/salida.php");
$salida=new salida;
$sal=$salida->cantidadSalidas($codmaterial,$codalmacen);
$sal=array_shift($sal);


$stock=$ing['IngresoTotal']-$sal['SalidaTotal'];

$valores=array("marca"=>$mat['marca'],
              "codigo"=>$mat['codigo'],
              "unidad"=>$uni['nombre'],
              "stock"=>$stock,
               "precioventa"=>$mat['precioventa'],
              );
echo json_encode($valores)
?>


