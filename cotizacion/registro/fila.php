<?php
$f=$_POST['f'];
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("",1,"nombre");
?>
<tr>
    <td><?=$f;?></td>
    <td><select name="p[<?=$f;?>][codproveedor]" class="form-control codproveedor" rel="<?=$f;?>">
                    <option value="">Selecciona</option>
                    <?php foreach($pro as $p){?>
                    <option value="<?=$p['codproveedor']?>"><?=$p['nombre']?></option>
                    <?php }?>
                </select>
    </td>
    <td>
        <select name="p[<?=$f;?>][codtipo]" class="form-control codtipo" rel="<?=$f;?>">

                </select>
    </td>
    <td>
        <select name="p[<?=$f;?>][codsubtipo]" class="form-control codsubtipo" rel="<?=$f;?>">

        </select>
    </td>
    <td>
        <select name="p[<?=$f;?>][codmaterial]" class="form-control codmaterial" rel="<?=$f;?>">
        </select>
    </td>
    <td class="cuadroimagen">
        <input type="text" name="p[<?=$f;?>][codigo]" readonly class="form-control codigo input-xs" rel="<?=$f;?>">
        <img src="" width="150" height="150" class="imagen img-thumbnail" rel="<?=$f;?>">

        <input type="text" name="p[<?=$f;?>][marca]" readonly class="form-control marca input-xs" rel="<?=$f;?>">
        <input type="text" name="p[<?=$f;?>][unidad]" readonly class="form-control unidad input-xs" rel="<?=$f;?>">
    </td>
    <td class="text-center">
        <input type="number" name="p[<?=$f;?>][cantidad]"  class="form-control cantidad text-right" min="0" rel="<?=$f;?>" max="0" value="0">
        <span class="canti" style="color:rgba(120,22,24,1.00)" rel="<?=$f;?>"></span>
    </td>
    <td>
        <input type="text" name="p[<?=$f;?>][precio]" readonly class="form-control precio text-right" rel="<?=$f;?>" value="0">
    </td>
    <td>
        <input type="text" name="p[<?=$f;?>][total]" readonly class="form-control total text-right" rel="<?=$f;?>" value="0">
    </td>
    <td width="15">
        <a href="#" class="eliminarfila btn btn-danger">X</a>
    </td>
</tr>