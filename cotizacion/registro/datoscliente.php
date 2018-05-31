<?php
extract($_POST);
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("codcliente=$codcliente",1,"nombre");
$cli=array_shift($cli);

?>
<strong>
Teléfonos: <?php echo $cli['telefonos']?><br>
Nit: <?php echo $cli['nit']?>
</strong>