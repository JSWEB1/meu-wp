<?php 	
	 class Category{
		function any_auth()
		{
			require_once ('config/any-auth.php');
			return new Any_Config();
		}

		public function post($data)
		{
			$json = json_encode($data);	

			$ch = curl_init($this->any_auth()->getUrl().'categories');      
			                                                                
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
			$url = $this->any_auth()->getUrl().'categories';

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
		public function put($data, $id)
		{
			$json = json_encode($data);
			$ch = curl_init($this->any_auth()->getUrl().'categories/'. $id); 
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
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
	}
 ?>