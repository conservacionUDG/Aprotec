<?php
	class cmd_controller{
		var $data;
		function __construct(){
			$this->data = new general_cmd();
		}
		public function index(){
			if($_SESSION['userCmd']){
				return render_to_response(views_cmd::page('index.html'));
			}else{
				if ($_POST) {
					print_r($_POST);
					$user = $this->data->login($_POST['user']);
					print_r($user);
					if ($_POST['pw'] == $user['pw_usercmd']) {
						$_SESSION['userCmd'] = $user['name_usercmd'];
						$_SESSION['id'] = $user['id_usercmd'];
					} else {
						return render_to_response('Error');
					}
					return HttpResponse('index.php/CMD');
				} else {
					return render_to_response(views_cmd::log('login.html'));
				}
			}
		}
		public function adnot(){
			return render_to_response(views_cmd::page('adnot.html'));
		}
		public function adeven(){
			return render_to_response(views_cmd::page('adeven.html'));
		}
		public function punot(){
			if ($_POST) {				
				$fecha = date("Y-m-d");
				$this->data->postSave($_POST,$_SESSION['id'],$fecha);
				return HttpResponse('index.php/aNot/');
			} else {
				return render_to_response(views_cmd::page('punot.html'));
			}
		}
		public function adslider(){
			return render_to_response(views_cmd::page('adslider.html'));
		}
		public function lmsn(){
			return render_to_response(views_cmd::page('lmsn.html'));
		}
		public function adrec(){
			return render_to_response(views_cmd::page('adrec.html'));
		}
	}
?>
