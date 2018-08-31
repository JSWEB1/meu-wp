<?php 
	class Orders{
		function post($id = -1, $per_page = 10)
		{
			require (MEUWP__DIR.'integracao/woo/woo-orders.php');
			require_once (MEUWP__DIR.'integracao/anymarket/any-orders.php');
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			$F = new Funcs();
			$OrderAny = new OrderAny();
			$OrderW = new OrdersWoo();
			$arrayAny = $prodW->get($id, $per_page);
			echo $F->divBorder(var_dump($arrayAny));

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
			 			$result = ($OrderAny->post($arrayAny[$i]));
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
					$result = ($OrderAny->post($arrayAny));
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
	}	
 ?>