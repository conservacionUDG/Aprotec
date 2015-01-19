<?php
	class principal{
		var $data;
		function __construct(){
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
			$post['noticias'] = $this->data->noticias();
			$post['slider'] = $this->data->slider();
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
			global $url_array;
			if ($_SESSION['user']) {
				if ($_POST){
					switch ($url_array[2]) {
						case 'password':
							if ($_POST['password'] == $_POST['password2']) {
								$can = $this->data->verifica2($_POST['oldPassword'],$_SESSION['user']);
								if ($can[0] == 1) {
									$this->data->acpassword($_POST['password'],$_SESSION['id']);
								}else{
									echo "Error";
								}
							}else{
								echo "Error";
							}
						break;
						case 'Sociales':
							$this->data->acredes($_POST, $_SESSION['id']);
						break;
						case 'dgeneral':
							$this->data->acgeneral($_POST, $_SESSION['id']);
						break;
						
						default:
							return HttpResponse('index.php/miperfil/');
							break;
					}
					return HttpResponse('index.php/miperfil/');
				}else{
					$dato = $this->data->perfil($_SESSION['id']);
					if ($dato != '') {
						return render_to_response(vista::page('miperfil.html',"Mi perfil",$dato));
					}else{
						$this->data->inserPerfil($_SESSION['id']);
						return HttpResponse('index.php/miperfil/');
					}	
				}
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
			global $url_array;
			if ($_SESSION['user']) {
				if ($url_array[2]) {
					$dato = $this->data->job($url_array[2]);
					if ($dato != '') {
						return render_to_response(vista::page('job.html',$dato['titulo_job'],$dato));
					}else{
						return render_to_response(vista::page('404.html','Error 404'));
					}
				}else{
					$dato = $this->data->jobs();
					return render_to_response(vista::page('jobs.html',"Empleos",$dato));
				}
			}else{
				return render_to_response(vista::page('login2.html','Empleos'));
			}
		}
		public function reg_oferta(){
			if ($_SESSION['user']) {
				if ($_SESSION['estado'] == 3) {
					if ($_POST) {
						$this->data->guardar_job($_POST);
						return render_to_response(vista::page('save_job.html','[save_job]'));
					}else{
						return render_to_response(vista::page('reg-job.html','[reg-of]'));
					}
				}else{
					return render_to_response(vista::page('notpage.html','Esta paguina no es para ti.'));
				}
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
					$_SESSION['estado'] = $consu['estado_user'];
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
					return render_to_response(vista::page('new.html',utf8_encode ($post['titulo_post']),$post));
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
		public function recursos(){
			if ($_SESSION['user']) {
				if ($_SESSION['estado'] == 1) {
					$datos = $this->data->rec(2);
					return render_to_response(vista::page('recursos.html','Recursos disponibles',$datos));
				}else{
					$datos = $this->data->rec(3);
					return render_to_response(vista::page('recursos.html','Recursos disponibles',$datos));
				}
			}else{
				$datos = $this->data->rec(1);
				return render_to_response(vista::page('recursos.html','Recursos disponibles',$datos));
			}
		}
	}
?>