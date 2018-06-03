<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/creditocobrar.php");
$creditocobrar=new creditocobrar;




$valores=array("codcliente"=>"'$codcliente'",
               "codcotizacion"=>"'$codcotizacion'",
               "codalmacen"=>"'$codalmacen'",
               
               "estado"=>"'$estado'",
               "total"=>"'$total'",
               "adelanto"=>"'$adelanto'",
               "saldo"=>"'$saldo'",
               "fechaentrega"=>"'$fechaentrega'",
               "fechacancelacion"=>"'$fechacancelacion'",
               "detalle"=>"'$detalle'",
            );


$creditocobrar->insertarRegistro($valores);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>