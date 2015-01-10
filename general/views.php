<?php
	class vista{
		function __construct(){
		}
		public function index()
		{
			$valores = [
			'Title' => ":: [Aprotec] - Inicio ::",
			'header' => load_page("general/static/header.html"),
			'slider' => load_page("general/static/slider.html"),
			'barra-lateral' => load_page("general/static/lateral.html"),
			'form-log' => load_page("general/static/login.html"),
			'container' => dinamic("general/static/index.html"),
			'footer' => load_page("general/static/footer.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function page($html, $titulo ,$arr= null)
		{
			$valores = [
			'Title' => ":: [Aprotec] - ".$titulo." ::",
			'header' => load_page("general/static/header.html"),
			'slider' => null,
			'barra-lateral' => load_page("general/static/lateral.html"),
			'form-log' => load_page("general/static/login.html"),
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