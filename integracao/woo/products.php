<?php 
	class ProductsWoo{
		//<Get Products>
		function get(){
			return $this->getId(-1);
		}
		function getId($id){
			return $this->getIdPer($id, 10);
		}
		function getIdPer($id, $per_page){
			//require_once (MEUWP__DIR.'integracao/vendor/autoload.php');
			// require_once ('vendor/autoload.php');
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			require_once (MEUWP__DIR.'integracao/config/auth.php');

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
							$count++;
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
									'id' => 117512, 
								),
								'weight' => $F->notNull($r[$i]['weight'], 0),
								'height' => $F->notNull($dimensions['height'], 0),
								'width' => $F->notNull($dimensions['width'], 0),
								'length' => $F->notNull($dimensions['length'], 0),
								'images' => $images,			
								'skus' => array([
									'title' => $r[$i]['name'],
									'partnerId' => $r[$i]['sku'].'-'.$r[$i]['name'],
									'price'=> $r[$i]['price'],
									'additionalTime' => 0,
									'amount'=> $F->notNull($r[$i]['stock_quantity'],1), 
								]),
								);
							}
						}else{
							echo 'ELSE MAROTO';
							break;
						}
					}else{
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