<?php 

	require_once (STORE__DIR.'wp-load.php');

	class Any_Config

	{

		public function getUrl()

		{

			return 'app-api.anymarket.com.br/v2/';

		}

		public function getTokenAny()

		{
			echo '<script>myFunction("'.get_option('token_any').'");</script>';
			return 'L28917560G1530708979570R-1673130305';
		}

	}



 ?>