<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Cadastro <small>de subcategoria na categoria, </small>{categoriaNome}{CNome}{/categoriaNome}</h2>
	<hr>

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('categoria/setSubcategoria', $atributos); 
	?>

		<fieldset>
			
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="idCategoria" value='{idCategoria}' name="idCategoria">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Subcategoria</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="subcategoria" placeholder="Nome da subcategoria" name="subcategoria" rel="popover" 
					data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			

			<div class="control-group">
				<label class="control-label" for="">Índice</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="indice" placeholder="Índice da subcategoria" name="indice" rel="popover" 
					data-content="Deve possuir o valor entre 1 e 8" data-original-title="Descrição" autocomplete="off">
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>
		
		</fieldset>	
		</form>	 

	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped table-hover'>
			
			<tr class="">				
				<td width="7%"><b>Índice</b></td>
				<td><b>Subcategoria</td>
				<td width="6%"><b>Editar</td>
				<td width="6%"><b>Itens</td>
				<td width="6%"><b>Excluir</td>
			</tr>			

			{titulos}
			<tr class="table-condensed">
				<td>{TColuna}</td>
				<td>{TNome}</td>
				<td><a href="../editSubcategoria/{TID}" class='icon-edit'> <a/></td>
				<td><a href="../addItem/{TID}/{Categoria_CID}/{TColuna}" class='icon-plus'> <a/></td>
				<td><a onclick='Remove("{TID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/titulos}
	
	</table>

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a subcategoria ?</p>
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
	document.getElementById('Excluir').href="../deleteSubcategoria/"+id;

}	

</script>






