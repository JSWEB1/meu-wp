<?php
/*
Plugin Name: Integração Anymarket
Plugin URI: Não definido
Description: Este plugin serve para integrar sua loja virtual com o Anymarket
Version: 1.0
Author: JS WEB 
Author URI: www.glsweb.com.br
*/
//Declare aqui as Constantes.'


define( 'MEUWP__DIR', plugin_dir_path( __FILE__ ) );
//var_dump(MEUWP__DIR);
define( 'MEUWP__URL', site_url().'/wp-content/plugins/meu-wp/');
//var_dump(MEUWP__URL);
define( 'STORE__URL', site_url() );
define( 'STORE__DIR', ABSPATH);
class Posts{
	function Echo($message){
		$message = '<h1>'.$message.'</h1>';
		echo '<h1>'.$message.'</h1>';	
	}
	function Alert($message){
		$message = '<script>myFunction("'.$message.'");</script>';
		return $message;	
	}

// time() + 3600 = one hour from now.

	function postOneProd($id){
		require_once MEUWP__DIR.'integracao/products.php';
		$prods = new Products();
		$prods->post($id);
	}
	function postAllProd(){
	require_once MEUWP__DIR.'integracao/products.php';
	$x = 1;
	$prods = new Products();
	$prods->post();
}
	function postAllCat(){
		require_once MEUWP__DIR.'integracao/category.php';
		$prods = new Category();
		$prods->post();
	}
	function postOneCat($id){
		require_once MEUWP__DIR.'integracao/category.php';
		$prods = new Category();
		$prods->post($id);
	}
}
class MeuWoo{ 
		public function ativar1(){
				add_option('secret_woo', '');
		}
		public function desativar1(){
				delete_option('secret_woo');
		}
		public function ativar2(){
				add_option('key_woo', '');
		}
		public function desativar2(){
				 delete_option('key_woo');
		}
		public function ativar3(){
			 	add_option('limit_catwoo', '');
		}
		public function desativar3(){
			 	delete_option('limit_catwoo');
		}
		public function ativar4(){
			 	add_option('id_catwoo', '');
		}
		public function desativar4(){
				delete_option('id_catwoo');
		}
		public function ativar5(){
				add_option('limit_prodwoo','');
		}
		public function desativar5(){
				delete_option('limit_prodwoo');
		}
		public function ativar6(){
				add_option('sku_prodwoo','');
		}
		public function desativar6(){
				delete_option('sku_prodwoo');
		}
		public function ativar7(){
				add_option('id_orderswoo','');
		}
		public function desativar7(){
				delete_option('id_orderswoo');
		}
 //Função de POST do Client secret WooCommerce
 public function adicionaFrase1($PostDoSecret){
	 $secretwoo = get_option('secret_woo');
	 
		if( strlen( $secretwoo ) > 0 ){
	 	//Vamos dar um estilo pra diferenciar do resto!
		 $secretwoo = '<span style="color: #f00; font-size: 18px;">'.$secretwoo.'</span>';
	 
		return $secretwoo."<br /><br />".$PostDoSecret;
	 }
		else{
			 return $PostDoSecret;
	 }
 }
 
 //Função de POST do Client Key WooCommerce
 public function adicionaFrase2($PostDoKey){
	 $keywoo = get_option('key_woo');
	 
	if( strlen( $keywoo ) > 0 ){
	 //Vamos dar um estilo pra diferenciar do resto!
	 $keywoo = '<span style="color: #f00; font-size: 18px;">'.$keywoo.'</span>';
	 
	return $keywoo."<br /><br />".$PostDoKey;
	 }
	else{
	 	return $PostDoKey;
	 }
 }
 
  //Função de POST do Limite de envia das categorias do WooCommerce para Anymarket
   public function adicionaFrase3($PostDoLimitCatWoo){
	 $catwooli = get_option('limit_catwoo');	 
	 
	if( strlen( $catwooli ) > 0 ){
	 //Vamos dar um estilo pra diferenciar do resto!
	 $catwooli = '<span style="color: #f00; font-size: 18px;">'.$catwooli.'</span>';
	 
	return $catwooli."<br /><br />".$PostDoLimitCatWoo;
	 }else{
	 	return $PostDoLimitCatWoo;
	 }
 }

 //Função de POST do  ID da categoria para exportação
   public function adicionaFrase4($PostDoIDCatWoo){
	 $catwooid = get_option('id_catwoo');
	 
		if( strlen( $catwooid ) > 0 ){
	 		//Vamos dar um estilo pra diferenciar do resto!
	 		$catwooid = '<span style="color: #f00; font-size: 18px;">'.$catwooid.'</span>';
	 
			return $catwooid."<br /><br />".$PostDoIDCatWoo;
	 }
	else{
		return $PostDoIDCatWoo;
	 }
 }
 
  //Função de POST do  ID da categoria para exportação
   public function adicionaFrase5($PostDoLimitProdWoo){
	 $prodwooli = get_option('limit_prodwoo');
	 
		if( strlen( $prodwooli ) > 0 ){
	 		//Vamos dar um estilo pra diferenciar do resto!
	 		$prodwooli = '<span style="color: #f00; font-size: 18px;">'.$prodwooli.'</span>';
	 
			return $prodwooli."<br /><br />".$PostDoLimitProdWoo;
	 }else{
	 		return $PostDoLimitProdWoo;
	 }
 }

  //Função de POST do  ID da categoria para exportação
   public function adicionaFrase6($PostDoSkuProdWoo){
	 $prodwoosku = get_option('sku_prodwoo');
	 
		if( strlen( $prodwoosku ) > 0 ){
	 		//Vamos dar um estilo pra diferenciar do resto!
	 		$prodwoosku = '<span style="color: #f00; font-size: 18px;">'.$prodwoosku.'</span>';
	 
			return $prodwoosku."<br /><br />".$PostDoSkuProdWoo;
	 }else{
	 		return $PostDoSkuProdWoo;
	 }
 }
 
   //Função de POST do  ID da do pedido para exportação
   public function adicionaFrase7($PostDoIDOrderWoo){
	 $orderswooid= get_option('id_orderswoo');
	 
		if( strlen( $orderswooid ) > 0 ){
	 		//Vamos dar um estilo pra diferenciar do resto!
	 		$orderswooid = '<span style="color: #f00; font-size: 18px;">'.$orderswooid.'</span>';
	 
			return $orderswooid."<br /><br />".$PostDoIDOrderWoo;
	 }else{
	 		return $PostDoIDOrderWoo;
	 }
 }
}

//Classe com Informações do Anymarket
class MeuAny{

	 public function ativar(){
	 	add_option('token_any', '');
	 }
	 public function desativar(){
	 	delete_option('token_any');
	 }
	 public function ativar2(){
	 	add_option('oi_any', '');
	  }
	  public function desativar2(){
	  	delete_option('oi_any');
	  }
	  public function criarMenu(){
	 
	 add_menu_page('Integração Anymarket', 'Integração Anymarket',10, 'meu-wp/meu-wp-config.php');
	 
	 add_submenu_page('meu-wp/meu-wp-config.php', 'Opções de exportação', 'Opções de exportação', 10, 'meu-wp/meu-wp-sub-pagina.php');
	 
	 }
	 
  //Função de POST do Token Anymarket
 public function adicionaFrase($PostDoToken){
 	$tokenany = get_option('token_any');
 
 if( strlen( $tokenany ) > 0 ){
 	//famos dar um estilo pra diferenciar do resto!
 	$tokenany = '<span style="color: #f00; font-size: 18px;">'.$tokenany.'</span>';
 
 return $tokenany."<br /><br />".$PostDoToken;
 	}
 else{
 	return $PostDoToken;
 	}
 }
 
   //Função de POST do OI Anymarket
  public function adicionaFrase1($PostDoOi){
	 $oiany = get_option('oi_any');
	 
if( strlen( $oiany ) > 0 ){
	 //Vamos dar um estilo pra diferenciar do resto!
	 $oiany = '<span style="color: #f00; font-size: 18px;">'.$oiany.'</span>';
	 
return $oiany."<br /><br />".$PostDoOi;
	 }
else{
	 return $PostDoOi;
	 }
 }
}
 
$pathPlugin = substr(strrchr(dirname(__FILE__),DIRECTORY_SEPARATOR),1).DIRECTORY_SEPARATOR.basename(__FILE__);
 
// Função ativar
register_activation_hook( $pathPlugin, array('MeuAny','ativar'));
register_activation_hook( $pathPlugin, array('MeuAny','ativar2'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar1'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar2'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar3'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar4'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar5'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar6'));
register_activation_hook( $pathPlugin, array('MeuWoo','ativar7'));

// Função desativar
register_deactivation_hook( $pathPlugin, array('MeuAny','desativar'));
register_deactivation_hook( $pathPlugin, array('MeuAny','desativar2'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar1'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar2'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar3'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar4'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar5'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar6'));
register_deactivation_hook( $pathPlugin, array('MeuWoo','desativar7'));
 
//Ação de criar menu
add_action('admin_menu', array('MeuAny','criarMenu'));
 
//Filtro do conteúdo
//add_filter("the_content", array("MeuAny","adicionaFrase"));
//Filtro do conteúdo









#####################################################################


// The activation hook
// print "hey";
// function isa_activation(){
// 	print "isa_activation";
// 	if( !wp_next_scheduled( 'postAllProd' ) ){
// 		wp_schedule_event( time(), 'every_three_minutes', 'postAllProd' );
// 	}
// }
// register_activation_hook(   __FILE__, 'isa_activation' );

// // The deactivation hook
// function isa_deactivation(){
// 	if( wp_next_scheduled( 'postAllProd') ){
// 		wp_clear_scheduled_hook( 'postAllProd' );
// 	}
// }
// register_deactivation_hook( __FILE__, 'isa_deactivation' );


// // The schedule filter hook
// function isa_add_every_three_minutes( $schedules ) {
// 	$schedules['every_three_minutes'] = array(
// 		'interval'  => 180,
// 		'display'   => __( 'Every 3 Minutes', 'textdomain' )
// 	);

// 	return $schedules;
// }
// add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );

//  Schedule de produtos
add_filter( 'cron_schedules', 'isa_postAllProd' );
function isa_postAllProd( $schedules ) {
	$schedules['postAllProd'] = array(
		'interval'  => 180,
		'display'   => __( 'Every 3 Minutes', 'textdomain' )
	);

	return $schedules;
}

if ( ! wp_next_scheduled( 'isa_postAllProd' ) ) {
    wp_schedule_event( time() + 5, 'postAllProd', 'isa_postAllProd' );
}

add_action( 'isa_postAllProd', 'postAllProdFun' );
function postAllProdFun(){
	require_once MEUWP__DIR.'integracao/products.php';
	$x = 1;
	$prods = new Products();
	$prods->post();
}

//Schedule de categorias
add_filter( 'cron_schedules', 'isa_postAllCat' );
function isa_postAllCat( $schedules ) {
	$schedules['postAllCat'] = array(
		'interval'  => 180,
		'display'   => __( 'Every 3 Minutes', 'textdomain' )
	);

	return $schedules;
}

if ( ! wp_next_scheduled( 'isa_postAllCat' ) ) {
    wp_schedule_event( time() + 5, 'postAllCat', 'isa_postAllCat' );
}

add_action( 'isa_postAllCat', 'postAllCatFun' );
	function postAllCatFun(){
		require_once MEUWP__DIR.'integracao/category.php';
		$prods = new Category();
		$prods->post();
	}
?>