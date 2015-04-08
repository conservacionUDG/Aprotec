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
		public function postSave($post,$idUser,$fecha){
			$this->consulta("INSERT INTO post_aprotec (titulo_post,balazo_post,contenido_post,autor_post,fecha_post,estado_post)
												VALUES('$post[title]','$post[balazo]','$post[contenido]','$idUser','$fecha','$post[op]')" );
		}
	}
?>