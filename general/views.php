<?php
	class vista{
		function __construct(){
		}
		public function index()
		{
			$valores = [
			'Title' => "[Aprotec]",
			'header' => load_page("general/static/header.html"),
			'slider' => load_page("general/static/slider.html"),
			'barra-lateral' => load_page("general/static/lateral.html"),
			'container' => dinamic("general/static/index.html"),
			'footer' => load_page("general/static/footer.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public function page($html ,$arr= null)
		{
			$valores = [
			'Title' => "[Aprotec]",
			'header' => load_page("general/static/header.html"),
			'slider' => null,
			'barra-lateral' => load_page("general/static/lateral.html"),
			'container' => dinamic("general/static/".$html,$arr),
			'footer' => load_page("general/static/footer.html")
			];
			$templad = load_page("main/templates/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>