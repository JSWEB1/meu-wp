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
		 				if (!$this->checkIfExists($arrayAny[$i]['id'])) {
				 			$result = ($catAny->post($arrayAny[$i]));
				 			if ($F->notNull($result, "") != "") {
				 				$resultArray = json_decode($result, true);
				 				$conn->saveVinc("C", $arrayAny[$i]['id'], $resultArray['id']);
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
						$result = ($catAny->post($arrayAny));
			 			if ($F->notNull($result, "") != "") {
			 				$resultArray = json_decode($result, true);
			 				$conn->saveVinc("C", $arrayAny['id'], $resultArray['id']);
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

			$arrayAny = $catW->get($id, $per_page);
			if (count($arrayAny) > 0) 
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
			 			if (!$this->checkIfExists($arrayAny[$i]['id'])) {
				 			$result = ($catAny->put($arrayAny[$i]['id_child'], $arrayAny[$i]['cat']));
				 			if ($F->notNull($result, "") != "") 
				 			{
				 				$resultArray = json_decode($result, true);
				 			}
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
				try 
		 		{
		 			if (!$this->checkIfExists($arrayAny['id'])) {
			 			$result = ($catAny->put($arrayAny['id_child'], $arrayAny['cat']));
			 			if ($F->notNull($result, "") != "") 
			 			{
			 				$resultArray = json_decode($result, true);
			 			}
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

		public function checkIfExists($idWoo){
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			require_once (MEUWP__DIR.'integracao/anymarket/any-category.php');
			$catAny = new CategoryAny();
			$conn = new Connection();
			$result = $conn->getVincByWoo('C', $idWoo);

			if (isset($result)) {
				$result = $catAny->get($result);
				$result = json_decode($result, true);
				if (isset($result['id'])) {
					return true;
				}else{
					return false;
				}
			}else{
				$result = $catAny->get($result);
				if (isset($result['id'])) {
					return true;
				}else{
					return false;
				}
			}
		}
	}
 ?>