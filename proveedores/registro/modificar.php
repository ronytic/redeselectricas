<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Modificar Proveedor";
$Cod=$_GET['Cod'];
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarRegistro($Cod);
$pro=array_shift($pro);
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Nombre</td>
            <td><input type="text" name="nombre" class="form-control" autofocus value="<?php echo $pro['nombre']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Descripción</td>
            <td><textarea name="descripcion" class="form-control"><?php echo $pro['descripcion']?></textarea></td>
        </tr>
        <tr>
            <td class="text-right">Dirección</td>
            <td><input name="direccion" class="form-control" type="text" accept="image/*" value="<?php echo $pro['direccion']?>"></td>
        </tr>
        <tr>
            <td class="text-right">NIT</td>
            <td><input name="nit" class="form-control" type="text" accept="image/*" value="<?php echo $pro['nit']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Nombre del Encargado</td>
            <td><input name="nombreencargado" class="form-control" type="text" accept="image/*" value="<?php echo $pro['nombreencargado']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Secretaria</td>
            <td><input name="secretaria" class="form-control" type="text" accept="image/*" value="<?php echo $pro['secretaria']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Teléfonos</td>
            <td><input name="telefonos" class="form-control" type="text" accept="image/*" value="<?php echo $pro['telefonos']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Correo</td>
            <td><input name="correo" class="form-control" type="text" accept="image/*" value="<?php echo $pro['correo']?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>