<?php 
	require_once ('../autoload.php');
	require_once ('config/auth.php');
	require_once ('anymarket/post-category.php');

	use Automattic\WooCommerce\Client;

	$auth = new Auth();
	$id = -1;

	
	if (isset($_POST['exppro'])) {
		if (($_POST['ID']) >= 0) {
			$id = $_POST['ID'];
		}
	}else{
		return;
	}

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
	if ($id >= 0) {
		$endpoint = $endpoint.'/'.$id;
	}

	$r = $woo->get($endpoint);

	if ($r != null) {

		if (count($r) > 1) {
			for ($i=0; $i < count($r); $i++) {
				if ( $r[$i]['parent'] > 0) {
					$arrayAny[] = array(
						'title' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						//'parent' => 
							//array('id' => $r[$i]['parent'] > 0 ? $r[$i]['parent'] : 0),
						'priceFactor' => 1,
						'calculatedPrice' => true,
					);
				}else{
					$arrayAny[] = array(
						'name' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						'priceFactor' => 1,
						'calculatedPrice' => true,
					);
				}

			}

		}else{
			if ( $r['parent']) {
				$arrayAny = array(
				'name' => $r['name'],
				'partnerId' => $r['id'],
				'parent' => 
					//array('id' => $r['parent'] > 0 ? $r['parent'] : 0),
				'priceFactor' => 1,
				'calculatedPrice' => true,
				);
			}else{
				$arrayAny = array(
				'name' => $r['name'],
				'partnerId' => $r['id'],
				'priceFactor' => 1,
				'calculatedPrice' => true,
				);
			}
			
		}

		$cat = new Category(); 
		$result = $cat->post($arrayAny);

	}else{
		echo('deu ruim');
	}
	
 ?>