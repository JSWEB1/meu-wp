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
			return $result;             
		}
	}
 ?>