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
	}

?>