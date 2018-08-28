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

		function fixSCh($str)
		{
			$str = trim($str, '<p>');
			$str = trim($str, '</p>');
			$str = trim($str, '\\n');
			$str = trim($str, '\\r');
			$str = trim($str, '\n');
			$str = trim($str, '\r');
			$str = trim($str, '<br>');
			$str = trim($str, '</br>');
			$str = trim($str, '\\n\\r');
			$str = trim($str, '\n\r');
			$str = str_replace("\\n", "", $str);
			while (strpos($str, "  ") || strpos($str, "\\n")|| strpos($str, "\n")|| strpos($str, "\\r")|| strpos($str, "\r")|| strpos($str, "\\n\\r") || strpos($str, "\n\r") || strpos($str, "\\r\\n") || strpos($str, "\r\n") || strpos($str, "<p>") || strpos($str, "</p>")) {
				if (strpos($str, "  ")) {
					$str = str_replace("  ", " ", $str);
				}
				if (strpos($str, "\\n\\r")) {
					$str = str_replace("\\n\\r", "", $str);
				}
				if (strpos($str, "\n\r")) {
					$str = str_replace("\n\r", "", $str);
				}
				if (strpos($str, "\\n")) {
					$str = str_replace("\\n", "", $str);
				}
				if (strpos($str, "\n")) {
					$str = str_replace("\n", "", $str);
				}
				if (strpos($str, "\\r")) {
					$str = str_replace("\\r", "", $str);
				}
				if (strpos($str, "\r")) {
					$str = str_replace("\r", "", $str);
				}
				if (strpos($str, "\\r\\n")) {
					$str = str_replace("\\r\\n", "", $str);
				}
				if (strpos($str, "\r\n")) {
					$str = str_replace("\r\n", "", $str);
				}
				if (strpos($str, "<p>")) {
					$str = str_replace("<p>", "", $str);
				}
				if (strpos($str, "</p>")) {
					$str = str_replace("</p>", "", $str);
				}
			}
		}
	}
 ?>