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
	}

?>