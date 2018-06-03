<?php
include_once("../../login/check.php");
$folder="../../";
$titulo="Cotización";
$codcotizacion=$_GET['Cod'];
include_once("../../class/cotizacion.php");
$cotizacion=new cotizacion;
include_once("../../class/cotizaciondetalle.php");
$cotizaciondetalle=new cotizaciondetalle;
include_once("../../class/cliente.php");
$cliente=new cliente;
include_once("../../class/almacen.php");
$almacen=new almacen;
include_once("../../class/material.php");
$material=new material;
include_once("../../class/usuario.php");
$usuario=new usuario;

$cot=$cotizacion->mostrarRegistro($codcotizacion);
$cot=array_shift($cot);


$cli=$cliente->mostrarRegistro($cot['codcliente']);
$cli=array_shift($cli);
//print_r($cli);


$al=$almacen->mostrarRegistro($cot['codalmacen']);
$al=array_shift($al);

$us=$usuario->mostrarRegistro($cot['codusuario']);
$us=array_shift($us);

$cotd=$cotizaciondetalle->mostrarTodoRegistro("codcotizacion=".$cot['codcotizacion']);
include_once("../../impresion/pdf.php");
class PDF extends PPDF{
    function Cabecera(){
        
        global $cli,$al,$cot;
        
        $this->CuadroCabecera(20,"Cliente:",40,$cli['nombre']);
        $this->CuadroCabecera(20,"Teléfono:",40,$cli['telefonos']);
        $this->CuadroCabecera(20,"Nit:",40,$cli['nit']);
        $this->ln();
        $this->CuadroCabecera(20,"Cotización:",40,$cot['codcotizacion']);
        $this->CuadroCabecera(10,"Fecha:",40,$cot['fecha']);
        $this->CuadroCabecera(20,"Almacen:",30,$al['nombre']);
        $this->ln();
        $this->CuadroCabecera(20,"Credito:",40,$cot['credito']);
        $this->CuadroCabecera(20,"Tipo:",20,$cot['tipo']);
        $this->ln();
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(15,"Codigo");
        $this->TituloCabecera(70,"Nombre");
        $this->TituloCabecera(15,"Marca");
        $this->TituloCabecera(15,"Proc");
        $this->TituloCabecera(10,"Cant");
        $this->TituloCabecera(15,"UM");
        $this->TituloCabecera(20,"Precio");
        $this->TituloCabecera(20,"Total");
    }
}
$pdf=new PDF("P","mm","letter");
$pdf->Addpage();

//print_r($cotd);
$i=0;
foreach($cotd as $cd){
    $mat=$material->mostrarRegistro($cd['codmaterial']);
    $mat=array_shift($mat);
    $i++;
    $pdf->CuadroCuerpo(8,"$i",0,0,1);
    $pdf->CuadroCuerpo(15,$mat['codigo'],0,"L",1,7);
    $pdf->CuadroCuerpo(70,$mat['nombre'],0,"L",1,7);
    $pdf->CuadroCuerpo(15,$mat['marca'],0,"L",1,7);
    $pdf->CuadroCuerpo(15,$mat['procedencia'],0,"L",1,7);
    $pdf->CuadroCuerpo(10,$cd['cantidad'],0,0,1);
    $pdf->CuadroCuerpo(15,$cd['unidad'],0,0,1,7);
    $pdf->CuadroCuerpo(20,number_format($cd['precio'],2),0,0,1);
    $pdf->CuadroCuerpo(20,number_format($cd['total'],2,".",""),0,0,1);
    $pdf->ln();
}
$pdf->CuadroCuerpo(133,"Son:".num2letras(number_format($cot['subtotal'],2,".","")),0,"L",1,9,"B");
$pdf->CuadroCuerpo(35,"Subtotal:",0,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($cot['subtotal'],2,".",""),0,"R",1,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(133,"",0,"L",0,9,"B");
$pdf->CuadroCuerpo(35,"Descuento:",0,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($cot['descuento'],2,".",""),0,"R",1,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(133,"",0,"L",0,9,"B");
$pdf->CuadroCuerpo(35,"Total:",0,"R",1,9,"B");
$pdf->CuadroCuerpo(20,number_format($cot['totalgeneral'],2,".",""),0,"R",1,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(25,"Detalle:",0,"",0,9,"B");
$pdf->CuadroCuerpoMulti(115,$cot['detalle'],0,"",0,9,"");
$pdf->ln();

$pdf->CuadroCuerpo(25,"Responsable y Consulta",0,"",0,9,"B");
$pdf->ln();
$pdf->CuadroCuerpo(25,"Nombre:",0,"",0,9,"B");
$pdf->CuadroCuerpo(25,$us['Paterno']." ".$us['Materno']." ".$us['Nombres'],0,"",0,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(25,"Cargo:",0,"",0,9,"B");
$pdf->CuadroCuerpo(25,$us['Cargo'],0,"",0,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(25,"Teléfono:",0,"",0,9,"B");
$pdf->CuadroCuerpo(25,$us['Telefono'],0,"",0,9,"");
$pdf->ln();
$pdf->CuadroCuerpo(30,"Fecha de Validez:",0,"",0,9,"B");
$pdf->CuadroCuerpo(25,"10 Dias",0,"",0,9,"");





$pdf->ln(30);
$pdf->CuadroCuerpo(20,"",0,"C","0",9,"");
$pdf->CuadroCuerpo(50,"Firma del Responsable",0,"C","T",9,"");
$pdf->CuadroCuerpo(40,"",0,"C","0",9,"");
$pdf->CuadroCuerpo(50,"Firma del Cliente",0,"C","T",9,"");
$pdf->Output();
?>