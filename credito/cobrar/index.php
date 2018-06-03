<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro Cuenta por Cobrar";

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
    $("[name=codcotizacion]").change(function(){
        var codcotizacion=$(this).val();
        $.post("obtener.php",{'cod':codcotizacion},function(data){
            $("[name=nombreempresa]").val(data.nombre);
            $("[name=telefonos]").val(data.telefonos);
            $("[name=total]").val(data.total);
            $("[name=codcliente]").val(data.codcliente);
            $("[name=codalmacen]").val(data.codalmacen);
        },"json");
    });
    
     $(document).on("keyup change","[name=adelanto]",function(){
        var adelanto=parseInt($(this).val());
        var saldo=parseInt($("[name=total]").val())-adelanto;
        $("[name=saldo]").val(saldo.toFixed(2));
    });
});
</script>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
      <input type="" name="codcliente" >
       <input type="" name="codalmacen" >
        <tr>
            <td class="text-right">Nro de Cotización</td>
            <td><input type="number" name="codcotizacion" class="form-control" autofocus >
            </td>
        </tr>
        <tr>
            <td class="text-right">Nombre de la Empresa</td>
            <td><input type="text" name="nombreempresa" class="form-control" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Teléfonos de la Empresa</td>
            <td><input type="text" name="telefonos" class="form-control" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Estado</td>
            <td><select name="estado" class="form-control" >
                    <option value="pendiente">Pendiente</option>   
                    <option value="cancelado">Cancelado</option>   
                </select>
            </td>
        </tr>
        
        
     
        
        <tr>
            <td class="text-right">Monto de la Deuda</td>
            <td><input type="number" name="total" class="form-control" min="0" step="1" value="0" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Adelanto de la Deuda</td>
            <td><input type="number" name="adelanto" class="form-control" min="0" step="1" value="0" ></td>
        </tr>
        <tr>
            <td class="text-right">Saldo de la Deuda</td>
            <td><input type="number" name="saldo" class="form-control" min="0" step="1" value="0" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Entrega de Material</td>
            <td><input type="date" name="fechaentrega" class="form-control" value="<?php echo date("Y-m-d");?>"></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Cancelación</td>
            <td><input type="date" name="fechacancelacion" class="form-control" value=""></td>
        </tr>
        <tr>
             <td class="text-right">Detalle</td>
             <td>
                 <textarea name="detalle" class="form-control"></textarea>
             </td>   
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>