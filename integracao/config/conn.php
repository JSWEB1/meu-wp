<?php 
	require_once (STORE__DIR.'wp-config.php');
	
	class Connection{
		
		public function __construct(){
			if (!isset($wpdb)) {
				global $wpdb;
			}
			if (!$this->tableExists('IDWOOTOANY')) {
				$results = $wpdb->get_results( " CREATE TABLE {$wpdb->prefix}IDWOOTOANY(
														TIPO VARCHAR(5) NOT NULL,
														ID_WOO INTEGER NOT NULL,
														ID_ANY INTEGER NOT NULL
														); ", OBJECT);
				echo 'criou';
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
			$array = array($results[0]);
			var_dump($results[0]);
			var_dump($array[0]);
			if ($results > 0) {
				echo 'ja tem';
				this-> populeByAny(){
					
				}
				return true;
			}else{
				return false;
			}
		}

		public function populeByAny(){

		}
	}

	$con = new Connection();
	

?>