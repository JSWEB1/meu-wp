<?php 
	class Funcs
	{
		function notNull($value, $default)
		{
			return $value == null || $value == '' ? $default : $value;
		}
		/**
		*E-echo
		*P-print_r
		*V-var_dump
		*/
		function divBorder($content, $style = "solid", $color = "red", $radius = "5px")
		{
			return "<div style='border-style: ".$style."; border-width: 5px; border-color: ".$color."; border-radius: ".$radius.";'>".$content."</div>";
		}
	}
 ?>