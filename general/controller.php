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
				return $url_array[1];
			}elseif ($url_array[2]) {
				return $url_array[1];
			}else{
				return '404';
			}
		}
		public function index(){
			$post = $this->data->noticias();
			return render_to_response(vista::index($post));
		}
		public function page($html,$titulo){
			return render_to_response(vista::page($html,$titulo));
		}
		public function contactanos(){
			if ($_POST) {
				$this->data->guardarmsn($_POST);
				return render_to_response(vista::page('msn_gracias.html','Gracias por ponerte en contacto'));
			}else{
				return render_to_response(vista::page('contactanos.html','Contactanos'));
			}
		}
		public function miperfil(){
			if ($_SESSION['user']) {
			}else{
				return render_to_response(vista::page('login2.html','Mi perfil'));
			}
		}
		public function eventos(){
			global $url_array;
			if ($_SESSION['user']) {
				if ($url_array[2]) {
					$dat = $this->data->consult($url_array[2]);
					return render_to_response(vista::page('evento.html',$dat['name_evento'],$dat));
				}else{
					$datos = $this->data->eventos();
					return render_to_response(vista::page('eventos.html','Eventos',$datos));
				}
			}else{
				return render_to_response(vista::page('login2.html','Eventos'));
			}
		}
		public function jobs(){
			if ($_SESSION['user']) {
			}else{
				return render_to_response(vista::page('login2.html','Empleos'));
			}
		}
		public function reg_oferta(){
			if ($_SESSION['user']) {
			}else{
				return render_to_response(vista::page('login2.html','Registrar Oferta de trabajo'));
			}
		}
		public function log_in(){
			if ($_POST) {
				$consu = $this->data->login($_POST['user']);
				if ($consu['pw_user'] == $_POST['pw']) {
					$_SESSION['user'] = $consu['user_user'];
					$_SESSION['email'] = $consu['correos_user'];
					$_SESSION['id'] = $consu['id_user'];
					return HttpResponse ("index.php/");
				}else{
					$_SESSION['error'] = TRUE;
					return HttpResponse ("index.php/");
				}
			}else{
				return HttpResponse("index.php/");
			}
		}
		public function registrar(){
			if($_POST){
				$can = $this->data->verifica($_POST['User'],$_POST['email']);
				if ($can[0] == 0) {
					$this->data->new_user($_POST);
					$consu = $this->data->login($_POST['User']);
					$_SESSION['user'] = $consu['user_user'];
					$_SESSION['email'] = $consu['correos_user'];
					$_SESSION['id'] = $consu['id_user'];
					return HttpResponse('index.php/');
				}else{
					return render_to_response("Usuario o Correo ya Registrados");
				}
			}else{
				return render_to_response(vista::page('registrar.html','Registrar usuario'));
			}
		}
		public function news(){
			global $url_array;
			if ($url_array[2]) {
				$post = $this->data->nota($url_array[2]);
				if ($post != '') {
					return render_to_response(vista::page('new.html',$post['tiulo_post'],$post));
				}else{
					return render_to_response(vista::page('404.html','Error 404'));
				}
			}else{
				$post = $this->data->noticias();
				return render_to_response(vista::page('news.html','Noticias',$post));
			}
		}
		public function destroy(){
			global $url_array;
			if ($url_array[1] =="destroy"){
				session_destroy();
			}
			return HttpResponse("");
		}
		public function empresas_conf(){
			$i=0;
			$directorio = opendir("./main/templates/complementos/img/empresas/"); //ruta actual
			while ($archivo = readdir($directorio)){
				if ($archivo != '.' AND $archivo != '..') {
    				$dato[$i] = $archivo;
    				$i++;
				}
			}
			return render_to_response(vista::page('empresas-confian.html','Empresas que confian',$dato));		
		}
		public function recursos()
		{
			echo "Holas";
		}
	}
?>