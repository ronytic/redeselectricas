<?php
include_once("../../login/check.php");
extract($_GET);
include_once("../../class/cliente.php");
$cliente=new cliente;
$cli=$cliente->mostrarTodoRegistro("nombre LIKE '%$nombre%' and descripcion LIKE '$descripcion%'",1,"nombre");
include_once("../../impresion/pdf.php");
$titulo="Reporte de Clientes";
class PDF extends PPDF{
    function Cabecera(){
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(40,"Nombre");
        $this->TituloCabecera(40,"Direccion");
        $this->TituloCabecera(20,"Nit");
        $this->TituloCabecera(40,"Nombre Cliente");
        $this->TituloCabecera(40,"Comprador");
        $this->TituloCabecera(20,"Teléfonos");
        $this->TituloCabecera(20,"Correo");
        $this->TituloCabecera(30,"Descripción");
    }
}

$pdf=new PDF("L","mm","legal");
$pdf->Addpage();
$i=0;
foreach($cli as $c){
    $i++;
    $pdf->CuadroCuerpo(8 ,$i,0,"R");
    $pdf->CuadroCuerpo(40,$c['nombre']);
    $pdf->CuadroCuerpo(40,substr($c['direccion'],0,30),0,"",0,"7");
    $pdf->CuadroCuerpo(20,$c['nit']);
    $pdf->CuadroCuerpo(40,$c['nombrecliente']);
    $pdf->CuadroCuerpo(40,$c['comprador']);
    $pdf->CuadroCuerpo(20,$c['telefonos']);
    $pdf->CuadroCuerpo(20,$c['correo'],0,"",0,"7");
    

    $pdf->CuadroCuerpo(30,substr($c['descripcion'],0,30),0,"",0,"7");
    $pdf->ln();
}

///listadotabla(array("nombre"=>"Nombre","descripcion"=>"Descripción","telefonos"=>"Teléfonos","direccion"=>"Dirección"),$cli,1,"","modificar.php","eliminar.php");
$pdf->Output();
?>