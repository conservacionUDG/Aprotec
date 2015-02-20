<?php
	session_start();
	$url_array;
	$conf_host;
	function URL_short(){
		$url = $_SERVER['PATH_INFO'];
	    	return $url;
	}
	function login_app($app){
		foreach ($app as $key => $value) {
			require_once( $value."/model.php");
			require_once( $value."/views.php");
			require_once( $value."/controller.php");
		}
	}
	function conf($tem){
		global $conf_host;
		foreach ($conf_host as $key => $value) {
			$tem = str_replace('{['.$key.']}',$value,$tem);
		}
		return $tem;
	}
    function lang($tem){
    	$str_datos = file_get_contents("main/templates/languages/es_MX.json");
    	$lang = json_decode($str_datos,true);
		foreach($lang as $clave => $valor ){
				$tem = str_replace('['.$clave.']',$valor,$tem);
			}	
		return conf($tem);
	}
	function load_page($page){
		return file_get_contents($page);
	}
	function dinamic($page,$arr = null){
		ob_start();
		require_once ($page);
		$sections = ob_get_clean();
		return $sections;
	}
	function render_to_response($string){
		echo $string;
	}
	function HttpResponse($string){
		global $conf_host;
		header("Location: ".$conf_host['host'].$string);
	}
	function JsonResponse($arr){
		header('Content-Type: text/txt; charset=ISO-8859-1');
		echo json_encode($arr);
	}
	function remplas($array,$tem){
		foreach($array as $clave => $valor ){
				$tem = str_replace('{'.$clave.'}',$valor,$tem);
			}	
		return lang($tem);
	}
	require_once 'main/settings.php';
?>