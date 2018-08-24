<?php 	
	 class Order{
	 	function func()
	 	{
			require_once (MEUWP__DIR.'integracao/config/funcs.php');
			return new Func();
	 	}

		function any_auth()
		{
			require_once (MEUWP__DIR.'integracao/anymarket/config/any-auth.php');
			return new Any_Config();
		}

		public function post($data)
		{
			$json = json_encode($data);	
			$json = str_replace("\\n", "<br>", $json);
			while (strpos($json, "  ") || strpos($json, "\\n")|| strpos($json, "\n")|| strpos($json, "\\r")|| strpos($json, "\r")|| strpos($json, "\\n\\r")|| strpos($json, "\n\r")) {
				if (strpos($json, "  ")) {
					$json = str_replace("  ", " ", $json);
				}
				if (strpos($json, "\\n\\r")) {
					$json = str_replace("\\n\\r", "<br>", $json);
				}
				if (strpos($json, "\n\r")) {
					$json = str_replace("\n\r", "<br>", $json);
				}

				if (strpos($json, "\\n")) {
					$json = str_replace("\\n", "<br>", $json);
				}
				if (strpos($json, "\n")) {
					$json = str_replace("\n", "<br>", $json);
				}

				if (strpos($json, "\\r")) {
					$json = str_replace("\\r", "<br>", $json);
				}
				if (strpos($json, "\r")) {
					$json = str_replace("\r", "<br>", $json);
				}
			}
			print_r($json);

			$ch = curl_init($this->any_auth()->getUrl().'orders');      
			                                                                
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    'Content-Type: application/json',                                                                                
			    'Content-Length: ' . strlen($json),
			    'gumgaToken: '.$this->any_auth()->getTokenAny())                                                                    
			);          
			$result = curl_exec($ch);
			return $result;                                                                                                              
		}

		public function get($id)
		{
			$url = $this->any_auth()->getUrl().'orders';

			if ($id > -1) {
				$url = $url.'/'.$id;	
			}

			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
			curl_setopt($ch, CURLOPT_HTTPGET, true);                                                                 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    'Content-Type: application/json',   
			    'gumgaToken: '.$this->any_auth()->getTokenAny())                                                                    
			);   
			$result = curl_exec($ch);

			if (isset($result['content'])) {
				return $result['content'];
			}
			
			return $result;             
		}
	}
 ?>