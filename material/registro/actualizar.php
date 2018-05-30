<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/material.php");
$material=new material;

$valores=array("codproveedor"=>"'$codproveedor'",
               "nombre"=>"'$nombre'",
               "marca"=>"'$marca'",
               "codunidad"=>"'$codunidad'",
               "codigo"=>"'$codigo'",
               "codtipo"=>"'$codtipo'",
               "codsubtipo"=>"'$codsubtipo'",
               "stockminimo"=>"'$stockminimo'",
               "costocompra"=>"'$costocompra'",
               "precioventa"=>"'$precioventa'",
               "procedencia"=>"'$procedencia'",
            );

if($_FILES['foto']['name']!=""){
    copy($_FILES['foto']['tmp_name'],"../../imagenes/material/".$_FILES['foto']['name']);
    $foto=$_FILES['foto']['name'];
    $valores["foto"]="'$foto'";
}
$material->actualizarRegistro($valores,"codmaterial=".$cod);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>