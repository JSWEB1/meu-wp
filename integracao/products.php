<?php 
	class Products{
		function post($id = -1, $per_page = 10, $per_request = 10)
		{
			require (MEUWP__DIR.'integracao/woo/woo-products.php');
			require_once (MEUWP__DIR.'integracao/anymarket/any-products.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			$F = new Funcs();
			$prodAny = new ProductAny();
			$prodW = new ProductsWoo();
			$conn = new Connection();
			$arrayAny = $prodW->get($id, $per_page, $per_request);

			if (count($arrayAny) > 1) 
			{
			 	$count = 1;
			 	for ($i=0; $i < count($arrayAny); $i++) 
			 	{ 
			 		if ($count == 9) 
			 		{
			 			$count = 1;
			 			sleep(1);
			 		}
			 		$count++;
			 		try 
			 		{
			 			if (!$this->checkIfExists($arrayAny[$i]['id'])) {
			 				$result = ($prodAny->post($arrayAny[$i]));
			 				if (isset($result)) {
			 					$resultArray = json_decode($result, true);
			 					$conn->saveVinc("P", $arrayAny[$i]['id'], $resultArray['id'], 'S');
			 				}
			 			}
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
					if (!$this->checkIfExists($arrayAny['id'])) {
		 				$result = ($prodAny->post($arrayAny));
		 				if (isset($result)) {
		 					$resultArray = json_decode($result, true);
		 					$conn->saveVinc("P", $arrayAny['id'], $resultArray['id'], 'S');
			 			}
			 		}
				} 
				catch (Exception $e) 
				{
					$result = $result.' Erro -> \n '.$e.' \n ';  
				}
			}
			if ($result != '') 
			{
				$error = 'Erro durante o processo: '.$result;
				echo '<script>myFunction("'.$error.'");</script>';
			}
			else
			{
				echo '<script>myFunction("Tudo OK \n'.$result.'");</script>';
			}
		}

		public function checkIfExists($idWoo){
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			require_once (MEUWP__DIR.'integracao/anymarket/any-products.php');
			$prodAny = new ProductAny();
			$conn = new Connection();
			$result = $conn->getVincByWoo('P', $idWoo);

			if (isset($result)) {
				$result = $prodAny->get($result);
				$result = json_decode($result, true);
				if (isset($result['id'])) {
					return true;
				}else{
					return false;
				}
			}else{
				$result = $prodAny->get($result);
				if (isset($result['id'])) {
					return true;
				}else{
					return false;
				}
			}
		}
	}	
 ?>