<?php 
	if ( ! defined( 'ABSPATH' ) ) {
		echo 'sem abspath';
		return;
	}
	require_once (STORE__DIR.'wp-load.php');
	require_once (MEUWP__DIR.'integracao/vendor/autoload.php');
	use Automattic\WooCommerce\Client;
	class Auth 
	{
		public function getUrl()
		{
			if (!defined('ABSPATH')) {
					echo '<script>myFunction("Não Herdou ABSPATH");</script>';
			}
			return "".get_option('siteurl');
		}
		public function getCs()
		{
			return "".get_option('secret_woo');
		}
		public function getCk()
		{
			return "".get_option('key_woo');
		}
		public function getWoo()
		{
			$woo = new Client(
				$this->getUrl(),
				$this->getCk(),
				$this->getCs(),
				[
					'wp_api' => true,
					'version' => 'wc/v2',
				]
			);
			return $woo;
		} 
	}
 ?>