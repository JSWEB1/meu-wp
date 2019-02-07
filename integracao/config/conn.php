<?php 
	require_once (STORE__DIR.'wp-config.php');
	require_once (MEUWP__DIR.'integracao/config/funcs.php');
	class Connection{
		public function __construct(){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			if (!$this->tableExists('IDWOOTOANY')) {
				$query = "CREATE TABLE {$wpdb->prefix}IDWOOTOANY(
							ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
							TYPE VARCHAR(5) NOT NULL,
							DESCRIPTION VARCHAR(50),
							ID_WOO INT NOT NULL,
							ID_ANY INT NOT NULL,
							SYNC VARCHAR(5) NOT NULL,
							DATE_TIME DATETIME NOT NULL
							);";
				$results = $wpdb->get_results($query, OBJECT);
			}
		}
		public function tableExists($table){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			if (!defined('DB_NAME')) {
				require_once (STORE__DIR.'wp-config.php');
			}
			$results = $wpdb->get_results("select count(*) count from information_schema.tables where `TABLE_SCHEMA` = '".DB_NAME."' and `TABLE_NAME` = '{$wpdb->prefix}".$table."'", OBJECT);
			$count = json_decode(json_encode($results[0]), true)["count"];
			if ($count > 0) {
				return true;
			}else{
				return false;
			}
		}
		public function saveVinc($type, $idWoo, $idAny, $sync = 'N', $description = ''){
			/*
			*C->Categorias
			*P->Produtos
			*O->Pedidos/Orders
			*/
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$F = new Funcs();

			$return = $wpdb->get_results("insert into {$wpdb->prefix}IDWOOTOANY (TYPE, DESCRIPTION, ID_WOO, ID_ANY, SYNC, DATE_TIME) values ('{$type}', '{$description}', {$idWoo}, {$idAny}, '{$sync}', '{$F->getDatetimeNow()}')", OBJECT);
			return $return;
		}
		public function getVincByWoo($type, $id){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$sql = "select max(ID_ANY) as ID_ANY from {$wpdb->prefix}IDWOOTOANY where ID_WOO = {$id} and TYPE = '{$type}'";
			//print_r($sql);
			$return = $wpdb->get_results($sql, OBJECT);
			
			return json_decode(json_encode($return[0]), true)["ID_ANY"];
		}
		
		public function getVincByAny($type, $id)
		{
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$sql = "select max(ID_WOO) as ID_WOO from {$wpdb->prefix}IDWOOTOANY where ID_ANY = {$id} and TYPE = '{$type}'";
			$return = $wpdb->get_results($sql, OBJECT);
			return json_decode(json_encode($return[0]), true)["ID_WOO"];
		}
		
		//Get conferencia do SYNC
		public function getConfSync($type)
		{
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$sql = "select ID_WOO from {$wpdb->prefix}IDWOOTOANY where SYNC = 'N' and TYPE = '{$type}'";
			$return = $wpdb->get_results($sql, OBJECT);
			return json_decode(json_encode($return), true);
		}

		public function getProdIDBySku($sku)
		{
			if (!isset($wpdb)) {
				global $wpdb;
			}
		  	$id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );

		  	if ($id) {
		  		return $id;
		  	}
		  	return null;
		}

		public function toSend($TYPE, $LIMIT = -1){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$post_type = '';
			switch ($TYPE) {
				case 'P':
					$post_type = 'product';
					break;
				case 'C':
					$post_type = '';
					break;
				case 'O':
					$post_type = '';
					break;
				
				default:
					$post_type = '';
					break;
			}

			$sql = "";
			$sql .= "SELECT DISTINCT ";
			$sql .= "	{$wpdb->prefix}posts.ID ";
			$sql .= "FROM ";
			$sql .= "	{$wpdb->prefix}posts ";
			$sql .= "WHERE ";
			$sql .= "	{$wpdb->prefix}posts.post_type = '{$post_type}' AND ";
			$sql .= "    ( ";
			$sql .= "        NOT EXISTS ";
			$sql .= "        (";
			$sql .= "            SELECT ";
			$sql .= "                {$wpdb->prefix}idwootoany.ID_WOO ";
			$sql .= "            FROM ";
			$sql .= "                {$wpdb->prefix}idwootoany ";
			$sql .= "            WHERE ";
			$sql .= "                {$wpdb->prefix}idwootoany.ID_WOO = {$wpdb->prefix}posts.ID ";
			if ($post_type != '') {
				$sql .= "                AND {$wpdb->prefix}idwootoany.TYPE = '{$TYPE}' ";
			}
			$sql .= "        ) ";
			if ($post_type != '') {
				$sql .= "        OR ";
				$sql .= "        EXISTS ";
				$sql .= "        (";
				$sql .= "            SELECT ";
				$sql .= "                {$wpdb->prefix}idwootoany.ID_WOO ";
				$sql .= "            FROM ";
				$sql .= "                {$wpdb->prefix}idwootoany ";
				$sql .= "            WHERE ";
				$sql .= "                {$wpdb->prefix}idwootoany.ID_WOO = {$wpdb->prefix}posts.ID ";
					$sql .= "                AND {$wpdb->prefix}idwootoany.TYPE = '{$TYPE}'  ";
				$sql .= "                AND {$wpdb->prefix}idwootoany.SYNC = 'N' ";
				$sql .= "        ) ";
			}
			$sql .= "    ) ";
			if ($LIMIT > -1) {
				$sql .= "    LIMIT ".$LIMIT;
			}
			echo "<br> ";
			echo "<br> ";
			echo "<br> ";
			print_r($sql);
			echo "<br> ";
			echo "<br> ";
			echo "<br> ";
			$return = $wpdb->get_results($sql, OBJECT);
			return json_decode(json_encode($return), true);
		}

		public function returnOneValue($sql, $field)
		{
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$return = $wpdb->get_results($sql, OBJECT);
			return json_decode(json_encode($return[0]), true)["field"];
		}
	}
?>