<?php
include_once("../../login/check.php");
extract($_GET);
include_once("../../class/creditopagar.php");
$creditopagar=new creditopagar;
include_once("../../class/proveedor.php");
$proveedor=new proveedor;
include_once("../../class/usuario.php");
$usuario=new usuario;
$nfactura=$nfactura!=""?$nfactura:'%';


if($fechacancelaciondesde!=""){
    

    $fecha="fechacancelacion BETWEEN '$fechacancelaciondesde' and '$fechacancelacionhasta'";
}else{
    
    $fecha="fechacancelacion LIKE '%'";
}

$credito=$creditopagar->mostrarTodoRegistro("nfactura LIKE '$nfactura' and codproveedor LIKE '$codproveedor' and estado LIKE '$estado' and $fecha",1,"fechacancelacion");


include_once("../../impresion/pdf.php");
$titulo="Reporte de Cuentas por Pagar";
class PDF extends PPDF{
    function Cabecera(){
        array("nombre"=>"Nombre Cliente","nombrealmacen"=>"Almacen","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fechaentrega"=>"Fecha Ent.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle");
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(30,"Proveedor");
        $this->TituloCabecera(50,"Recepción");
        $this->TituloCabecera(20,"Nº Factura");
        $this->TituloCabecera(20,"Estado");
        $this->TituloCabecera(20,"Total");
        $this->TituloCabecera(20,"Adelanto");
        $this->TituloCabecera(20,"Saldo");
        $this->TituloCabecera(20,"Fecha Rec.");
        $this->TituloCabecera(20,"Fecha Can.");
        $this->TituloCabecera(30,"Detalle");
    }
}

$pdf=new PDF("L","mm","letter");
$pdf->Addpage();



$datos=array();
$i=0;
$tt=0;
$ta=0;
$ts=0;
foreach($credito as $c){
    $i++;
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$c['codproveedor']);
    $pro=array_shift($pro);
    $usus=$usuario->mostrarTodoRegistro("CodUsuario=".$c['codusuariorecepcion']);
    $usus=array_shift($usus);
    
    $datos[$i]['codcreditopagar']=$c['codcreditopagar'];
    $datos[$i]['nombre']=$pro['nombre'];

    
    $datos[$i]['nombrerecepcion']=$usus['Paterno']." ".$usus['Materno']." ".$usus['Nombres'];
    $datos[$i]['nfactura']=$c['nfactura'];
    $datos[$i]['estado']=$c['estado'];
    $datos[$i]['total']=$c['total'];
    $datos[$i]['adelanto']=$c['adelanto'];
     $datos[$i]['saldo']=$c['saldo'];
    
     $datos[$i]['fecharecepcion']=$c['fecharecepcion'];
    $datos[$i]['fechacancelacion']=$c['fechacancelacion'];
    $datos[$i]['detalle']=$c['detalle'];
    
    $pdf->CuadroCuerpo(8 ,$i,0,"R");
    $pdf->CuadroCuerpo(30,$pro['nombre']);
    $pdf->CuadroCuerpo(50,$usus['Paterno']." ".$usus['Materno']." ".$usus['Nombres']);
    $pdf->CuadroCuerpo(20,$c['nfactura'],0,"R");
    $pdf->CuadroCuerpo(20,$c['estado']);
    $pdf->CuadroCuerpo(20,number_format($c['total'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,number_format($c['adelanto'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,number_format($c['saldo'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,$c['fecharecepcion']);
    $pdf->CuadroCuerpo(20,$c['fechacancelacion']);

    $pdf->CuadroCuerpo(30,$c['detalle']);
    $pdf->ln();
    $tt+=$c['total'];
    $ta+=$c['adelanto'];
    $ts+=$c['saldo'];
}
$pdf->CuadroCuerpo(128,"TOTAL",1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($tt,2,".",""),1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($ta,2,".",""),1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($ts,2,".",""),1,"R",1,9,"B");
//listadotabla(array("nombre"=>"Nombre Proveedor","nombrerecepcion"=>"Recepción","nfactura"=>"N Factura","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fecharecepcion"=>"Fecha Rec.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle"),$datos,1,"","modificar.php","eliminar.php");
$pdf->Output();
?>