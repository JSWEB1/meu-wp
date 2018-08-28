<?php 
	class ProductsWoo{
		function get($id = -1, $per_page = 10){
			//require_once (MEUWP__DIR.'integracao/vendor/autoload.php');
			// require_once ('vendor/autoload.php');
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');
			require_once (MEUWP__DIR.'integracao/config/conn.php');
			$conn = new Connection();
			$F = new Funcs();
			$auth = new Auth();
			//echo '<script>myFunction("Antes de Instanciar o Woo");</script>';
			$woo = $auth->getWoo();
			//echo '<script>myFunction("Despois de Instanciar o Woo");</script>';
			$pagination = 1;
			do{
			  	try {
					$endpoint = 'products';
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
								$images = array();
								for($j = 0; $j < count($r[$i]['images']); $j++){
									//Prepara a Array <images> do produto
									$images[] = array(
										'main' => $r[$i]['images'][$j]['position'] == 0,
										'url' => $r[$i]['images'][$j]['src'],
										'index' => $r[$i]['images'][$j]['position']
									);	
								}
								$dimensions = $r[$i]['dimensions'];
								$arrayAny[] = array(
								'id' => $r[$i]['id'],
								'title' => $r[$i]['name'],
								'description' => $r[$i]['description'],
								'priceFactor' => 1,
								'category' => array(
														'id' => $conn->getVincByWoo("C", $r[$i]['categories'][0]['id']),
														'name' => $r[$i]['categories'][0]['name'],
													),
								'weight' => $F->notNull($r[$i]['weight'], 0),
								'height' => $F->notNull($dimensions['height'], 0),
								'width' => $F->notNull($dimensions['width'], 0),
								'length' => $F->notNull($dimensions['length'], 0),
								'images' => $images,			
								'skus' => array([
									'title' => $F->notNull($r[$i]['name'], ""),
									'partnerId' => $F->notNull($r[$i]['sku'].'-'.$r[$i]['name'], ""),
									'price'=> $F->notNull($r[$i]['price'], 1),
									'additionalTime' => 0,
									'amount'=> $F->notNull($r[$i]['stock_quantity'], 1), 
								]),
								);
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
			return $arrayAny;

		}

		//</Get Products>

	}

?>