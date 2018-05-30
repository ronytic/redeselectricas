<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/tipo.php");
$tipo=new tipo;

$valores=array("nombre"=>"'$nombre'",
                "descripcion"=>"'$descripcion'",
            );


$tipo->actualizarRegistro($valores,"codtipo=".$cod);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>