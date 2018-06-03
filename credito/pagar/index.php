<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Registro Cuenta por Pagar";

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
      <input type="hidden" name="codcliente" >
       <input type="hidden" name="codalmacen" >
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
            <td class="text-right">Nº Factura o Nota</td>
            <td><input type="text" name="nfactura" class="form-control" ></td>
        </tr>
         <tr>
            <td class="text-right">Monto Total de la Deuda</td>
            <td><input type="number" name="total" class="form-control" min="0" step="1" value="0" ></td>
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
            <td class="text-right">Estado</td>
            <td><select name="estado" class="form-control" >
                    <option value="pendiente">Pendiente</option>   
                    <option value="cancelado">Cancelado</option>   
                </select>
            </td>
        </tr>
        
        <tr>
            <td class="text-right">Fecha de Recepción de Material</td>
            <td><input type="date" name="fecharecepcion" class="form-control" value="<?php echo date("Y-m-d");?>"></td>
        </tr>
        <tr>
            <td class="text-right">Fecha de Cancelación</td>
            <td><input type="date" name="fechacancelacion" class="form-control" value=""></td>
        </tr>
     
        <tr>
            <td class="text-right">Personal de Recepcion</td>
            <td><select name="codusuariorecepcion" class="form-control" autofocus>
                    <option value="">Selecciona</option>
                    <?php foreach($usus as $u){?>
                    <option value="<?=$u['CodUsuario']?>"><?=$u['Paterno']?> <?=$u['Materno']?> <?=$u['Nombres']?> - <?=$u['Cargo']?></option>
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
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>