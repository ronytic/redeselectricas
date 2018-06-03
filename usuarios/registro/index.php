<?php
include_once("../../login/check.php");
$folder="../../";

$niveles=array("2"=>"Gerente","3"=>"Administrador","4"=>"Vendedor","5"=>"Almacén");
$titulo="Registro de Nuevo Usuario";

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="guardar.php" method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-right">Usuario</td>
            <td><input type="text" name="Usuario" class="form-control" autofocus required></td>
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
                    <option value="<?=$k?>"><?=$v?></option>
                    <?php
                }
                ?>
                
            </select></td>
        </tr>
        <tr>
            <td class="text-right">Nombres</td>
            <td><input type="text" name="Nombres" class="form-control" required></td>
        </tr>
        <tr>
            <td class="text-right">Paterno</td>
            <td><input type="text" name="Paterno" class="form-control" required></td>
        </tr>
        <tr>
            <td class="text-right">Materno</td>
            <td><input type="text" name="Materno" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Cargo</td>
            <td><input type="text" name="Cargo" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Ci</td>
            <td><input type="text" name="Ci" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Direccion</td>
            <td><input type="text" name="Direccion" class="form-control" ></td>
        </tr>
        
        <tr>
            <td class="text-right">Telefono</td>
            <td><input type="text" name="Telefono" class="form-control" ></td>
        </tr>
        <tr>
            <td class="text-right">Celular</td>
            <td><input type="text" name="Celular" class="form-control" ></td>
        </tr>
        
    
        
        <tr>
            <td class="text-right">Observacion </td>
            <td><textarea name="Observacion" class="form-control"></textarea></td>
        </tr>
        
        
        
        <tr>
            <td></td>
            <td><input type="submit" value="Guardar" class="btn btn-info"></td>
        </tr>
    </table>
    </form>
</div>
<?php include_once("../../pie.php");?>