<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/almacen.php");
$almacen=new almacen;

$valores=array("nombre"=>"'$nombre'",
               "direccion"=>"'$direccion'",
                "descripcion"=>"'$descripcion'",
            );


$almacen->actualizarRegistro($valores,"codalmacen=".$cod);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>