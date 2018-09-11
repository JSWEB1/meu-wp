<?php 
	class Orders
	{
		function get($id = -1, $per_page = 10, $subcat = false))
		{

		}
		function post($order)
		{
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			$F = new Funcs();
			$auth = new Auth();
			$woo = $auth->getWoo();
			$conn = new Connection();

			$statusOrder = '';
			switch ($F->notNull($order['status'], 'PENDING')) {
				case 'CONCLUDED':
					$statusOrder = 'COMPLETED';
					break;
				case 'CANCELED':
					$statusOrder = 'CANCELLED';
					break;
				case 'INVOICED':
					$statusOrder = 'ON-HOLD';
					break;
				case 'PAID_WAITING_DELIVERY':
					$statusOrder = 'PROCESSING';
					break;
				case 'PAID_WAITING_SHIP':
					$statusOrder = 'PROCESSING';
					break;
				case 'PENDING':
					$statusOrder = 'PENDING';
					break;
				default:
					$statusOrder = 'PENDING';
					break;
			}
			$items = new array();
			foreach ($objItens as $order['items']) {
				$items[] = array(
					'product_id' => $F->notNull($conn->getVincByAny('P', $objItens['product']['id']), '0'),
		            'quantity' => $F->notNull($objItens['product']['amount'], '0')
				);
			}
			$data = array(
				[
					//TO-DO Conferir Regras do Status
					'status' => $statusOrder,
				    'payment_method' => '{$F->notNull($order['payments'][0]['method'], '')}',
				    'payment_method_title' => '{$F->notNull($order['payments'][0]['method'], '')}',
				    'set_paid' => {$F->notNull($order['payments'][0]['status'], 'false') == 'Pago' ? 'true' : 'false'},
				    'billing' => [
				        'first_name' => '{$F->notNull($order['buyer']['name'], '')}',
				        'last_name' => '',
				        'address_1' => '{$F->notNull($order['shipping']['address'], '')}',
				        'address_2' => '',
				        'city' => '{$F->notNull($order['shipping']['city'], '')}',
				        'state' => '{$F->notNull($order['shipping']['state'], '')}',
				        'postcode' => '{$F->notNull($order['shipping']['zipCode'], '')}',
				        'country' => '{$F->notNull($order['shipping']['country'], '')}',
				        'email' => '{$F->notNull($order['buyer']['email'], '')}',
				        'phone' => '{$F->notNull($order['buyer']['phone'], '')}'
				    ],
				    'shipping' => [
				        'first_name' => '{$F->notNull($order['buyer']['name'], '')}',
				        'last_name' => '',
				        'address_1' => '{$F->notNull($order['shipping']['address'], '')}',
				        'address_2' => '',
				        'city' => '{$F->notNull($order['shipping']['city'], '')}',
				        'state' => '{$F->notNull($order['shipping']['state'], '')}',
				        'postcode' => '{$F->notNull($order['shipping']['zipCode'], '')}',
				        'country' => '{$F->notNull($order['shipping']['country'], '')}',
				    ],
				    'line_items' => [
				        [
				            'product_id' => 93,
				            'quantity' => 2
				        ],
				        [
				            'product_id' => 22,
				            'variation_id' => 23,
				            'quantity' => 1
				        ]
				    ],
				    'shipping_lines' => [
				        [
				            'method_id' => 'flat_rate',
				            'method_title' => 'Flat Rate',
				            'total' => 10
				        ]
				    ]
				]
			);

			$resultJson = $woo->post('orders', $data);
			$resultArray = json_decode($resultJson, true);
			$conn->saveVinc('O', $resultArray['id'], $id, 'S');
		}
	}
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
					'marketPlaceStatus'=> $r[$i]['status'],
					'status' => $r[$i]['status'],
					'marketplace' => 'ECOMMERCE',
					'marketPlaceId'=> $r[$i]['id'],
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
		}
?>
