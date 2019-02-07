<?php 
	class Teste 
	{
		function __construct()
		{
			include_once (MEUWP__DIR.'integracao/config/funcs.php');
			include_once (MEUWP__DIR.'integracao/config/auth.php');
			include_once (MEUWP__DIR.'integracao/config/conn.php');
			include_once (MEUWP__DIR.'integracao/anymarket/any-orders.php');
			include_once (MEUWP__DIR.'integracao/woo/woo-orders.php');
			$F = new Funcs();
			$auth = new Auth();
			$conn = new Connection();

		}

		function getOrder($idAny)
		{
			$objOrder = new Order();
			$orderJson = $objOrder->get($idAny);
			$arrayOrder = json_decode($orderJson, true);
			$objWooOrder = new Orders();
			$result = $objWooOrder->post($arrayOrder);
		}

		function getOrdersToUp()
		{
			return $orders = $conn->toSend('O');
		} 
	}
?>