<?php
include_once("../../login/check.php");
extract($_POST);

include_once("../../class/creditopagar.php");
$creditopagar=new creditopagar;




$valores=array("codproveedor"=>"'$codproveedor'",
               "nfactura"=>"'$nfactura'",
               
               
               "codusuariorecepcion"=>"'$codusuariorecepcion'",
               
               "estado"=>"'$estado'",
               "total"=>"'$total'",
               "adelanto"=>"'$adelanto'",
               "saldo"=>"'$saldo'",
               
               "fecharecepcion"=>"'$fecharecepcion'",
               "fechacancelacion"=>"'$fechacancelacion'",
               
               "detalle"=>"'$detalle'",
            );


$creditopagar->insertarRegistro($valores);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>