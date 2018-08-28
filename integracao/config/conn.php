<?php 
	require_once (STORE__DIR.'wp-config.php');
	class Connection{
		public function __construct(){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			if (!$this->tableExists('IDWOOTOANY')) {
				$query = "CREATE TABLE {$wpdb->prefix}IDWOOTOANY(
							ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
							TYPE VARCHAR(5) NOT NULL,
							ID_WOO INT NOT NULL,
							ID_ANY INT NOT NULL,
							SYNC VARCHAR(5) NOT NULL
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
		public function saveVinc($type, $idWoo, $idAny, $sync = 'N'){
			/*
			*C->Categorias
			*P->Produtos
			*O->Pedidos/Orders
			*/
			if (!isset($wpdb)) {
				global $wpdb;
			}
			$return = $wpdb->get_results("insert into {$wpdb->prefix}IDWOOTOANY (TYPE, ID_WOO, ID_ANY, SYNC) values ('{$type}', {$idWoo}, {$idAny}, '{$sync}')", OBJECT);
			return $return;
		}
		public function getVincByWoo($type, $id)
		{
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
	}
?>