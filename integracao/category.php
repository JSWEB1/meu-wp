<?php 

	require_once ('vendor/autoload.php');
	require_once ('config/auth.php');
	require_once ('anymarket/any-category.php');
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

	$woo = $auth->getWoo();
	$endpoint = 'products/categories';
	if ($id >= 0) {
		$endpoint = $endpoint.'/'.$id;
	}

	$r = $woo->get($endpoint);
	if ($r != null) {
		if (count($r) > -1) {
			for ($i=0; $i < count($r); $i++) {
				if ( $r[$i]['parent'] > 1) {
					$arrayAny[] = array(
					'id' => $r[$i]['id'],
						'name' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						'parent' => 
							array('id' => $r[$i]['parent']['id'] > 0 ? $r[$i]['parent']['id'] : 0),
						'priceFactor' => 1,
						'calculatedPrice' => true,
						'definitionPriceScope' => 'COST',
						
						
					);
					echo '<br>',
					var_dump($arrayAny);
					
						
				}else{
					$arrayAny[] = array(
					'id' => $r[$i]['id'],
						'name' => $r[$i]['name'],
						'partnerId' => $r[$i]['id'],
						'priceFactor' => 1,
						'calculatedPrice' => true,
						'definitionPriceScope' => 'COST',
					);
				}
				echo '<br><br>',
				
				var_dump($arrayAny);
			}

		}else{
			if ( $r[$i]['parent'] > -1) {
				
				$arrayAny = array(
				'id' => $r[$i]['id'],
				'name' => $r['name'],
				'partnerId' => $r['id'],
			

				);
				var_dump($arrayAny);
			}else{
				$arrayAny = array(
				'id' => $r[$i]['id'],
				'name' => $r['name'],
				'priceFactor' => 1,
				'calculatedPrice' => true,
				'definitionPriceScope' => 'COST',

				);
			}
		}

		$cat = new Category();
		var_dump($cat->get($id));
		if (count($arrayAny) > 1) {
		 	$count = 1;
		 	for ($i=0; $i < count($arrayAny); $i++) { 
		 		if ($count == 8) {
		 			$count = 1;
		 			sleep(1);
		 		}
		 		$count++;
		 		try 
		 		{
		 			($cat->post($arrayAny[$i]));
		 		} 
		 		catch (Exception $e) 
		 		{
		 			$result = $result.' Erro -> \n '.$e.' \n '; 
		 		}
		 	}
		} 
		else
		{
			try 
			{
				($cat->post($arrayAny));
			} 
			catch (Exception $e) 
			{
				$result = $result.' Erro -> \n '.$e.' \n ';  
			}
		}
	}else{
		$result = ('deu ruim');
	}
	
	if ($result != '') {
		print_r($result);
	}
 ?>