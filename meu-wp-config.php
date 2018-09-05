<head>
    <meta charset="utf-8">
     <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
    <style>
        .card{
            width: 50%;
            margin: auto;
        }
        #footer-thankyou{
        	display:none;
        }
        #footer-upgrade{
        	display:none;
        }
    </style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<?php
	require_once (MEUWP__DIR.'integracao/config/funcs.php');
	require_once (MEUWP__DIR.'integracao/config/conn.php');
	$conn = new Connection();
if($_POST){
	if( isset( $_POST['tokenany']) &&$_POST['tokenany'] != ''){
		update_option('token_any', $_POST['tokenany']);
	}
	if(isset( $_POST['tokenany'])&& $_POST['tokenany'] == '' ){
		echo ('<div class="alert alert-danger" Style="width:98%;margin-left:1%;margin-top:1%"
 		 <strong>ATENÇÃO</strong> Você não pode deixar o campo "Token anymarket" vazio.
		</div>');
	}
	if( isset( $_POST['Key'])&& $_POST['Key'] != ''){
		 update_option('key_woo', $_POST['Key']);
	}
	if(isset( $_POST['Key'])&& $_POST['Key'] == '' ){
		echo ('<div class="alert alert-danger" Style="width:98%;margin-left:1;margin-top:1%%"
 		 <strong>ATENÇÃO</strong> Você não pode deixar o campo "Client Key" vazio.
		</div>');
	}
	if(isset( $_POST['secret'])&& $_POST['secret'] != '' ){
		 update_option('secret_woo', $_POST['secret']);
	}
	if(isset( $_POST['secret'])&& $_POST['secret'] == '' ){
		echo ('<div class="alert alert-danger" Style="width:98%;margin-left:1%;margin-top:1%"
 		 <strong>ATENÇÃO</strong> Você não pode deixar o campo "Client Secret" vazio.
		</div>');
	}
	if(isset( $_POST['oiany'])&& $_POST['oiany'] != '' ){
		 update_option('oi_any', $_POST['oiany']);
	}
	if(isset( $_POST['oiany'])&& $_POST['oiany'] == '' ){
		echo ('<div class="alert alert-danger" Style="width:98%;margin-left:1%;margin-top:1%"
 		 <strong>ATENÇÃO</strong> Você não pode deixar o campo "OI Anymarket" vazio.
		</div>');
	}
	if(isset($_POST['Submit'])){
		echo ('<div class="alert alert-success" Style="width:98%;margin-left:1%;margin-top:1%"
 		 			<strong>Sucesso</strong> Alterações salvas com sucesso 
	 		 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    					<span aria-hidden="true">&times;</span>
	  					</button>
				</div>');
	}
}
?>
<div class="panel panel-default" style="width:50%;margin:auto;box-shadow:.4px .4px 2px .4px black;margin-top:3%;">
  	<div class="panel-heading "style="text-align:center"><h3>Integração anymarket</h3></div>
 	<div class="panel-body">
		<ul class="nav nav-tabs">
		  	<li class="active"><a data-toggle="tab" href="#integraAny">Integração ANY</a></li>
			<li><a data-toggle="tab" href="#integraWoo">Woocommerce</a></li>
			<li><a data-toggle="tab" href="#Logs2">Logs</a></li>
		</ul>
		<div class="tab-content">
			<div id="integraAny" class="tab-pane fade in active">		
				<form action="" method="post">
				<dt>
					<br>
 					<b></b>
   					<div class="alert alert-info"  style="text-align:center">
  						<strong></strong> Informe aqui os dados de integração ANYMARKET
					</div>
 					<dd>
  						<label style="float:left">Token anymarket: </label>
				  		<input type="text"  class="form-control" name="tokenany" value="<?php echo get_option('token_any');?>"/>
				  		<br>
				    		<label style="float:left">OI anymarket: </label>
				    		<input type="text"  class="form-control" name="oiany" value="<?php echo get_option('oi_any');?>"/>

				 		<br>
 					</dd>
 				</dt>
				<dt style="text-align:center">
				<button style="float:left" type="submit"class="btn btn-primary" name="Submit" >
				<span class="glyphicon glyphicon-floppy-save"></span>
				<b>Salvar altera&ccedil;&otilde;es</b>
				</button>
				<br><br><br>
				<label style="float: left;">URL De callback de pedidos</label>
				<input type="text" style="font-size: 12px;" class="form-control" name="url_callback" id="url_callback" value="<?php echo get_option('siteurl') .'/wp-content/plugins/meu-wp/callback/Callback.php' ?>">
				
			
				</form>
			</div>

			<div id="integraWoo" class="tab-pane fade">
				<form action="" method="post">
					<dt>
					<br>
			 			<div class="alert alert-info"  style="text-align:center">
			  				<strong></strong> Informe aqui os dados de integração Woocommerce
						</div>
		 			<dd>
			  			<label style="float:left">Consumer Key</label>
			    			<input type="text"  class="form-control" name="Key" value="<?php echo get_option('key_woo');?>"/>
						<br>
						<label style="float:left">Consumer Secret</label>
						<input type="text"  class="form-control" name="secret" value="<?php echo get_option('secret_woo');?>"/>
						 <br>
		 			</dd>
		 			</dt>
					<dt style="text-align:center">
						<button style="float:left" type="submit"class="btn btn-primary" name="Submit" >
							<span class="glyphicon glyphicon-floppy-save"></span>
							<b>Salvar altera&ccedil;&otilde;es</b>
						</button>
				</form>
			</div>

			<script>
    		(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this), search = $this.val().toLowerCase(), target = $this.attr('data-filters'), $target = $(target), $rows = $target.find('tbody tr');
					if(search == '') {
						$rows.show(); 
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
	})(jQuery);

	$(function(){
	    // attach table filter plugin to inputs
		$('[data-action="filter"]').filterTable();
		
		$('.container').on('click', '.panel-heading span.filter', function(e){
			var $this = $(this), 
					$panel = $this.parents('.panel');
			
			$panel.find('.panel-body').slideToggle();
			if($this.css('display') != 'none') {
				$panel.find('.panel-body input').focus();
			}
		});
		$('[data-toggle="tooltip"]').tooltip();
	})
    </script>
			<div id="Logs2" class="tab-pane fade">
				  		<?php 
				  			require_once(STORE__DIR.'wp-config.php');
				  			require_once (MEUWP__DIR.'integracao/config/conn.php');
				  			if(!isset($wpdb)){
				  				global $wpdb;
				  			}
							$sql = "select ID_WOO,
							CASE
							When TYPE = 'C' then 'Categoria'
							end as type
							from {$wpdb->prefix}IDWOOTOANY ";
							$result = $wpdb->get_results($sql);
							$exibe = json_decode(json_encode($result), true);
							echo "<input type='text' class='form-control' id='dev-table-filter' data-action='filter' data-filters='#dev-table' placeholder='Buscar' />";
							
							echo "<div style='heigth:150px;width:100%'>";
							echo "<div style='height:250px;overflow: auto;'>";
							echo "<table class='table table-hover'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th>ID</th>";
							echo "<th>Tipo</th>";
							echo "</tr>";
							echo "</thead>";
							foreach ($exibe as $IDZAO) {
								echo("<tr>");
								echo "<td>".$IDZAO['ID_WOO']."</td>";
								echo "<td>".$IDZAO['type']."</td>";
								echo("</tr>");
							}
							
							echo "</table>";
							echo "</div>";
							echo "</div>";

						?>
					</div>
			</div>
		</div>
	</div>
</div>