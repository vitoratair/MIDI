<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Modelos  <small>cadastrados</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Pesquisa <span class="divider"> / </span></li>
            <li class="active">Adicionar</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<?php
		$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
		echo form_open('model/listAll', $atributos); 
	?>	

		<p align="right">
			<a href="<?php echo base_url();?>index.php/model/addModel" class="btn-u"><i class="icon-plus icon-white"></i> Modelo</a>
		</p>
		
		<p align="right">
			<input type="text" class="span2 search-query" placeholder="Busca de modelo..." name="buscaModelo">		
			<button type="submit" class="btn-u"><i class="icon-search icon-white"></i> Buscar</button>								
		</p>		
	
	</form>

	<table class="table table-striped">					
							
		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('model/listModel', $atributos); 
		?>				

			<div class="control-group">
				<div class="controls">

					<select id="categoria" name="categoria" class="span2">
						
							<option value=""> Categoria</option>
						{categorias}		
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>

					<select id="marca" onchange="this.form.submit()" name="marca" class="span2">
						
							<option value=""> Marca</option>
						{marcas}		
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>				    

				</div>
			</div>
	
	</form>
	
	<table class='table table-bordered table-hover' id="idTabela">
			
			<tr class="">				
				<td width="5%"><b>ID</b></td>
				<td width=""><b>Modelo</td>
				<td width=""><b>Sinônimo</td>
				<td width=""><b>Sinônimo</td>
				<td width=""><b>Marca</td>
				<td width=""><b>Categoria</td>
				<td width="8%"><b>Encontrado</td>
				<td width="8%"><b>Editar</b></td>
				<td width="8%"><b>Excluir</b></td>
			</tr>			

			{modelos}
			
			<tr class="table-condensed">	
				<td>{MOID}</td>
				<td>{MNome}</td>
				<td>{MNome1}</td>
				<td>{MNome2}</td>
				<td>{MANome}</td>
				<td>{CNome}</td>			
				<td><i class="{CHECK}"></i></td>				
				<td><a href="<?php echo base_url();?>index.php/model/editModel/{MOID}" class='icon-edit'> <a/></td>
				<td><a onclick='Remove("{MOID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>

			{/modelos}
	
	</table> 
	
	<div align="center">
		{links}
	</div>

</div>

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Exclusão de modelo</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir o modelo?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>

<script type="text/javascript">

function Remove(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="<?php echo base_url();?>index.php/model/deleteModel/"+id;

}	

</script>


