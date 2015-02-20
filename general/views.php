<?php
	class vista{
		function __construct(){
		}
		public static function index($arr = null){
			$valores = [
			'Title' => ":: [Aprotec] - Inicio ::",
			'header' => load_page("general/static/header.html"),
			'slider' => dinamic("general/static/slider.html",$arr['slider']),
			'barra-lateral' => load_page("general/static/lateral.html"),
			'form-log' => dinamic("general/static/login.html"),
			'container' => dinamic("general/static/news.html",$arr['noticias']),
			'footer' => load_page("general/static/footer.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public static function page($html, $titulo ,$arr = null){
			$valores = [
			'Title' => ":: [Aprotec] - ".$titulo." ::",
			'header' => load_page("general/static/header.html"),
			'slider' => null,
			'barra-lateral' => load_page("general/static/lateral.html"),
			'form-log' => dinamic("general/static/login.html"),
			'container' => dinamic("general/static/".$html,$arr),
			'footer' => load_page("general/static/footer.html"),
			'ttitle'=> $titulo,
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>