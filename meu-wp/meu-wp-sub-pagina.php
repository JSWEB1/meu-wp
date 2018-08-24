
<head>
    <meta charset="utf-8">
    <title>
        Teste
    </title>
    <!-- Latest compiled and minified CSS. -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <style>
        .card {
            width: 22%;
            margin: auto;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
    	function myFunction(message) 
    	{
		    alert(message);
		}
    </script>
</head>
<?php




	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    //------------------------------------------------------------------------------------------Responsável pelo POST dos campos--------------------------------------------------------------------------------------------//
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//


	if(isset($_POST))
	{
		if (isset($_POST['expprod'])) 
		{
			$post = new Posts();
			if(isset( $_POST['prodwoosku']) && $_POST['prodwoosku'] != '')
			{
				$post->postOneProd($_POST['prodwoosku']);
			}else
			{
				$post->postAllProd();
			}
		}
		if (isset($_POST['expevt']))
		{
			$post2 = new Posts();

			if(isset( $_POST['catwooid']) && $_POST['catwooid'] != '')
			{
				$post2->postOneCat($_POST['catwooid']);
			}else
			{
				$post2->postAllCat();
			}
			$post = new Posts();
			if(isset( $_POST['prodwoosku']) && $_POST['prodwoosku'] != '')
			{
				$post->postOneProd($_POST['prodwoosku']);
			}else
			{
				$post->postAllProd();
			}
		}

		if (isset($_POST['expcat'])) 
		{
			$post = new Posts();
			if(isset( $_POST['catwooid']) && $_POST['catwooid'] != '')
			{
				$post->postOneCat($_POST['catwooid']);
			}else
			{
				$post->postAllCat();
			}
		}
	}
?>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------Exportação de Categorias---------------------------------------------------------------------------------------------------------->
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<div class="panel panel-default" style="width:50%;margin:auto;box-shadow:.4px .4px 2px .4px black;margin-top:3%;">
	  <div class="panel-heading "style="text-align:center"><h3>Integração anymarket</h3></div>
	 	 <div class="panel-body">
			<!--Lista de opções -->    
	  		<ul class="nav nav-tabs">
	    			<li class="active"><a data-toggle="tab" href="#expcats">Exportar categorias</a></li>
	    			<li><a data-toggle="tab" href="#expprods">Exportar produtos</a></li>
	    			<li><a data-toggle="tab" href="#exporders">Exportar pedidos</a></li>
	  		</ul>  
	  		<!--Conteudo das tabs -->
	  			<div class="tab-content">
	  			<!--Exportação de categorias -->
	    				<div id="expcats" class="tab-pane fade in active">
						<br>
		 				<div class="alert alert-info"  style="text-align:center">
	  						Exportação de categorias
						</div>
			 			<!--Exportar todas as categorias -->
		  	 			<!--<form action="<?php /*echo plugin_url().'/meu-wp/integracao/'*/?>" method="post">-->
		  	 			<form action="" method="post">
	         				<dt style="text-align:center">
							<label style="">Limite por envio (20 a 100)<input type="text"  class="form-control" name="catwooli" value="<?php echo get_option('limit_catwoo');?>"/></label>
							<br><br>
							<button style="width:230px" type="submit"	class="btn btn-primary" id="expcat" name="expcat" >
							  <span class="glyphicon glyphicon-export"></span>
							  <b>Exportar todas</b>
							</button>
							<br>
							<br>
						</form>
						<br>
						<!--Exportar categorias especificas -->
		 				<div class="alert alert-info"  style="text-align:center">
	  						Exportação de categoria especifica
						</div>
						<form action="" method="post">
							<dt style="text-align:center">
							<label style=""> ID Especifico<input type="text"  class="form-control" name="catwooid" value="<?php echo get_option('id_catwoo');?>"/></label><br>		
							</dd>
							</dt>
							<br>
							<dt style="text-align:center">
							<button style="width:230px" type="submit"	class="btn btn-primary"name="Submit" >
							  <span class="glyphicon glyphicon-export"></span>
							  <b>Exportar</b>
							</button>
						</form>
	    			</div>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------Exportação de Produtos------------------------------------------------------------------------------------------------------------>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div id="expprods" class="tab-pane fade">
	<br>
	 	<div class="alert alert-info"  style="text-align:center">
  			Exportação de produtos
		</div>
	  <!--Exportar todos os produtos -->
      <form action="" method="post">
	         <dt style="text-align:center">
			 <label style="">Limite por envio(20 a 100)<input type="text"  class="form-control" name="prodwooli" value="<?php echo get_option('limit_prodwoo');?>"/></label><br><br>
			<button style="width:230px" type="submit"	class="btn btn-primary" id="expprod" name="expprod" >
		    <span class="glyphicon glyphicon-export"></span>
			 <b>Exportar todos</b>
			 </button>
			<br>
			<br>
		</form>
		<br>
		<!--Exportar produtos especificos -->
		<form action="" method="post">
	 	<div class="alert alert-info"  style="text-align:center">
  			Exportação de produto especifico
		</div>
			<dt style="text-align:center">
			<label style=""> SKU Especifico<input type="text"  class="form-control" name="prodwoosku" value="<?php echo get_option('sku_prodwoo');?>"/></label><br>		
			</dd>
			</dt>
			<br>
			<dt style="text-align:center">
			<button style="width:230px" type="submit" class="btn btn-primary"  id="expprod" name="expprod" >
			<span class="glyphicon glyphicon-export"></span>
			<b>Exportar</b>
			</button>
		</form>
    </div>
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------Exportação de Pedidos------------------------------------------------------------------------------------------------------------->
	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div id="exporders" class="tab-pane fade">
	<br>
		<div class="alert alert-info"  style="text-align:center">
  			Exportação de pedidos
		</div>
		<br>
	  <!--Exportar todos os pedidos -->
       <form action="" method="post">
			<dt style="text-align:center">
			<button style="width:230px" type="submit"	 class="btn btn-primary" id="exporders" name="exporders">
			<span class="glyphicon glyphicon-export"></span>
			<b>Exportar todos</b>
			</button>
			<br>
		</form>
		<br>
		<br>
		<!--Exportar pedidos especificos -->
	 	<div class="alert alert-info"  style="text-align:center">
  			Exportação de pedido específico
		</div>
			<form action="" method="post">
				<dt style="text-align:center">
				<label style=""> ID do pedido<input type="text"  class="form-control" name="orderswooid" value="<?php echo get_option('id_orderswoo');?>"/></label><br>		
				</dd>
				</dt>
				<br>
				<dt style="text-align:center">
				<button style="width:230px" type="submit"	class="btn btn-primary" name="Submit" >
				<span class="glyphicon glyphicon-export"></span>
				 <b>Exportar</b>
				</button>
			</form>
    	</div>
    	<div style="position:absolute; margin-left: 65%;margin-top: -500px">
	<form action="" method="post" id="formenv">
	<button style="width:60px" type="submit"	 class="btn btn-primary" id="expevt" name="expevt">
		 <dt style="text-align:center">
			<span class="glyphicon glyphicon-export"></span>
			<b></b>
			</button>
</form>

</div>

<script>
$('#expevt').on('click', function(){
   alert('Aqui você vai fazer seu ajax enviar' )
   //$.ajax()
})
</script>
    </div>
  </div>
</div>
