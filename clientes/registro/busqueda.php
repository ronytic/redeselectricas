<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("nombre LIKE '$nombre%' and descripcion LIKE '$descripcion%'",1,"nombre");
listadotabla(array("nombre"=>"Nombre","descripcion"=>"Descripción","telefonos"=>"Teléfonos","direccion"=>"Dirección"),$cli,1,"","modificar.php","eliminar.php");
?>