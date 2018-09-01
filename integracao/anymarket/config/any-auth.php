<?php 

	require_once (STORE__DIR.'wp-load.php');

	class Any_Config

	{

		public function getUrl()

		{

			return 'sandbox-api.anymarket.com.br/v2/';

		}

		public function getTokenAny()

		{
			return ''.get_option('token_any');
		}

	}



 ?>