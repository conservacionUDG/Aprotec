<?php
	class views_cmd{
		function __construct(){
		}
		public static function log($html){
			$valores = [
			'Title' => ":: [Aprotec] - CMD ::",
			'header' => FALSE,
			'container' => dinamic("cmd/static/".$html),
			'footer' => load_page("cmd/static/footer.html")
			];
			$templad = load_page("cmd/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
		public static function page($html,$arr = null){
			$valores = [
			'Title' => ":: [Aprotec] - CMD ::",
			'header' => load_page("cmd/static/header.html"),
			'container' => dinamic("cmd/static/".$html,$arr),
			'op' => load_page("cmd/static/op.html"),
			'op2' => load_page("cmd/static/op.html"),
			'footer' => load_page("cmd/static/footer.html")
			];
			$templad = load_page("cmd/principal.html");
			$mostrar = remplas($valores,$templad);
			return $mostrar;
		}
	}
?>