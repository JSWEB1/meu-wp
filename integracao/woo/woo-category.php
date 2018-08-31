<?php 
	class CategoryWoo
	{
		function get($id = -1, $per_page = 10, $subcat = false)
		{
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			$F = new Funcs();
			$auth = new Auth();
			//echo '<script>myFunction("Antes de Instanciar o Woo");</script>';
			$woo = $auth->getWoo();
			$conn = new Connection();
			//echo '<script>myFunction("Despois de Instanciar o Woo");</script>';
			$pagination = 1;
			do
			{
			  	try 
			  	{
					$endpoint = 'products/categories';
					if ($id >= 0) 
					{
						$endpoint = $endpoint.'/'.$id;
					}
 					if ($id > 0) 
 					{
 						$r = $woo->get($endpoint);
 					}else
 					{
						$r = $woo->get($endpoint, array('per_page' => $per_page, 'page' => $pagination));
 					}
					if ($r != null) 
					{
						if (count($r) > -1) 
						{
							for ($i=0; $i < count($r); $i++) 
							{
								
								if ($subcat == true && $r[$i]['parent'] > 0) 
								{
									print_r($r[$i]['parent']);
									$arrayAny[] = array(
											'id_chield' => $conn->getVincByWoo("C", $F->notNull($r[$i]['id'], 0)),
											'cat' => array(
												'name' => $r[$i]['name'],
												'parent' => array(
																'id' => $conn->getVincByWoo("C", $F->notNull($r[$i]['parent'], 0))
															),
											),
									);
								}
								else if ($subcat == false) 
								{
									$arrayAny[] = array(
										'id' => $r[$i]['id'],
										'name' => $r[$i]['name'],
										'partnerId' => $r[$i]['id'],
										'priceFactor' => 1,
										'calculatedPrice' => true,
										'definitionPriceScope' => 'COST',
									);
								}
							}
						}
						else if ($F->notNull($r, "") != "") 
						{
							if ($subcat == true && $r['parent'] > 0) {
								$arrayAny= array(
											'id_dad' => $r['id'],
												'cat' => array(
													'name' => $r['name'],
													'parent' => array(
																	'id' => $conn->getVincByWoo("C", $F->notNull($r['parent'], 0))
																),
												),
											);
							}
							else if ($subcat == false) 
							{
							
								$arrayAny= array(
												'id' => $r['id'],
												'name' => $F->notNull($r['name'], ""),

												'partnerId' => $r['id'],
												'priceFactor' => 1,
												'calculatedPrice' => true,
												'definitionPriceScope' => 'COST',
											);
							}
						}
						else
						{
							break;
						}
					}
					else
					{
						break;
					}
				} catch (Exception $e) {	
					$error = 'Erro durante o processo: '.$e;
					echo '<script>myFunction("'.$error.'");</script>';
					break;
				}
	  		$pagination++;
			} while (count($r) > 0);
			return $arrayAny;
		}

		//</Get Products>

	}

?>