<?php 	
	 class ProductAny{
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
			
			$str = $data['description'];
			$data['description'] = trim($str, '<p>');
			$data['description'] = trim($str, '</p>');
			$data['description'] = trim($str, '\\n');
			$data['description'] = trim($str, '\\r');
			$data['description'] = trim($str, '\n');
			$data['description'] = trim($str, '\r');
			$data['description'] = trim($str, '<br>');
			$data['description'] = trim($str, '</br>');
			$data['description'] = trim($str, '\\n\\r');
			$data['description'] = trim($str, '\n\r');
			$json = json_encode($data);	
			$json = str_replace("\\n", "", $json);
			while (strpos($json, "  ") || strpos($json, "\\n")|| strpos($json, "\n")|| strpos($json, "\\r")|| strpos($json, "\r")|| strpos($json, "\\n\\r") || strpos($json, "\n\r") || strpos($json, "\\r\\n") || strpos($json, "\r\n") || strpos($json, "<p>") || strpos($json, "</p>")) {
				if (strpos($json, "  ")) {
					$json = str_replace("  ", " ", $json);
				}
				if (strpos($json, "\\n\\r")) {
					$json = str_replace("\\n\\r", "", $json);
				}
				if (strpos($json, "\n\r")) {
					$json = str_replace("\n\r", "", $json);
				}
				if (strpos($json, "\\n")) {
					$json = str_replace("\\n", "", $json);
				}
				if (strpos($json, "\n")) {
					$json = str_replace("\n", "", $json);
				}
				if (strpos($json, "\\r")) {
					$json = str_replace("\\r", "", $json);
				}
				if (strpos($json, "\r")) {
					$json = str_replace("\r", "", $json);
				}
				if (strpos($json, "\\r\\n")) {
					$json = str_replace("\\r\\n", "", $json);
				}
				if (strpos($json, "\r\n")) {
					$json = str_replace("\r\n", "", $json);
				}
				if (strpos($json, "<p>")) {
					$json = str_replace("<p>", "", $json);
				}
				if (strpos($json, "</p>")) {
					$json = str_replace("</p>", "", $json);
				}
				$json = trim($json,'"{"' .'"0"'.' ":'.'"');
				$json = '{"' . $json;
			}
			var_dump($json);
			echo '<br><br>';
			$ch = curl_init($this->any_auth()->getUrl().'products');      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    'Content-Type: application/json',                                                                                
			    'Content-Length: ' . strlen($json),
			    'gumgaToken: '.'L29462187G1540487908294R-1919731388')                                                                    
			);          
			$result = curl_exec($ch);
			var_dump($result);
			return $result;                                                                                                              
		}
		public function get($id)
		{
			$url = $this->any_auth()->getUrl().'products';
			if ($id > -1) {
				$url = $url.'/'.$id;	
			}
			$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
			curl_setopt($ch, CURLOPT_HTTPGET, true);                                                                 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
			    'Content-Type: application/json',   
			    'gumgaToken: '.'L29462187G1540487908294R-1919731388')                                                                    
			);   
			$result = curl_exec($ch);
			if (isset($result['content'])) {
				return $result['content'];
			}
			return $result;             
		}
	}
?>