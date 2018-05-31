<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro de Cotización";

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
    
    $("[name=codcliente]").change(function(){
        var codcliente=$(this).val();
        $.post("datoscliente.php",{'codcliente':codcliente},function(data){
            $("#datoscliente").html(data)
        });
    });
    $(document).on("change",".codproveedor",function(){
        var fila=$(this).attr("rel");
        var codproveedor=$(this).val();
        $.post("tipo.php",{'codproveedor':codproveedor},function(data){
            $(".codtipo[rel="+fila+"]").html(data)
        });
    });
    $(document).on("change",".codtipo",function(){
         var fila=$(this).attr("rel");
        var codtipo=$(this).val();
        var codproveedor=$(".codproveedor[rel="+fila+"]").val()
        $.post("subtipo.php",{'codtipo':codtipo,'codproveedor':codproveedor},function(data){
            $(".codsubtipo[rel="+fila+"]").html(data)
        });
    });
    $(document).on("change",".codsubtipo",function(){
        var fila=$(this).attr("rel");
         var codsubtipo=$(this).val();
        var codtipo=$(".codtipo[rel="+fila+"]").val();
        var codproveedor=$(".codproveedor[rel="+fila+"]").val()
        $.post("material.php",{'codsubtipo':codsubtipo,'codtipo':codtipo,'codproveedor':codproveedor},function(data){
            $(".codmaterial[rel="+fila+"]").html(data)
        });
    });
    $(document).on("change",".codmaterial",function(){
        var fila=$(this).attr("rel");
        var codmaterial=$(this).val();
        var codalmacen=$("[name=codalmacen]").val();
        $.post("datos.php",{'codmaterial':codmaterial,"codalmacen":codalmacen},function(data){
            $(".marca[rel="+fila+"]").val(data.marca)
            $(".codigo[rel="+fila+"]").val(data.codigo)
            $(".unidad[rel="+fila+"]").val(data.unidad)
            $(".cantidad[rel="+fila+"]").attr("max",data.stock)
            $(".canti[rel="+fila+"]").html(data.stock)
            $(".precio[rel="+fila+"]").val(data.precioventa)
            $(".imagen[rel="+fila+"]").attr("src","../../imagenes/material/"+data.foto)
        },"json");
    });
     $(document).on("keyup change",".cantidad",function(){
         var fila=$(this).attr("rel");
        var cantidad=parseInt($(this).val());
        var precio=parseInt($(".precio[rel="+fila+"]").val());
         var total=cantidad*precio;
        $(".total[rel="+fila+"]").val(total.toFixed(2));
         sumarTodo()
    });
    $(document).on("keyup change","#descuento",function(){
       var sb=parseFloat($("#subtotal").val()); 
        var desc=parseFloat($(this).val());
        var totalgeneral=sb-desc;
        $("#totalgeneral").val(totalgeneral.toFixed(2))
    });
    var l=0;
    $("#aumentar").click(function(){l++;
       $.post("fila.php",{"f":l},function(data){
          $("#marca").before(data); 
       });
    });
});
function sumarTodo(){
    var tt=0;
    $(".total").each(function(){
       var valor=parseFloat($(this).val());
        tt=tt+valor;
    });
    $("#subtotal").val(tt.toFixed(2));
}
</script>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
      <tr>
            <td>Almacen<br><select name="codalmacen" class="form-control" required>
                    <option value="">Selecciona</option>
                    <?php foreach($al as $a){?>
                    <option value="<?=$a['codalmacen']?>"><?=$a['nombre']?></option>
                    <?php }?>
                </select>
            </td>
            <td>Cliente<br><select name="codcliente" class="form-control">
                    <option value="">Selecciona</option>
                    <?php foreach($cli as $c){?>
                    <option value="<?=$c['codcliente']?>"><?=$c['nombre']?></option>
                    <?php }?>
                </select>
                <div id="datoscliente"></div>
            </td>
            <td>
                Fecha
                <input type="date" name="fecha" value="<?=date("Y-m-d")?>" class="form-control" required>
            </td>
            
            <td>
                Tipo
                <select name="tipo" class="form-control">
                    <option value="cotizacion">Cotización</option>
                    <option value="venta">Venta</option>
                </select>
            </td>
            <td>
                Credito
                <br>
                <label><input type="radio" name="credito" value="si" class="form-radio">Si</label>
                <label><input type="radio" name="credito" value="no" class="form-radio">No</label>
            </td>
        </tr>

    </table>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="20">N</th>
                <th>Proveedor</th>
                <th>Tipo</th>
                <th>SubTipo</th>
                <th>Material</th>
                <th>Datos</th>
                <th width="100">Cantidad</th>
                <th width="100">Precio</th>
                <th width="100">Total</th>
            </tr>
        </thead>
        <tr id="marca"></tr>
        <tr>
          <td colspan="3"><a href="#" class="btn btn-danger" id="aumentar">Aumentar</a></td>
           <td class="text-right" colspan="5">SubTotal</td>
           <td><input type="text" name="subtotal" id="subtotal" readonly class="form-control  text-right" ></td>
        </tr>
        <tr>
         
           <td class="text-right" colspan="8">Descuento</td>
           <td><input type="text" name="descuento" id="descuento"value="0" class="form-control descuento text-right" ></td>
        </tr>
        <tr>
          
           <td class="text-right" colspan="8">Total</td>
           <td><input type="text" name="totalgeneral" readonly id="totalgeneral" class="form-control text-right" ></td>
        </tr>
    </table>
    <table class="table table-bordered table-hover">

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
<style>
    .cuadroimagen{
        position: relative;
    }
    .imagen{
        position: absolute;
        display: none;
    }
    .cuadroimagen:hover .imagen{
        z-index: 1000;
        display: block;
    }
</style>
<?php include_once("../../pie.php");?>