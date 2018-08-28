<?php 
	require_once ('config/auth.php');
	require ('../autoload.php');
	$auth = new Auth();

	use Automattic\WooCommerce\Client;

	$woo = new Client(
		$auth->getUrl(),
		$auth->getCk(),
		$auth->getCs(),
		[
			'wp_api' => true,
			'version' => 'wc/v2',
		]
	);
	$endpoint = 'products';

	$result = json_encode($woo->get($endpoint));

	echo($result);
?>