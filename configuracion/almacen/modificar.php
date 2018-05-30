<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Modificar Almacén";
$Cod=$_GET['Cod'];
include_once("../../class/almacen.php");
$almacen=new almacen;
$al=$almacen->mostrarRegistro($Cod);
$al=array_shift($al);
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Nombre</td>
            <td><input type="text" name="nombre" class="form-control" autofocus value="<?php echo $al['nombre']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Dirección</td>
            <td><input type="text" name="direccion" class="form-control" value="<?php echo $al['direccion']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Descripción</td>
            <td><textarea name="descripcion" class="form-control"><?php echo $al['descripcion']?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>