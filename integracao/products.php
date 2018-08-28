<?php 
	class Products{
		function postProds(){
			$this->postProdsId(-1);
		}
		function postProdsId($id){
			$this->postProdsIdPer($id, 10);	
		}
		function postProdsIdPer($id, $per_page){
			require (MEUWP__DIR.'integracao/woo/products.php');
			require_once ('anymarket/any-products.php');

			$prodAny = new ProductAny();
			$prodW = new ProductsWoo();
			$arrayAny = $prodW->get($id, $per_page);
			$result = $prodAny->get(-1);

			if (count($arrayAny) > 1) {
			 	$count = 1;
			 	for ($i=0; $i < count($arrayAny); $i++) { 
			 		if ($count == 9) {
			 			$count = 1;
			 			sleep(1);
			 		}
			 		$count++;
			 		try 
			 		{
			 			$result = ($prodAny->post($arrayAny[$i]));
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
					$result = ($prodAny->post($arrayAny));
				} 
				catch (Exception $e) 
				{
					$result = $result.' Erro -> \n '.$e.' \n ';  
				}
			}
		
			if ($result != '') {
				$error = 'Erro durante o processo: '.$result;
				echo '<script>myFunction("'.$error.'");</script>';
			}else{
				echo '<script>myFunction("Tudo OK");</script>';
			}
		}

	}	
 ?>