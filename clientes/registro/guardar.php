<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/cliente.php");
$cliente=new cliente;
$valores=array("nombre"=>"'$nombre'",
                "descripcion"=>"'$descripcion'",
                "direccion"=>"'$direccion'",
               "nit"=>"'$nit'",
               "nombrecliente"=>"'$nombrecliente'",
               "comprador"=>"'$comprador'",
               "telefonos"=>"'$telefonos'",
               "correo"=>"'$correo'",
            );
$cliente->insertarRegistro($valores);
//print_r($valores);
$titulo="Mensaje de Confirmación";
$folder="../../";
$nuevo=1;
$listar=1;
//$botones=array("Facturar"=>array("facturar.php","danger"));
$mensajes[]="Sus datos fueron guardados correctamente.";
include_once("../../respuesta.php");
?>