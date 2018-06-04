<?php
include_once("../../login/check.php");

$a=array();
foreach($_POST as $k=>$v){
    array_push($a,"$k=$v");
}
$url2="reporte.php?".implode("&",$a);
//print_r($_POST);


//echo "<br>".$url;
//echo "<br>".$url2;
?>
<iframe src="<?=$url2;?>" width="100%" height="600" frameborder="0"></iframe>