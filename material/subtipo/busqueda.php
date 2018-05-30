<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/subtipo.php");
$subtipo=new subtipo;
$stip=$subtipo->mostrarTodoRegistro("nombre LIKE '$nombre%' and descripcion LIKE '$descripcion%'",1,"nombre");
listadotabla(array("nombre"=>"Nombre","descripcion"=>"Descripción"),$stip,1,"","modificar.php","eliminar.php");
?>