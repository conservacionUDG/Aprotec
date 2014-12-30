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
	}

?>