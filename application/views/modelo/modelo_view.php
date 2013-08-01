<!-- Estrutura -->
<div class="container">

	<div class="page-header">
		
		<h2>Modelos <small> lista de modelos cadastradas no sistema</small></h2>				

	</div>

	<!-- Buscador  + Adicionar nova marca-->
		
		<?php
			$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
			echo form_open('modelo/listAll', $atributos); 
		?>		
		
		<input type="text" class="input-xlarge search-query" placeholder="Busca de modelo..." name="buscaModelo">
		<button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Buscar</button>		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		<a href="<?php echo base_url();?>index.php/modelo/addModelo" class="btn btn-success"><i class="icon-plus icon-white"></i> Novo Modelo</a>	  
	
	</form>


	<table class="table table-striped">					
							
		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('modelo/listModeloByCategoria', $atributos); 
		?>		
			
			<fieldset>

			<div class="control-group">
				<div class="controls">

					<select id="categoria" onchange="this.form.submit()" name="categoria" class="input-xlarge">
						
							<option value=""> Selecione uma categoria</option>
						{categorias}		
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>

				</div>
			</div>
	
		</fieldset>
	</form>

	<table class='table table-bordered table-hover table-striped' id="idTabela">
			
			<tr class="">				
				<td width="5%"><b>ID</b></td>
				<td width=""><b>Modelo</td>
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
				<td>{MANome}</td>
				<td>{CNome}</td>			
				<td><i class="{CHECK}"></i></td>				
				<td><a href="<?php echo base_url();?>index.php/modelo/editModelo/{MOID}" class='icon-edit'> <a/></td>
				<td><a onclick='Remove("{MOID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>

			{/modelos}
	
	</table> 
	
	<div align="center">
		{links}
	</div>


<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir o modelo ?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">

function Remove(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="<?php echo base_url();?>index.php/modelo/deleteModelo/"+id;

}	

</script>


