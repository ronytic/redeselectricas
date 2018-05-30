<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro de Nuevo Tipo";

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Nombre</td>
            <td><input type="text" name="nombre" class="form-control" autofocus></td>
        </tr>
        <tr>
            <td class="text-right">Descripción </td>
            <td><textarea name="descripcion" class="form-control"></textarea></td>
        </tr>
        
        
        
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>