<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Modificar Usuario";
$Cod=$_GET['Cod'];
include_once("../../class/usuario.php");
$usuario=new usuario;
$u=$usuario->mostrarRegistro($Cod);
$u=array_shift($u);
$niveles=array("2"=>"Gerente","3"=>"Administrador","4"=>"Vendedor","5"=>"Almacén");

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="actualizar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cod" value="<?php echo $Cod;?>">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Usuario</td>
            <td><input type="text" name="Usuario" class="form-control" autofocus value="<?=$u['Usuario']?>" required></td>
        </tr>
        <tr>
            <td class="text-right">Contraseña</td>
            <td><input type="password" name="Pass" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Nivel de Usuario</td>
            <td><select name="Nivel" class="form-control">
                <?php 
                foreach($niveles as $k=>$v){
                    ?>
                    <option value="<?=$k?>" <?=$u['Nivel']==$k?'selected="selected"':''?>><?=$v?></option>
                    <?php
                }
                ?>
                
            </select></td>
        </tr>
        <tr>
            <td class="text-right">Nombres</td>
            <td><input type="text" name="Nombres" class="form-control" value="<?=$u['Nombres']?>" required></td>
        </tr>
        <tr>
            <td class="text-right">Paterno</td>
            <td><input type="text" name="Paterno" class="form-control" value="<?=$u['Paterno']?>" required></td>
        </tr>
        <tr>
            <td class="text-right">Materno</td>
            <td><input type="text" name="Materno" class="form-control" value="<?=$u['Materno']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Cargo</td>
            <td><input type="text" name="Cargo" class="form-control" value="<?=$u['Cargo']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Ci</td>
            <td><input type="text" name="Ci" class="form-control" value="<?=$u['Ci']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Direccion</td>
            <td><input type="text" name="Direccion" class="form-control" value="<?=$u['Direccion']?>"></td>
        </tr>
        
        <tr>
            <td class="text-right">Telefono</td>
            <td><input type="text" name="Telefono" class="form-control" value="<?=$u['Telefono']?>"></td>
        </tr>
        <tr>
            <td class="text-right">Celular</td>
            <td><input type="text" name="Celular" class="form-control" value="<?=$u['Celular']?>"></td>
        </tr>
        
    
        
        <tr>
            <td class="text-right">Observacion </td>
            <td><textarea name="Observacion" class="form-control"><?=$u['Observacion']?></textarea></td>
        </tr>
        
        
        
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>