<?php 	
	class CategoryAny
	{
		function any_auth()
		{
			require_once (MEUWP__DIR.'integracao/anymarket/config/any-auth.php');
			return new Any_Config();
		}
		public function post($data)
		{
			$json = json_encode($data);	
			var_dump($json);
			echo "____________________";
			var_dump($data);
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
			var_dump($result);                                                                                                        
			return $result;      
		}
		public function put($id, $data)
		{
			$json = json_encode($data);	
			$url = $this->any_auth()->getUrl().'categories/'.$id;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
			//curl_setopt($ch, CURLOPT_PUT, true);
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
		public function get($id = -1)
		{
			$url = $this->any_auth()->getUrl().'categories';
			if ($id > -1) 
			{
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
			if (isset($result['content'])) 
			{
				return $result['content'];
			}
			return $result;             
		}
		public function geta($data)
		{
			$json = json_decode($data, true);	
			$url = $this->any_auth()->getUrl().'categories';
			if ($id > -1) 
			{
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
			if (isset($result['content'])) 
			{
				return $result['content'];
			}
			return $result;             
		}
	}
?>