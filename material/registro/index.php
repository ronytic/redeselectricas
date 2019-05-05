<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro de Nuevo Material";

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("",1,"nombre");

include_once("../../class/unidad.php");
$unidad=new unidad;
$uni=$unidad->mostrarTodoRegistro("",1,"nombre");

include_once("../../class/tipo.php");
$tipo=new tipo;
$tip=$tipo->mostrarTodoRegistro("",1,"nombre");

include_once("../../class/subtipo.php");
$subtipo=new subtipo;
$stipo=$subtipo->mostrarTodoRegistro("",1,"nombre");

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
       <tr>
            <td class="text-right">Proveedor</td>
            <td><select name="codproveedor" class="form-control" autofocus>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">Nombre Material</td>
            <td><input type="text" name="nombre" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Marca</td>
            <td><input type="text" name="marca" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Unidad</td>
            <td><select name="codunidad" class="form-control" >
                    <?php foreach($uni as $u){?>
                    <option value="<?=$u['codunidad']?>"><?=$u['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">Código</td>
            <td><input type="text" name="codigo" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Tipo</td>
            <td><select name="codtipo" class="form-control" >
                    <?php foreach($tip as $t){?>
                    <option value="<?=$t['codtipo']?>"><?=$t['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">SubTipo</td>
            <td><select name="codsubtipo" class="form-control" >
                    <?php foreach($stipo as $st){?>
                    <option value="<?=$st['codsubtipo']?>"><?=$st['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>

        <tr>
            <td class="text-right">Stock Mínimo</td>
            <td><input type="number" name="stockminimo" class="form-control" min="0" step="1" value="0"></td>
        </tr>
        <tr>
            <td class="text-right">Costo de Compra</td>
            <td><input type="number" name="costocompra" class="form-control" min="0" step="0.001" value="0"></td>
        </tr>
        <tr>
            <td class="text-right">Precio de Venta</td>
            <td><input type="number" name="precioventa" class="form-control" min="0" step="0.001" value="0"></td>
        </tr>
        <tr>
            <td class="text-right">Procedencia</td>
            <td><input type="text" name="procedencia" class="form-control" min="0" step="1"></td>
        </tr>
        <tr>
            <td class="text-right">Foto</td>
            <td><input type="file" name="foto" class="form-control" min="0" step="1"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>