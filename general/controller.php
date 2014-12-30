<?php
	class principal{
		var $data;
		function __construct()
		{
			$this->data = new general();
		}

		public function url_p($url){
			global $url_array;

			$url_array = explode('/', $url);
			if ($url_array[0] == '' and !$url_array[1]) {
				return '/';
			}elseif(!$url_array[2]){
				return $url;
			}else{
				return '404';
			}
		}
		public function prueba(){
			$dat = $this->data->consul();
			return JsonResponse($dat);
		}
		public function index(){
			return render_to_response(vista::index());
		}
		public function page($html){
			return render_to_response(vista::page($html));
		}
	}
?>