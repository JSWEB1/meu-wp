<?php 
	
	 class Category{

		public function post($data){
			$json = json_encode($data);	    
			$ch = curl_init('http://sandbox-api.anymarket.com.br/v2/categories');                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    'Content-Type: application/json',                                                                                
			    'Content-Length: ' . strlen($json),
			    'gumgaToken: L28917560G1530708979570R-1673130305')                                                                    
			);                                                                                                                   
			       
			echo($json); 
			$result = curl_exec($ch);
			return $result;                                                                                                              
		}
		
			public function get($id){
			
			$url = 'http://sandbox-api.anymarket.com.br/v2/categories'; 
			if ($id > -1) {
				 $url = $url.'/'.$id; 
			}
			
					$ch = curl_init($url);                                                                      
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                                                                                       
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
					    'Content-Type: application/json',                                                                                
					    'gumgaToken:L28917560G1530708979570R-1673130305')                                                                    
					);                   
                                                                                            
				$result = curl_exec($ch);

				return $result;      
				                                                                                                        
		}
	}
 ?>