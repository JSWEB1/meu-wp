<?php 
	class Category 
	{
		function post($id = -1, $per_page = 10)
		{
			require (MEUWP__DIR.'integracao/woo/woo-category.php');
			require_once (MEUWP__DIR.'integracao/anymarket/any-category.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			$catAny = new CategoryAny();
			$catW = new CategoryWoo();
			$conn = new Connection();
			$F = new Funcs();
			$arrayAny = $catW->get($id, $per_page);
			if (count($arrayAny) > 1) 
			{
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
			 			$result = ($catAny->post($arrayAny[$i]));
			 			if ($F->notNull($result, "") != "") {
			 				$resultArray = json_decode($result, true);
			 				$conn->saveVinc("C", $arrayAny[$i]['id'], $resultArray['id']);
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
					$result = ($catAny->post($arrayAny));
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

			$arrayAny = $catW->get($id, $per_page, true);
			//$arrayAny = json_decode(json_encode($arrayAny), true);
			if (count($arrayAny) > 0) 
			{
				echo 'if 1';
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
			 			$result = ($catAny->put($arrayAny[$i]['id_chield'], $arrayAny[$i]['cat']));
			 			if ($F->notNull($result, "") != "") 
			 			{
			 				$resultArray = json_decode($result, true);
			 			}
			 		} 
			 		catch (Exception $e) 
			 		{
			 			$result = $result.' Erro -> \n '.$e.' \n '; 
			 		}
			 	}
			}
			else if(isset($arrayAny['cat']))
			{
				echo 'if 2';
				try 
		 		{
		 			$result = ($catAny->put($arrayAny['id_chield'], $arrayAny['cat']));
		 			if ($F->notNull($result, "") != "") 
		 			{
		 				$resultArray = json_decode($result, true);
		 			}
		 		} 
		 		catch (Exception $e) 
		 		{
		 			$result = $result.' Erro -> \n '.$e.' \n '; 
		 		}
			}
			else
			{
				echo 'ué';
			}
			if ($F->notNull($result, "") != "") 
 			{
 				echo "<script>myFunction(\"".$result."\")</script>";
 			}
		}
	}
 ?>