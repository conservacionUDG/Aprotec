<?php
	class general_cmd extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function login($user){
			$query = $this->consulta("SELECT * FROM user WHERE user_user = '$user' OR correo_user = '$user' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
	}
?>