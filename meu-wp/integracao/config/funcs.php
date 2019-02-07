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

		function contains($value, $array){
			foreach ($array as $val) {
				if ($val == $value) {
					return true;
				}
			}
			return false;
		}

		function getDatetimeNow() {
		    $tz_object = new DateTimeZone('Brazil/East');
		    //date_default_timezone_set('Brazil/East');

		    $datetime = new DateTime();
		    $datetime->setTimezone($tz_object);
		    return $datetime->format('Y\-m\-d\ h:i:s');
		}
	}
 ?>