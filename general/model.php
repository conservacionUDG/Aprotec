<?php
	class general extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function consul()
		{
			$query = $this->consulta("SELECT * FROM user ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function guardarmsn($arr)
		{
			$this->consulta("INSERT INTO msn_aprotec (name_msn,email_msn,msn_msn) VALUES('$arr[nombre]','$arr[email]','$arr[msn]')" );
		}
		public function new_user($date){
			$this->consulta("INSERT INTO user (user_user,correo_user,pw_user) VALUES('$date[User]','$date[email]','$date[pw1]');");
		}
		public function verifica($user,$email){
			$query = $this->consulta("SELECT CASE WHEN EXISTS (
							SELECT * FROM `user` WHERE user_user = '$user' OR correo_user = '$email') 
					THEN CAST(1 AS binary)
					ELSE CAST(0 AS binary) END");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function noticias(){
			$query = $this->consulta("SELECT id_post, titulo_post, balazo_post FROM post_aprotec WHERE estado_post = '1';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function nota($id_nota){
			$query = $this->consulta("SELECT titulo_post, contenido_post, autor_post, fecha_post FROM post_aprotec WHERE id_post = '$id_nota' AND estado_post = '1' ");
			$sea = $this->fetch_array($query);
			return $sea;
		}
	}

?>