<div class="clean">
	
	<!--=== Breadcrumbs ===-->
	<div class="row-fluid breadcrumbs margin-bottom-40">
		<div class="container">
	        <h1 class="pull-left">Marcas  <small>cadastradas</small></h1>
	        <ul class="pull-right breadcrumb">
	            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
	            <li>Pesquisa <span class="divider"> / </span></li>
	            <li class="active">Marcas</li>
	        </ul>
	    </div><!--/container-->
	</div><!--/breadcrumbs-->


	<div class="container">

		<p align="right">
			<a href="<?php echo base_url();?>/index.php/brand/setBrandView" class="btn-u"><i class="icon-plus icon-white"></i> Nova marca</a>	  	
		</p>

		<?php
			$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
			echo form_open('brand/listAll', $atributos); 
		?>		
					
		<input type="text" class="span2 search-query" placeholder="Busca de marca..." name="buscaMarca">
		<button type="submit" class="btn-u">				
		<i class="icon-search icon-white"></i>&nbsp;&nbsp;Buscar</button>			
		
		</form>
										
		<table class='table table-bordered table-hover' id="idTabela">
				
			<thead>
				<tr class="">				
					<td width="7%"><b>ID</b></td>
					<td width=""><b>Marca</td>
					<td width=""><b>Sinônimo</td>
					<td width=""><b>Sinônimo</td>
					<td width="6%"><b>Editar</b></td>
				</tr>			
			</thead>	

				{marcas}
				<tr class="table-condensed">	
					<td>{MAID}</td>
					<td>{MANome}</td>
					<td>{MANome1}</td>
					<td>{MANome2}</td>									
					<td><a href="<?php echo base_url();?>index.php/brand/editBrand/{MAID}" class='icon-edit'> <a/></td>
				</tr>
				
				{/marcas}
		</table> 

		<!-- Exibe os links para paginação -->
		<div align="center">
	    	 {links}
	    </div>

	</div>	

</div>
