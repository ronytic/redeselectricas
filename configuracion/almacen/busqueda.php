<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/almacen.php");
$almacen=new almacen;
$al=$almacen->mostrarTodoRegistro("nombre LIKE '$nombre%' and descripcion LIKE '$descripcion%'",1,"nombre");
listadotabla(array("nombre"=>"Nombre","direccion"=>"Dirección","descripcion"=>"Descripción"),$al,1,"","modificar.php","eliminar.php");
?>