<?php
session_start();
//header("Content-Type: text/html;charset=utf-8");
if(!empty($_POST)){

/*	require_once('php-local-browscap.php');
	$navegador=get_browser_local(null,true,"lite_php_browscap.ini",true);
	print_r($navegador);*/

	include_once("../configuracion.php");
	include_once("../class/usuario.php");
	/*include_once("../class/alumno.php");
	include_once("../class/docente.php");*/
	include_once("../class/logusuario.php");
	$usu=new usuario;
	/*$alumno=new alumno;
	$docente=new docente;*/
	$logusuario=new logusuario;

	$url=$_POST['u'];
	if(empty($directory) || $directory==""){
		$u=$url;
		$direccion="..".$u;
	}else{
		$u=explode($directory,$_POST['u']);
		$direccion="../".$u[1];
	}


	if(isset($_POST['usuario'],$_POST['pass']) && $_POST['usuario']!="" && $_POST['pass']!=""){

		$usuario=($_POST['usuario']);
		$pass=$_POST['pass'];

//		$usuario=str_replace("ñ","n",$usuario);
		$usuarioAl=str_replace(array("ñ","Ñ"),array("n","N"),$usuario);
		$usuarioAl=strtolower($usuarioAl);
	//	echo $usuarioAl;

		$agente=$_SERVER['HTTP_USER_AGENT'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$lenguaje=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
		$referencia= $_SERVER['HTTP_REFERER'];
		$fecha=date("Y-m-d");
		$hora=date("H:i:s");

		if(preg_match('/^[a-z]*[a-z]$/',$usuario)){
			//Administrador 1 2 3 4
			$reg=$usu->loginUsuarios($usuario,$pass);
			$reg=array_shift($reg);
			$sw=1;
		}else{
			//echo $sql;
			header("Location:./?u=".$url.'&error=1');
		}
		//echo $Nivel;
		/**/

		//$res=mysql_query($sql);
		//@$reg=mysql_fetch_array($res);
		$codUsuario=$reg['CodUsuario'];

		if($sw){
			$Nivel=$reg['Nivel'];
		}

		if($reg['Can']==1){
			$valuesLog=array(
				"CodUsuario"=>$codUsuario,
				"Nivel"=>$Nivel,
				"Url"=>"'$url'",
				"FechaLog"=>"'$fecha'",
				"HoraLog"=>"'$hora'",
				"Agente"=>"'$agente'",
				"Ip"=>"'$ip'",
				"Referencia"=>"'$referencia'",
				"Lenguaje"=>"'$lenguaje'"
			);
            //echo "asd";
			$logusuario->insertarRegistro($valuesLog,0);
			$_SESSION['CodUsuarioLog']=$codUsuario;
			$_SESSION['LoginSistemaRedes']=1;
			$_SESSION['Nivel']=$Nivel;
            $_SESSION['Pass']=md5($pass);
			header("Location:".$direccion);
		}
		else{
			header("Location:./?u=".$url.'&error=1');
		}
	}else{
		header("Location:./?u=".$url.'&incompleto=1');
	}
}
?>
