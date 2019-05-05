<?php
include_once("../../login/check.php");
extract($_GET);



include_once("../../class/material.php");
$material=new material;
$mat=$material->mostrarTodoRegistro("codmaterial=$codmaterial");
$mat=array_shift($mat);


include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$pro=$proveedor->mostrarTodoRegistro("codproveedor=$codproveedor");
$pro=array_shift($pro);

include_once("../../class/almacen.php");
$almacen=new almacen;
$al=$almacen->mostrarRegistro($codalmacen);
$al=array_shift($al);


include_once("../../class/unidad.php");
$unidad=new unidad;
$u=$unidad->mostrarRegistro($mat['codunidad']);
$u=array_shift($u);

include_once("../../class/tipo.php");
$tipo=new tipo;
$t=$tipo->mostrarRegistro($mat['codtipo']);
$t=array_shift($t);

include_once("../../class/subtipo.php");
$subtipo=new subtipo;
$st=$subtipo->mostrarRegistro($mat['codsubtipo']);
$st=array_shift($st);

include_once("../../class/kardex.php");
$kardex=new kardex;
$kar=$kardex->mostrarTodoRegistro("codalmacen=$codalmacen and codmaterial=$codmaterial and fecharegistro<='$fechaHasta'",1,"FechaRegistro,HoraRegistro");



include_once("../../impresion/pdf.php");
$titulo="Kardex de Material";
class PDF extends PPDF{
    function Cabecera(){
        global $mat,$pro,$u,$t,$st,$al;
        $this->CuadroCabecera(20,"Almacén:",30,$al['nombre']);
        $this->ln();
        $this->CuadroCabecera(20,"Proveedor:",30,$pro['nombre']);
        $this->CuadroCabecera(20,"Material:",80,$mat['nombre']);
        $this->CuadroCabecera(20,"Código:",30,$mat['codigo']);
        $this->ln();
        $this->CuadroCabecera(20,"Unidad:",20,$u['nombre']);
        $this->CuadroCabecera(20,"Tipo:",30,$t['nombre']);
        $this->CuadroCabecera(20,"SubTipo:",30,$st['nombre']);
        $this->CuadroCabecera(25,"Procedencia:",30,$mat['procedencia']);
        $this->ln();
        $this->TituloCabecera(8,"");
        $this->TituloCabecera(85,"INGRESO");
        $this->TituloCabecera(93,"SALIDA");
        $this->ln();
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(25,"Fecha");
        $this->TituloCabecera(20,"Cantidad");
        $this->TituloCabecera(20,"Precio");
        $this->TituloCabecera(20,"Total");

        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(25,"Fecha");
        $this->TituloCabecera(20,"Cantidad");
        $this->TituloCabecera(20,"Precio");
        $this->TituloCabecera(20,"Total");

    }
}

$pdf=new PDF("P","mm","letter");
$pdf->Addpage();

$ci=0;
$pi=0;
$ti=0;

$cs=0;
$ps=0;
$ts=0;

$i=0;
$tti=0;
$tts=0;
foreach($kar as $k){
    $i++;
    if($k['tipo']=="ingreso"){
        $tti++;

        $pdf->CuadroCuerpo(8 ,$i,0,"R",1);
        $pdf->CuadroCuerpo(25,$k['fecharegistro']." ".$k['horaregistro'],0,"R",1,7);
        $pdf->CuadroCuerpo(20,$k['cantidad'],0,"R",1,"9");
        $pdf->CuadroCuerpo(20,$k['precio'],0,"R",1,"9");
        $pdf->CuadroCuerpo(20,$k['total'],0,"R",1,"9");

        $ci+=$k['cantidad'];
        $pi+=$k['precio'];
        $ti+=$k['total'];
    }elseif($k['tipo']=="salida"){
        $tts++;

        $pdf->CuadroCuerpo(93,"",0,"",0,"9");
        $pdf->CuadroCuerpo(8 ,$i,0,"R",1);
        $pdf->CuadroCuerpo(25,$k['fecharegistro']." ".$k['horaregistro'],0,"R",1,7);
        $pdf->CuadroCuerpo(20,$k['cantidad'],0,"R",1,"9");
        $pdf->CuadroCuerpo(20,$k['precio'],0,"R",1,"9");
        $pdf->CuadroCuerpo(20,$k['total'],0,"R",1,"9");

        $cs+=$k['cantidad'];
        $ps+=$k['precio'];
        $ts+=$k['total'];
    }
    $pdf->ln();




}
$pdf->CuadroCuerpo(8 ,"Total",1,"R",1,7,"B");
$pdf->CuadroCuerpo(25,$tti,1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,$ci,1,"R",1,"9","B");
$pdf->CuadroCuerpo(20,$pi,1,"R",1,"9","B");
$pdf->CuadroCuerpo(20,$ti,1,"R",1,"9","B");


$pdf->CuadroCuerpo(8 ,"Total",1,"R",1,7,"B");
$pdf->CuadroCuerpo(25,$tts,1,"R",1,9,"B");
$pdf->CuadroCuerpo(20,$cs,1,"R",1,"9","B");
$pdf->CuadroCuerpo(20,$ps,1,"R",1,"9","B");
$pdf->CuadroCuerpo(20,$ts,1,"R",1,"9","B");

$pdf->ln(15);
$pdf->CuadroCuerpo(63 ,"",0,"R",0,9,"B");
$pdf->CuadroCuerpo(30 ,"STOCK FINAL",1,"R",1,9,"B");
$pdf->CuadroCuerpo(30 ,$ci-$cs,1,"R",1,9,"B");
$pdf->Output();
?>