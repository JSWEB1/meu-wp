<?php 
	require_once ('../autoload.php');
	require_once ('config/auth.php');
	require_once ('anymarket/post-category.php');
	use Automattic\WooCommerce\Client;

	$auth = new Auth();
	$id = -1;

	
	if (isset($_POST['expcat'])) {
		if (($_POST['ID']) >= 0) {
			$id = $_POST['ID'];
		}
	}else{

		return;
		
	}


try { 
$woo = new Client(
		$auth->getUrl(),
		$auth->getCk(),
		$auth->getCs(),
		[
			'wp_api' => true,
			'version' => 'wc/v2',
		]
	);
} catch (Exception $e) { 
	print_r($e);
}


	$endpoint = 'products/categories';
	if ($id >= 0) {
		$endpoint = $endpoint.'/'.$id;
	}

	$r = $woo->get($endpoint);

	$cat = new Category(); 
	$result = ($cat->get($id));

	if ($r != null) {

		if (count($r) > 1) {
			for ($i=0; $i < count($r); $i++) {
				if ( $r[$i]['parent'] > 0) {
					$arrayAny = array(
						'name' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						//'parent' => 
							//array('id' => $r[$i]['parent'] > 0 ? $r[$i]['parent'] : 0),
						'priceFactor' => 1,
						'calculatedPrice' => true,
						'id' => '',
					);
					echo '<br>';
				}else{
				
					$arrayAny = array(
						'name' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						'priceFactor' => 1,
						'calculatedPrice' => true,
						'id' => '',
					);
				}
			}

		}else{
			if ( $r['parent']) {
				$arrayAny[] = array(
				'name' => $r['name'],
				'partnerId' => $r['id'],
				//'parent' => 
					//array('id' => $r['parent'] > 0 ? $r['parent'] : 0),
				'priceFactor' => 1,
				'calculatedPrice' => true,
				'id' => '',
				);
			}else{
			
			
				$arrayAny = array(
				'name' => $r['name'],
				'partnerId' => $r['id'],
				'priceFactor' => 1,
				'calculatedPrice' => true,
				'id' => ''
				);
			}
		}
		$cat1 = new Category(); 
		$result = $cat1->post($arrayAny);

	}else{
		echo('deu ruim');
	}
	
 ?>