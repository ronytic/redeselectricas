<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/ingreso.php");
$ingreso=new ingreso;




$valores=array("codproveedor"=>"'$codproveedor'",
               "codtipo"=>"'$codtipo'",
            
               
               "codsubtipo"=>"'$codsubtipo'",
               "codmaterial"=>"'$codmaterial'",
               "cantidad"=>"'$cantidad'",
               "stock"=>"'$stock'",
               "stockfinal"=>"'$stockfinal'",
               "tipo"=>"'$tipo'",
               "codcliente"=>"'$codcliente'",
               "codalmacen"=>"'$codalmacen'",

            );


$ingreso->insertarRegistro($valores);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>