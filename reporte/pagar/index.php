<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Reporte de  Cuentas por Pagar";


include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("",1,"nombre");

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="busqueda.php" method="post" class="formulariobusqueda" data-respuesta="respuestaformulario">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-center text-bold">Nº Factura<br><input type="text" name="nfactura" class="form-control" autofocus></td>
            <td class="text-center">Proveedor<select name="codproveedor" class="form-control" required>
                    <option value="%">Todos</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select></td>
                <td>
                    Tipo
                    <select name="estado" class="form-control">
                       <option value="%">Todos</option>
                        <option value="pendiente">Pendiente</option>   
                    <option value="cancelado">Cancelado</option>   
                    </select>
                </td>
                <td>
                    Fecha de Cancelación Desde <br>
                    <input type="date" name="fechacancelaciondesde" class="form-control">
                </td>
                <td>
                    Fecha de Cancelación Hasta <br>
                    <input type="date" name="fechacancelacionhasta" class="form-control">
                </td>
            <td><br><input type="submit" value="Buscar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
        </div>
        </div>
    </div>
</div>
<div class="hpanel">
    <div class="panel-heading">
    </div>

    <div class="panel-body">
        <div class="row">
        <div class="col-lg-12" id="respuestaformulario">
    
        </div>
<?php include_once("../../pie.php");?>