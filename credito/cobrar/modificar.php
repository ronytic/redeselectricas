<?php
include_once("../../login/check.php");
$folder="../../";

$titulo="Modificar Cuenta por Cobrar";
$Cod=$_GET['Cod'];

include_once("../../class/creditocobrar.php");
$creditocobrar=new creditocobrar;
$cc=$creditocobrar->mostrarRegistro($Cod);
$cc=array_shift($cc);
    
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarRegistro($cc['codcliente']);

$cli=array_shift($cli);
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
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <input type="text" name="codcliente" value="<?=$cc['codcliente']?>">
       <input type="text" name="codalmacen" value="<?=$cc['codalmacen']?>">
        <tr>
            <td class="text-right">Nro de Cotización</td>
            <td><input type="number" name="codcotizacion" class="form-control" value="<?=$cc['codcotizacion']?>" readonly>
            </td>
        </tr>
        <tr>
            <td class="text-right">Nombre de la Empresa</td>
            <td><input type="text" name="nombreempresa" class="form-control" readonly value="<?=$cli['nombre']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Teléfonos de la Empresa</td>
            <td><input type="text" name="telefonos" class="form-control" readonly value="<?=$cli['telefonos']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Estado</td>
            <td><select name="estado" class="form-control" >
                    <option value="pendiente" <?=$cc['estado']=="pendiente"?'selected="selected"':''?>>Pendiente</option>   
                    <option value="cancelado" <?=$cc['estado']=="cancelado"?'selected="selected"':''?>>Cancelado</option>   
                </select>
            </td>
        </tr>
        
        
     
        
        <tr>
            <td class="text-right">Monto de la Deuda</td>
            <td><input type="number" name="total" class="form-control" min="0" step="1" value="<?=$cc['total']?>" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Adelanto de la Deuda</td>
            <td><input type="number" name="adelanto" class="form-control" min="0" step="1" value="<?=$cc['adelanto']?>" ></td>
        </tr>
        <tr>
            <td class="text-right">Saldo de la Deuda</td>
            <td><input type="number" name="saldo" class="form-control" min="0" step="1" value="<?=$cc['saldo']?>" readonly></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Entrega de Material</td>
            <td><input type="date" name="fechaentrega" class="form-control" value="<?=$cc['fechaentrega']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Cancelación</td>
            <td><input type="date" name="fechacancelacion" class="form-control" value="<?=$cc['fechacancelacion']?>"></td>
        </tr>
        <tr>
             <td class="text-right">Detalle</td>
             <td>
                 <textarea name="detalle" class="form-control"><?=$cc['detalle']?></textarea>
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