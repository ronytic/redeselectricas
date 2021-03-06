<?php
include_once("../../login/check.php");
extract($_GET);
//print_r($_GET);
if($fechaSalidaDesde!=""){


    $fecha="fecharegistro BETWEEN '$fechaSalidaDesde' and '$fechaSalidaHasta'";
}else{

    $fecha="fecharegistro LIKE '%'";
}

include_once("../../class/salida.php");
$salida=new salida;
$sal=$salida->mostrarTodoRegistro("codproveedor LIKE '$codproveedor' and codtipo LIKE '$codtipo' and codsubtipo LIKE '$codsubtipo' and codmaterial LIKE '$codmaterial' and codalmacen LIKE '$codalmacen' and $fecha",1,"");


include_once("../../class/proveedor.php");
$proveedor=new proveedor;


include_once("../../class/unidad.php");
$unidad=new unidad;


include_once("../../class/tipo.php");
$tipo=new tipo;


include_once("../../class/subtipo.php");
$subtipo=new subtipo;

include_once("../../class/material.php");
$material=new material;

include_once("../../class/almacen.php");
$almacen=new almacen;

include_once("../../class/cliente.php");
$cliente=new cliente;

include_once("../../impresion/pdf.php");
$titulo="Reporte de Salidas de Material";
class PDF extends PPDF{
    function Cabecera(){
        array("almacen"=>"Almacén","nombre"=>"Nombre","marca"=>"Marca","unidad"=>"Unidad","codigo"=>"Codigo","proveedor"=>"Proveedor","tipo"=>"Tipo","subtipo"=>"SubTipo","stockanterior"=>"StockAnt","cantidad"=>"Cant. ","stockfin"=>"StockFin","fechaIng"=>"FechaIngreso","tipoing"=>"TipoIng","cliente"=>"Cliente","detalle"=>"Detalle");
        $this->TituloCabecera(8,"N");
        $this->TituloCabecera(10,"Almac",8);
        $this->TituloCabecera(60,"Nombre");
        $this->TituloCabecera(20,"Marca");
        $this->TituloCabecera(15,"Cod.");
        $this->TituloCabecera(40,"Proveedor");
        $this->TituloCabecera(20,"Tipo");
        $this->TituloCabecera(20,"SubTipo");
        $this->TituloCabecera(15,"StockAnt");
        $this->TituloCabecera(15,"Cant.");
        $this->TituloCabecera(15,"StockFin");
        $this->TituloCabecera(20,"FechaSal");
        $this->TituloCabecera(15,"TipoSal");
        $this->TituloCabecera(35,"Cliente");
        $this->TituloCabecera(20,"Detalle");
    }
}

$pdf=new PDF("L","mm","legal");
$pdf->Addpage();

$i=0;
$total=0;
foreach($sal as $in){

    $m=$material->mostrarTodoRegistro("codmaterial=".$in['codmaterial'],1,"nombre");
    $m=array_shift($m);
    $pro=$proveedor->mostrarTodoRegistro("codproveedor=".$in['codproveedor'],1,"nombre");
    $p=array_shift($pro);
    $uni=$unidad->mostrarTodoRegistro("codunidad=".$m['codunidad'],1,"nombre");
    $u=array_shift($uni);
    $tip=$tipo->mostrarTodoRegistro("codtipo=".$in['codtipo'],1,"nombre");
    $t=array_shift($tip);
    $stipo=$subtipo->mostrarTodoRegistro("codsubtipo=".$in['codsubtipo'],1,"nombre");
    $st=array_shift($stipo);
    $al=$almacen->mostrarTodoRegistro("codalmacen=".$in['codalmacen'],1,"nombre");
    $al=array_shift($al);

    $cli=$cliente->mostrarTodoRegistro("codcliente=".$in['codcliente'],1,"nombre");
    $cli=array_shift($cli);
    $i++;
    $datos[$i]['codsalida']=$in['codsalida'];

    $datos[$i]['proveedor']=$p['nombre'];
    $datos[$i]['nombre']=$m['nombre'];
    $datos[$i]['marca']=$m['marca'];
    $datos[$i]['unidad']=$u['nombre'];
    $datos[$i]['codigo']=$m['codigo'];
    $datos[$i]['tipo']=$t['nombre'];
    $datos[$i]['subtipo']=$st['nombre'];
    $datos[$i]['stockanterior']=$in['stock'];
    $datos[$i]['cantidad']=$in['cantidad'];
    $datos[$i]['stockfin']=$in['stockfinal'];

    $datos[$i]['tipoing']=$in['tipo'];
    $datos[$i]['cliente']=$cli['nombre'];

    $datos[$i]['almacen']=$al['nombre'];
    $datos[$i]['fechaIng']=$in['fecharegistro'];
    $datos[$i]['detalle']=$in['detalle'];
    $total=$total+$in['cantidad'];
    $pdf->CuadroCuerpo(8 ,$i,0,"R");
    $pdf->CuadroCuerpo(10,$al['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(60,$m['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(20,$m['marca'],0,"",0,7);
    $pdf->CuadroCuerpo(15,$m['codigo'],0,"",0,7);
    $pdf->CuadroCuerpo(40,$p['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(20,$t['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(20,$t['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(15,$in['stock'],0,"R");
    $pdf->CuadroCuerpo(15,$in['cantidad'],0,"R");
    $pdf->CuadroCuerpo(15,$in['stockfinal'],0,"R");
    $pdf->CuadroCuerpo(20,$in['fecharegistro'],0,"",0,7);
    $pdf->CuadroCuerpo(15,$in['tipo'],0,"",0,7);
    $pdf->CuadroCuerpo(35,$cli['nombre'],0,"",0,7);
    $pdf->CuadroCuerpo(20,$in['detalle'],0,"",0,7);
    $pdf->ln();
}
$i++;
$datos[$i]['codingreso']=0;
$datos[$i]['stockanterior']="Total";
$datos[$i]['cantidad']=$total;
//listadotabla(array("almacen"=>"Almacén","nombre"=>"Nombre","marca"=>"Marca","unidad"=>"Unidad","codigo"=>"Codigo","proveedor"=>"Proveedor","tipo"=>"Tipo","subtipo"=>"SubTipo","stockanterior"=>"StockAnt","cantidad"=>"Cant. ","stockfin"=>"StockFin","fechaIng"=>"FechaIngreso","tipoing"=>"TipoIng","cliente"=>"Cliente","detalle"=>"Detalle"),$datos,0,"","","");
$pdf->Output();
?>