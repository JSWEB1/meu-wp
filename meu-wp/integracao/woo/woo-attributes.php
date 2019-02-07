<?php 
	class AttributesWoo{
		function get($id = -1, $per_page = 10, $per_request = -1){
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			$conn = new Connection();
			$F = new Funcs();
			$auth = new Auth();
			$woo = $auth->getWoo();
			$pagination = 1;
			if ($per_request < 0) {
				do{
				  	try {
						$endpoint = 'products/attributes';
						if ($id >= 0) {
							$endpoint = $endpoint.'/'.$id;
						}
						//Se Vier com ID    GET com ID        se não GET por PÁGINA
	 					if ($id > 0) {
	 						$r = $woo->get($endpoint);
	 					}else{
							$r = $woo->get($endpoint, array('per_page' => $per_page, 'page' => $pagination));
	 					}
						if ($r != null) {
							if (count($r) > 0) {
								for ($i=0; $i < count($r); $i++) {
									var_dump($r[$i]['id']);
									return;
									$arrayTerms = $this->getTerms($F->notNull($r[$i]['id'], -1));
									foreach ($arrayTerms as $terms) {
										$arrayAny[] = array(
											'name' => $r[$i]['name'],
											'value' => $terms['name']
										);
									}
								}
							}else{
								break;
							}
						}else{
							break;
						}
					} catch (Exception $e) {
						$error = 'Erro durante o processo: '.$e;
						echo ''.$error;
						break;
					}
		  		$pagination++;

				} while (count($r) > 0);
			}
			// echo $F->divBorder(print_r(json_encode($arrayAny[0])));
			var_dump($arrayAny);
			echo '<h1>Não Ligo</h1>';
			return $arrayAny;

		}

		function getTerms($att)
		{
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			$conn = new Connection();
			$F = new Funcs();
			$auth = new Auth();
			$woo = $auth->getWoo();
			$pagination = 1;
			$array = array();
			do{
			  	try {
					$endpoint = 'products/attributes';
					if ($id >= 0) {
						$endpoint = $endpoint.'/'.$att.'/terms';
					}
					var_dump($endpoint);
					//Se Vier com ID    GET com ID        se não GET por PÁGINA
 					if ($id > 0) {
 						$r = $woo->get($endpoint);
 					}else{
						$r = $woo->get($endpoint, array('per_page' => $per_page, 'page' => $pagination));
 					}
						var_dump($r);
						return;
					if ($r != null) {
						if (count($r) > 0) {
							foreach ($r as $term) {
								$array[] = $term;
							}
						}else{
							break;
						}
					}else{
						break;
					}
				} catch (Exception $e) {
					$error = 'Erro durante o processo: '.$e;
					echo ''.$error;
					break;
				}
	  		$pagination++;

			} while (count($r) > 0);
			// echo $F->divBorder(print_r(json_encode($arrayAny[0])));
			var_dump($array);
			echo '<h1>Não Ligo</h1>';
			return $array;
		}

		//</Get Products>

	}

?>


