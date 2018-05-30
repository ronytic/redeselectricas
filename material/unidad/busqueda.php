<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/unidad.php");
$unidad=new unidad;
$uni=$unidad->mostrarTodoRegistro("nombre LIKE '$nombre%' and descripcion LIKE '$descripcion%'",1,"nombre");
listadotabla(array("nombre"=>"Nombre","descripcion"=>"Descripción"),$uni,1,"","modificar.php","eliminar.php");
?>