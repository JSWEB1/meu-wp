<?php 
	class Teste 
	{
		function __construct()
		{
			include_once (MEUWP__DIR.'integracao/config/funcs.php');
			include_once (MEUWP__DIR.'integracao/config/auth.php');
			include_once (MEUWP__DIR.'integracao/config/conn.php');
			include_once (MEUWP__DIR.'integracao/anymarket/any-orders.php');
			$F = new Funcs();
			$auth = new Auth();
			$conn = new Connection();

		}

		function getOrder($idAny)
		{
			$objOrder = new Order();
			$orderJson = $objOrder->get($idAny);
			print_r(json_decode($orderJson, true));
			return;
			$arrayResult = $this->getOrdersToUp();
			var_dump($arrayResult);
		}

		function getOrdersToUp()
		{
			return $orders = $conn->toSend('O');
		} 
	}
?>