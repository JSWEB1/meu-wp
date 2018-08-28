<?php 
	require_once ('../../wp-load.php');
	class Auth 
	{
		public function getUrl()
		{
			return 'http://localhost/woo/wordpress';
		}
		public function getCs()
		{
			return get_option('secret_woo');
		}
		public function getCk()
		{
			return get_option('key_woo');
		}
		public function getTokenAny()
		{
			return get_option('token_any');
		}
		public function getOiAny()
		{
			return get_option('oi_any');
		}
	}
 ?>