<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Modificar Tipo de Material";
$Cod=$_GET['Cod'];
include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=$tipo->mostrarRegistro($Cod);
$tip=array_shift($tip);
include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Nombre</td>
            <td><input type="text" name="nombre" class="form-control" autofocus value="<?php echo $tip['nombre']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Descripción</td>
            <td><textarea name="descripcion" class="form-control"><?php echo $tip['descripcion']?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>