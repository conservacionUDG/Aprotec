<?php
	class general_cmd extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function login($user){
			$query = $this->consulta("SELECT * FROM user_aproteccmd WHERE name_usercmd = '$user'");
			$sea= $this->fetch_array($query);
				return $sea;
		}
	}
?>