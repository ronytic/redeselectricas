<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Modificar Cliente";
$Cod=$_GET['Cod'];
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarRegistro($Cod);
$cli=array_shift($cli);
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Nombre</td>
            <td><input type="text" name="nombre" class="form-control" autofocus value="<?php echo $cli['nombre']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Descripción</td>
            <td><textarea name="descripcion" class="form-control"><?php echo $cli['descripcion']?></textarea></td>
        </tr>
        <tr>
            <td class="text-right">Dirección</td>
            <td><input name="direccion" class="form-control" type="text" accept="image/*" value="<?php echo $cli['direccion']?>"></td>
        </tr>
        <tr>
            <td class="text-right">NIT</td>
            <td><input name="nit" class="form-control" type="text" accept="image/*" value="<?php echo $cli['nit']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Nombre del Cliente</td>
            <td><input name="nombrecliente" class="form-control" type="text" accept="image/*" value="<?php echo $cli['nombrecliente']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Comprador</td>
            <td><input name="comprador" class="form-control" type="text" accept="image/*" value="<?php echo $cli['comprador']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Teléfonos</td>
            <td><input name="telefonos" class="form-control" type="text" accept="image/*" value="<?php echo $cli['telefonos']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Correo</td>
            <td><input name="correo" class="form-control" type="text" accept="image/*" value="<?php echo $cli['correo']?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>