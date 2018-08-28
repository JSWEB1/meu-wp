<?php 

	/**
	 * 
	 */
	class Funcs
	{

		function notNull($value, $default)
		{
			return $value == null ? $default : $value;
		}
	}

 ?>