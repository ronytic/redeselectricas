<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Listado de Materiales";


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
    <form action="busqueda.php" method="post" class="formulariobusqueda" data-respuesta="respuestaformulario">
    <table class="table table-bordered table-hover">
        <tr>
           <td>Proveedor <br><select name="codproveedor" class="form-control" autofocus>
                   <option value="%">Todos</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select>
            </td>
            <td class="text-center text-bold">Nombre<br><input type="text" name="nombre" class="form-control" autofocus></td>
            <td class="text-center text-bold">Codigo<br><input type="text" name="codigo" class="form-control"></td>
            <td class="text-center">Tipo<br><select name="codtipo" class="form-control" >
                   <option value="%">Todos</option>
                    <?php foreach($tip as $t){?>
                    <option value="<?=$t['codtipo']?>"><?=$t['nombre']?></option>
                    <?php }?>
                </select></td>
            <td>SubTipo<br>
                <select name="codsubtipo" class="form-control" >
                   <option value="%">Todos</option>
                    <?php foreach($stipo as $st){?>
                    <option value="<?=$st['codsubtipo']?>"><?=$st['nombre']?></option>
                    <?php }?>
                </select>
                
            </td>
            <td class="text-center text-bold">Procedencia<br><input type="text" name="procedencia" class="form-control"></td>
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