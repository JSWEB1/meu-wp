<?php 

	require_once ('vendor/autoload.php');
	require_once ('config/auth.php');
	require_once ('anymarket/any-orders.php');
	require_once ('config/funcs.php');

	$F = new Funcs();

	use Automattic\WooCommerce\Client;
	$auth = new Auth();
	$id = -1;

	if (isset($_POST['exporders'])) {
		if (($_POST['ID']) >= 5) {
			$id = $_POST['ID'];
		}
	}else{
		echo 'não Funciona se tentar acessar direto esperto ¬¬';
		return;
	}

	$woo = $auth->getWoo();
$page = 1;



	$endpoint = 'orders';
	if ($id >= 0) {
		$endpoint = $endpoint.'/'.$id;
	}


		$r = $woo->get($endpoint);
		var_dump(count($r));
		if ($r != null) {
			if (count($r) > -1) {
				for ($i=0; $i < count($r); $i++) {
					$items[] = $r[$i]['line_items'];
					$billing = $r[$i]['billing'];
					
					$arrayAny[] = array(
					'id' => $r[$i]['id'],
					'partnerId' => $r[$i]['id'],
					'createdAt' => $r[$i]['date_created'].'Z',
					'paymentDate' => $r[$i]['date_paid'],
					'marketPlaceStatus'=> '',
					'status' => $r[$i]['status'],
					'marketplace' => $r[$i]['ECOMMERCE']
					'marketPlaceId'=> '',
					'marketPlaceShipmentStatus'=> '',
						'billingAddress' => array(
							'city' => $billing ['city'],
							'state' => $billing ['state'],
							'country' => $billing ['country'],
							'street' => $billing ['address_1'],
							'number' => $billing ['address_2'],
							'zipCode' => $billing ['postcode'],
						),
						
						'payments' => array(
						'method' => $r[$i]['payment_method_title'],
						'status' => $r[$i]['status'],
						'value' => $r[$i]['total']
						),
						
						'items' => array([
						'sku' => array(
						'partnerId' => 'tst',
						),
						'product' => array(
						'title' =>'teste4r',
						),
						'amount' => $r[$i]['quantity'],
						'price' => $r[$i]['total'],
						'total' => $r[$i]['total'],
						]),
						
						'buyer' =>array(
						'name' => $billing['first_name']. $billing['last_name'],
						'email' => $billing['email'],
						"phone" => $billing['phone']
						),
						

					);
				
				}

				
			}
			//var_dump($arrayAny);
			$cat = new Order();
			if (count($arrayAny) > 1) {
			 	$count = 1;
			 	for ($i=0; $i < count($arrayAny); $i++) { 
			 		if ($count == 9) {
			 			$count = 1;
			 			sleep(3);
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