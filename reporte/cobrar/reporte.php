<?php
include_once("../../login/check.php");
extract($_GET);
include_once("../../class/creditocobrar.php");
$creditocobrar=new creditocobrar;
include_once("../../class/cliente.php");
$cliente=new cliente;
include_once("../../class/almacen.php");
$almacen=new almacen;


if($fechacancelaciondesde!=""){
    

    $fecha="fechacancelacion BETWEEN '$fechacancelaciondesde' and '$fechacancelacionhasta'";
}else{
    
    $fecha="fechacancelacion LIKE '%'";
}


$credito=$creditocobrar->mostrarTodoRegistro("codcliente IN(SELECT codcliente FROM cliente WHERE nombre LIKE '$nombre%') and codalmacen LIKE '$codalmacen' and estado LIKE '$estado' and $fecha",1,"fechacancelacion");


include_once("../../impresion/pdf.php");
$titulo="Reporte de Cuentas por Cobrar";
class PDF extends PPDF{
    function Cabecera(){
        array("nombre"=>"Nombre Cliente","nombrealmacen"=>"Almacen","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fechaentrega"=>"Fecha Ent.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle");
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(30,"Nombre Cliente");
        $this->TituloCabecera(40,"Almacen");
        $this->TituloCabecera(20,"Estado");
        $this->TituloCabecera(20,"Total");
        $this->TituloCabecera(20,"Adelanto");
        $this->TituloCabecera(20,"Saldo");
        $this->TituloCabecera(20,"Fecha Ent.");
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
    $cli=$cliente->mostrarTodoRegistro("codcliente=".$c['codcliente']);
    $cli=array_shift($cli);
    $al=$almacen->mostrarTodoRegistro("codalmacen=".$c['codalmacen']);
    $al=array_shift($al);
    
    $datos[$i]['codcreditocobrar']=$c['codcreditocobrar'];
    $datos[$i]['nombre']=$cli['nombre'];
    $datos[$i]['telefonos']=$cli['telefonos'];
    
    $datos[$i]['nombrealmacen']=$al['nombre'];
    
    $datos[$i]['estado']=$c['estado'];
    $datos[$i]['total']=$c['total'];
    $datos[$i]['adelanto']=$c['adelanto'];
     $datos[$i]['saldo']=$c['saldo'];
    
     $datos[$i]['fechacancelacion']=$c['fechacancelacion'];
    $datos[$i]['fechaentrega']=$c['fechaentrega'];
    $datos[$i]['detalle']=$c['detalle'];
    
    $pdf->CuadroCuerpo(8 ,$i,0,"R");
    $pdf->CuadroCuerpo(30,$cli['nombre']);
    $pdf->CuadroCuerpo(40,$al['nombre']);
    $pdf->CuadroCuerpo(20,$c['estado']);
    $pdf->CuadroCuerpo(20,number_format($c['total'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,number_format($c['adelanto'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,number_format($c['saldo'],2,".",""),0,"R");
    $pdf->CuadroCuerpo(20,$c['fechaentrega']);
    $pdf->CuadroCuerpo(20,$c['fechacancelacion']);

    $pdf->CuadroCuerpo(30,$c['detalle']);
    $pdf->ln();
    $tt+=$c['total'];
    $ta+=$c['adelanto'];
    $ts+=$c['saldo'];
}
$pdf->CuadroCuerpo(98,"TOTAL",1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($tt,2,".",""),1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($ta,2,".",""),1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($ts,2,".",""),1,"R",1,9,"B");
//listadotabla(array("nombre"=>"Nombre Cliente","nombrealmacen"=>"Almacen","estado"=>"Estado","total"=>"Total","adelanto"=>"Adelanto","saldo"=>"Saldo","fechaentrega"=>"Fecha Ent.","fechacancelacion"=>"Fecha Can.","detalle"=>"Detalle"),$datos,1,"","modificar.php","eliminar.php");
$pdf->Output();
?>