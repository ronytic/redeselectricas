<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Listado de Usuarios";

$niveles=array("2"=>"Gerente","3"=>"Administrador","4"=>"Vendedor","5"=>"Almacén");

include_once("../../cabecerahtml.php");
?>
<?php include_once("../../cabecera.php");?>
<div class="col-lg-12">
    <form action="busqueda.php" method="post" class="formulariobusqueda" data-respuesta="respuestaformulario">
    <table class="table table-bordered table-hover">
        <tr>
            <td class="text-center text-bold">Nombres<br><input type="text" name="Nombres" class="form-control" autofocus></td>
            <td class="text-center text-bold">Paterno<br><input type="text" name="Paterno" class="form-control" ></td>
            <td class="text-center text-bold">Materno<br><input type="text" name="Materno" class="form-control" ></td>
            <td>Nivel<br>
                <select name="Nivel" class="form-control">
                <option value="%">Todos</option>
                <?php 
                foreach($niveles as $k=>$v){
                    ?>
                    <option value="<?=$k?>"><?=$v?></option>
                    <?php
                }
                ?>
                
            </select>
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