<?php
include_once("../../login/check.php");
$folder="../../";

$titulo="Modificar Cuenta por Pagar";
$Cod=$_GET['Cod'];

include_once("../../class/creditopagar.php");
$creditopagar=new creditopagar;
$cp=$creditopagar->mostrarRegistro($Cod);
$cp=array_shift($cp);
    
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("",1,"nombre");

include_once("../../class/usuario.php");
$usuario=new usuario;
$usus=$usuario->mostrarTodoRegistro("Nivel IN(3,4,5)",1,"paterno,materno,nombres"); 

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
            <td class="text-right">Proveedor</td>
            <td><select name="codproveedor" class="form-control" autofocus>
                    <option value="">Selecciona</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>" <?php echo $p['codproveedor']==$cp['codproveedor']?'selected="selected"':''?>><?=$p['nombre']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="text-right">Nº Factura o Nota</td>
            <td><input type="text" name="nfactura" class="form-control" value="<?=$cp['nfactura']?>"></td>
        </tr>
         <tr>
            <td class="text-right">Monto Total de la Deuda</td>
            <td><input type="number" name="total" class="form-control" min="0" step="1" value="<?=$cp['total']?>" ></td>
        </tr>
        <tr>
            <td class="text-right">Adelanto de la Deuda</td>
            <td><input type="number" name="adelanto" class="form-control" min="0" step="1" value="<?=$cp['adelanto']?>" ></td>
        </tr>
        <tr>
            <td class="text-right">Saldo de la Deuda</td>
            <td><input type="number" name="saldo" class="form-control" min="0" step="1" value="<?=$cp['saldo']?>" readonly></td>
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
            <td class="text-right">Fecha de Recepción de Material</td>
            <td><input type="date" name="fecharecepcion" class="form-control" value="<?=$cp['fecharecepcion']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Cancelación</td>
            <td><input type="date" name="fechacancelacion" class="form-control" value="<?=$cp['fechacancelacion']?>"></td>
        </tr>
     
        <tr>
            <td class="text-right">Personal de Recepcion</td>
            <td><select name="codusuariorecepcion" class="form-control" autofocus>
                    <option value="">Selecciona</option>
                    <?php foreach($usus as $u){?>
                    <option value="<?=$u['CodUsuario']?>" <?php echo $u['CodUsuario']==$cp['codusuariorecepcion']?'selected="selected"':''?>><?=$u['Paterno']?> <?=$u['Materno']?> <?=$u['Nombres']?> - <?=$u['Cargo']?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
       
        
        <tr>
             <td class="text-right">Detalle</td>
             <td>
                 <textarea name="detalle" class="form-control"><?=$cp['detalle']?></textarea>
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