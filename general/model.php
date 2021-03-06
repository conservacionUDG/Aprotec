<?php
	class general extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function login($user){
			$query = $this->consulta("SELECT * FROM user WHERE user_user = '$user' OR correo_user = '$user' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function consul(){
			$query = $this->consulta("SELECT * FROM user ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function guardarmsn($arr){
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
		public function verifica2($pw,$user){
			$query = $this->consulta("SELECT CASE WHEN EXISTS (
							SELECT * FROM `user` WHERE user_user = '$user' AND pw_user = '$pw') 
					THEN CAST(1 AS binary)
					ELSE CAST(0 AS binary) END");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function noticias($inicio = 0){
			$query = $this->consulta("SELECT id_post, titulo_post, balazo_post FROM post_aprotec WHERE estado_post = '1' ORDER BY id_post DESC LIMIT $inicio , 5;");
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
			$query = $this->consulta("SELECT titulo_post, contenido_post, name_usercmd, fecha_post FROM post_aprotec 
										INNER JOIN user_aproteccmd ON autor_post = id_usercmd
										WHERE id_post = '$id_nota' AND estado_post = '1' ");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function eventos(){
			$query = $this->consulta("SELECT * FROM eventos_aprotec WHERE situaccion_evento = '1' AND libres_evento != '0' ORDER BY id_evento DESC;");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function consult($evento){
			$query = $this->consulta("SELECT * FROM eventos_aprotec WHERE id_evento = '$evento';");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function rec($var = 3){
			$query = $this->consulta("SELECT * FROM recursos_aprotec WHERE permiso_recurso <= '$var';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function jobs(){
			$query = $this->consulta("SELECT id_job, titulo_job, fecha_job, localidad_job FROM jobs_aprotec WHERE estado_job = '1';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function job($url){
			$query = $this->consulta("SELECT * FROM jobs_aprotec WHERE id_job = '$url' AND estado_job = '1';");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function slider(){
			$query = $this->consulta("SELECT * FROM slider_aprotec WHERE estado_slider = '1' ORDER BY orden_slider ASC;");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function perfil($id){
			$query = $this->consulta("SELECT * FROM perfiles_aprotec WHERE user_perfil = ' $id'");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function inserPerfil($id){
			$this->consulta("INSERT INTO perfiles_aprotec (user_perfil) VALUES('$id')" );
		}
		public function guardar_job($arr){
			$this->consulta("INSERT INTO jobs_aprotec (titulo_job,pais_job,localidad_job,salario_job,moneda_job,tiempo_job,duracion_job,meces_job,actividad_job,experiencia_job,empresa_job,contacto_job,telconta_job,email_job,estado_job) 
						VALUES ('$arr[titulo_job]','$arr[pais]','$arr[localidad]','$arr[salario]','$arr[moneda]','$arr[tiempo]','$arr[duraccion]','$arr[meces]','$arr[actividades]','$arr[expetiencia]','$arr[empresa]','$arr[contacto]','$arr[tcontacto]','$arr[emailContacto]','2')");
		}
		public function acpassword($pw,$id){
			$this->consulta("UPDATE user SET pw_user = '$pw' WHERE id_user = '$id'");
		}
		public function acredes($arr,$id){
			$this->consulta("UPDATE perfiles_aprotec SET facebook_perfil = '$arr[face]', twitter_perfil = '$arr[twitter]', linkedin_perfil = '$arr[linkedin]' WHERE user_perfil = '$id' ");
		}
		public function acgeneral($arr,$id){
			$this->consulta("UPDATE perfiles_aprotec SET name_perfil = '$arr[name]', appaterno_perfil = '$arr[ap_p]', apmaterno_perfil = '$arr[ap_m]', pais_perfil = '$arr[pais]',localidad_perfil = '$arr[localidad]',nacimiento_perfil = '$arr[fehca]', web_perfil = '$arr[web]' WHERE user_perfil = '$id' ");
		}
		public function grabarJob($user,$empleo){
			$this->consulta("INSERT INTO solicitudJob_aprotec (user_sJob,job_sJob) VALUES('$user','$empleo')" );
		}
		public function asistEvento($user,$evento){
			$this->consulta("INSERT INTO asistenciaEv_aprotec (user_aEv,evento_aEv) VALUES('$user','$evento')" );
			$this->consulta("UPDATE eventos_aprotec SET libres_evento = libres_evento-1 WHERE id_evento = '$evento'");
		}
	}
?>