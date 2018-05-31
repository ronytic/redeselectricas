<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro de Ingreso de Material";

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("",1,"nombre");

include_once("../../class/almacen.php");
$almacen=new almacen;
$al=$almacen->mostrarTodoRegistro("",1,"nombre");


include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("",1,"nombre");


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
    $("[name=codmaterial]").change(function(){
         var codmaterial=$(this).val();
       var codalmacen=$("[name=codalmacen]").val();
        $.post("datos.php",{'codmaterial':codmaterial,"codalmacen":codalmacen},function(data){
            $("[name=marca]").val(data.marca)
            $("[name=codigo]").val(data.codigo)
            $("[name=unidad]").val(data.unidad)
            $("[name=stock]").val(data.stock)
        },"json");
    });
     $(document).on("keyup change","[name=cantidad]",function(){
        var cantidad=parseInt($(this).val());
        var cantidadf=parseInt($("[name=stock]").val())+cantidad;
        $("[name=stockfinal]").val(cantidadf);
    });
});
</script>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
      <tr>
            <td class="text-right">Almacen</td>
            <td><select name="codalmacen" class="form-control" required>
                    <option value="">Selecciona</option>
                    <?php foreach($al as $a){?>
                    <option value="<?=$a['codalmacen']?>"><?=$a['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
       <tr>
            <td class="text-right">Proveedor</td>
            <td><select name="codproveedor" class="form-control" autofocus>
                    <option value="">Selecciona</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">Tipo</td>
            <td><select name="codtipo" class="form-control" >
                    
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">SubTipo</td>
            <td><select name="codsubtipo" class="form-control" >
                   
                </select>
            </td>
        </tr>
        
        <tr>
            <td class="text-right">Nombre Material</td>
            <td><select name="codmaterial" class="form-control" required>
                </select></td>
        </tr>
        <tr>
            <td class="text-right">Marca</td>
            <td><input type="text" name="marca" class="form-control" readonly></td>
        </tr>
        
        <tr>
            <td class="text-right">Código</td>
            <td><input type="text" name="codigo" class="form-control" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Unidad</td>
            <td><input type="text" name="unidad" class="form-control" readonly></td>
        </tr>
        
        <tr>
            <td class="text-right">Stock</td>
            <td><input type="number" name="stock" class="form-control" min="0" step="1" value="0" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Cantidad a Ingresar</td>
            <td><input type="number" name="cantidad" class="form-control" min="0" step="1" value="0"></td>
        </tr>
        <tr>
            <td class="text-right">Stock Final</td>
            <td><input type="number" name="stockfinal" class="form-control" min="0" step="1" value="0" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Tipo</td>
            <td><select name="tipo" class="form-control">
                    <option value="ingreso">Ingreso</option>
                    <option value="devolucion">Devolución</option>
                    <option value="traspaso">Traspaso</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">Cliente</td>
            <td><select name="codcliente" class="form-control">
                    <option value="">Selecciona</option>
                    <?php foreach($cli as $c){?>
                    <option value="<?=$c['codcliente']?>"><?=$c['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
             <td class="text-right">Detalle</td>
             <td>
                 <textarea name="detalle" class="form-control"></textarea>
             </td>   
        </tr>
        <tr>
            <td colspan="2"><div class="alert alert-danger"><b>Por Seguridad del Inventario no se permite Modificar una ves Ingresado el Material, VERIFIQUE NUEVAMENTE</b></div></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>