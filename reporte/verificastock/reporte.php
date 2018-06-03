<?php
include_once("../../login/check.php");
extract($_GET);
include_once("../../class/material.php");
$material=new material;
$mat=$material->mostrarTodoRegistro("codproveedor LIKE '$codproveedor' and nombre LIKE '$nombre%' and codigo LIKE '$codigo%' and codtipo LIKE '$codtipo' and codsubtipo LIKE '$codsubtipo' and procedencia LIKE '$procedencia%'",1,"nombre");


include_once("../../class/proveedor.php");
$proveedor=new proveedor;


include_once("../../class/unidad.php");
$unidad=new unidad;


include_once("../../class/tipo.php");
$tipo=new tipo;


include_once("../../class/subtipo.php");
$subtipo=new subtipo;

include_once("../../class/ingreso.php");
$ingreso=new ingreso;

include_once("../../class/salida.php");
$salida=new salida;

include_once("../../class/almacen.php");
$almacen=new almacen;


$al=$almacen->mostrarRegistro($codalmacen);
$al=array_shift($al);
if($codalmacen=="%"){
    $nombrealmacen="Todos";
}else{
    $nombrealmacen=$al['nombre'];
}

include_once("../../impresion/pdf.php");
$titulo="Reporte de Stock de Materiales";
class PDF extends PPDF{
    function Cabecera(){
        global $nombrealmacen;
        // "nombre"=>"Nombre","marca"=>"Marca","unidad"=>"Unidad","codigo"=>"Codigo","proveedor"=>"Proveedor","tipo"=>"Tipo","subtipo"=>"SubTipo","stockminimo"=>"StockMin","costocompra"=>"C. Compra","precioventa"=>"P. Venta","procedencia"=>"Proce"
        $this->CuadroCabecera(20,"Almacén",10,$nombrealmacen);
        $this->ln();
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(85,"Nombre");
        $this->TituloCabecera(25,"Marca");
        $this->TituloCabecera(20,"Unidad");
        $this->TituloCabecera(15,"Codigo");
        $this->TituloCabecera(30,"Proveedor");
        $this->TituloCabecera(20,"Tipo");
        $this->TituloCabecera(20,"SubTipo");
        $this->TituloCabecera(20,"StockMin");
        $this->TituloCabecera(20,"StockActual");
        $this->TituloCabecera(20,"C. Compra");
        $this->TituloCabecera(20,"P. Venta");
        $this->TituloCabecera(20,"Procedencia");
        
    }
}

$pdf=new PDF("L","mm","legal");
$pdf->Addpage();

$i=0;
$tot=0;
foreach($mat as $m){
    
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$m['codproveedor'],1,"nombre");
    $p=array_shift($pro);
    $uni=$unidad->mostrarTodoRegistro("codunidad=".$m['codunidad'],1,"nombre");
    $u=array_shift($uni);
    $tip=$tipo->mostrarTodoRegistro("codtipo=".$m['codtipo'],1,"nombre");
    $t=array_shift($tip);
    $stipo=$subtipo->mostrarTodoRegistro("codsubtipo=".$m['codsubtipo'],1,"nombre");
    $st=array_shift($stipo);
    
    $i++;
    $datos[$i]['codmaterial']=$m['codmaterial'];
    $datos[$i]['proveedor']=$p['nombre'];
    $datos[$i]['nombre']=$m['nombre'];
    $datos[$i]['marca']=$m['marca'];
    $datos[$i]['unidad']=$u['nombre'];
    $datos[$i]['codigo']=$m['codigo'];
    $datos[$i]['tipo']=$t['nombre'];
    $datos[$i]['subtipo']=$st['nombre'];
    $datos[$i]['stockminimo']=$m['stockminimo'];
    $datos[$i]['costocompra']=$m['costocompra'];
    $datos[$i]['precioventa']=$m['precioventa'];
    $datos[$i]['procedencia']=$m['procedencia'];
    
    
    
    
    $ing=$ingreso->cantidadIngresos($m['codmaterial'],$codalmacen);
    $ing=array_shift($ing);


    $sal=$salida->cantidadSalidas($m['codmaterial'],$codalmacen);
    $sal=array_shift($sal);


    $stock=$ing['IngresoTotal']-$sal['SalidaTotal'];
    
    $pdf->CuadroCuerpo(8 ,$i,0,"R");
    $pdf->CuadroCuerpo(85,$m['nombre']);
    $pdf->CuadroCuerpo(25,$m['marca'],0,"",0,"7");
    $pdf->CuadroCuerpo(20,$u['nombre']);
    $pdf->CuadroCuerpo(15,$m['codigo']);
    $pdf->CuadroCuerpo(30,$p['nombre']);
    $pdf->CuadroCuerpo(20,$t['nombre']);
    $pdf->CuadroCuerpo(20,$st['nombre']);
    $pdf->CuadroCuerpo(20,$m['stockminimo'],0,"R",1,12,"B");
    $pdf->CuadroCuerpo(20,$stock,$stock<=$m['stockminimo']?1:0,"R",1,12,"B");
    $pdf->CuadroCuerpo(20,$m['costocompra'],0,"R");
    $pdf->CuadroCuerpo(20,$m['precioventa'],0,"R");
    $pdf->CuadroCuerpo(20,$m['procedencia']);
    $pdf->ln();
    $tot=$tot+$stock;
}
$pdf->CuadroCuerpo(213,"TOTAL",1,"R",1,12,"B");
$pdf->CuadroCuerpo(20,$tot,1,"R",1,12,"B");


$pdf->Output();
?>