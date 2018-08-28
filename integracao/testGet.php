<?php 
	require_once ('config/auth.php');
	require ('vendor/autoload.php');
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

	for ($i=0; $i < 11; $i++) { 
		$data = [
		    'name' => 'Produto - '.$i,
		    'type' => 'simple',
		    'regular_price' => '21.99',
		    'description' => 'Descrição Produto - '.$i,
		    'short_description' => 'Descrição Curta Produto - '.$i,
		    'sku' => $i.'-'.date("d-m-Y H:i:s")
		];
		echo'enviando produto '.$i;
		$woo->post($endpoint, $data);
		echo'';
		sleep(1);
	}
	$result = json_encode($woo->get($endpoint));

	echo($result);
?>