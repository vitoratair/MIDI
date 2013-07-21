<!-- Estrutura -->
<div class="container">

	<table class="table table-striped">					
		
		<div class="page-header">
			
			<h2>Modelos <small> cadastradas no sistema referentes a marca </small>{marca}{MANome}{/marca}</h2>				

		</div>						

	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCategoria', 'method'=>'POST');
		echo form_open('marca/modelos', $atributos); 
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

	<table class='table table-bordered table-striped' id="idTabela">
			
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
			
			<tr>	
				<td>{MOID}</td>
				<td>{MNome}</td>
				<td>{MNome1}</td>
				<td>{MANome}</td>
				<td>{CNome}</td>			
				<td><i class="{CHECK}"></i></td>				
				<td><a href="<?php echo base_url();?>index.php/modelo/editModelo/{MOID}" class='icon-edit'> <a/></td>
				<td><a onclick='' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
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
		<p>Deseja realmente excluir a categoria ?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#teste')
		alert('asd');
	});

</script>


