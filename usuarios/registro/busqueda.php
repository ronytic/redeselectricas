<?php
include_once("../../login/check.php");
extract($_POST);
include_once("../../class/usuario.php");
$usuario=new usuario;
$usu=$usuario->mostrarTodoRegistro("Nombres LIKE '$Nombres%' and Paterno LIKE '$Paterno%' and Materno LIKE '$Materno%' and Nivel LIKE '$Nivel'",1,"Paterno,Materno,Nombres");
$datos=array();
$i=0;
foreach($usu as $u){$i++;
    $datos[$i]['CodUsuario']=$u['CodUsuario'];
    $datos[$i]['Nombres']=$u['Nombres'];
    $datos[$i]['Paterno']=$u['Paterno'];
    $datos[$i]['Materno']=$u['Materno'];
    switch($u['Nivel']){
            case "2":{$Nivel="Gerente";}break;
            case "3":{$Nivel="Administrador";}break;
            case "4":{$Nivel="Vendedor";}break;
            case "5":{$Nivel="Almacén";}break;
            
    }
    $datos[$i]['Nivel']=$Nivel;
    $datos[$i]['Telefono']=$u['Telefono'];
    $datos[$i]['Celular']=$u['Celular'];
    $datos[$i]['Cargo']=$u['Cargo'];
}
listadotabla(array("Paterno"=>"Paterno","Materno"=>"Materno","Nombres"=>"Nombres","Nivel"=>"Nivel" ,"Cargo"=>"Cargo","Telefono"=>"Telefono","Celular"=>"Celular"),$datos,1,"","modificar.php","eliminar.php");
?>