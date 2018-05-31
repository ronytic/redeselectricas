<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Listado de Salida de Materiales";


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

include_once("../../class/almacen.php");
$almacen=new almacen;
$al=$almacen->mostrarTodoRegistro("",1,"nombre");

include_once("../../cabecerahtml.php");
?>
<script>
$(document).on("ready",function(){
    $("[name=codproveedor]").change(function(){
        var codproveedor=$(this).val();
        $.post("tipo.php",{'codproveedor':codproveedor},function(data){
            $("[name=codtipo]").html(data)
        });
    });
    $("[name=codtipo]").change(function(){
        var codtipo=$(this).val();
        var codproveedor=$("[name=codproveedor]").val()
        $.post("subtipo.php",{'codtipo':codtipo,'codproveedor':codproveedor},function(data){
            $("[name=codsubtipo]").html(data)
        });
    });
    $("[name=codsubtipo]").change(function(){
         var codsubtipo=$(this).val();
        var codtipo=$("[name=codtipo]").val();
        var codproveedor=$("[name=codproveedor]").val()
        $.post("material.php",{'codsubtipo':codsubtipo,'codtipo':codtipo,'codproveedor':codproveedor},function(data){
            $("[name=codmaterial]").html(data)
        });
    });
    
});
</script>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="busqueda.php" method="post" class="formulariobusqueda" data-respuesta="respuestaformulario">
    <table class="table table-bordered table-hover">
        <tr>
          <td>Almacén <br><select name="codalmacen" class="form-control" autofocus>
                   <option value="%">Todos</option>
                    <?php foreach($al as $a){?>
                    <option value="<?=$a['codalmacen']?>"><?=$a['nombre']?></option>
                    <?php }?>
                </select>
            </td>
           <td>Proveedor <br><select name="codproveedor" class="form-control" autofocus>
                   <option value="%">Todos</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select>
            </td>
            <td class="text-center">Tipo<br><select name="codtipo" class="form-control" >
                   <option value="%">Selecciona</option>
                </select></td>
            <td>SubTipo<br>
                <select name="codsubtipo" class="form-control" >
                   <option value="%">Selecciona</option>
                </select>
                
            </td>
            <td>Material<br>
                <select name="codmaterial" class="form-control" >
                  <option value="%">Selecciona</option> 
                </select>
                
            </td>
             <td>Fecha de Salida<br>
                 <input type="date" name="fechaSalida" class="form-control">
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