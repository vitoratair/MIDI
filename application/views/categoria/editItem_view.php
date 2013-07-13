<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Edição <small>de itens</small></h2>
	<hr>


		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('categoria/updateItem', $atributos); 
		?>	  
			{itens}
			<div class="control-group">
				<label class="control-label" for="">Item</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="subcategoriaitem" value="{SCNome}" name="subcategoriaitem" rel="popover" 
					data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Item" autocomplete="off">
				</div>			
			</div>
			
				<input type="hidden" name="id" value="{SCID}">
				<input type="hidden" name="coluna" value="{coluna}">
				<input type="hidden" name="idCategoria" value="{Categoria_CID}">
				<input type="hidden" name="subcategoria" value="{subcategoria}">

			{/itens}
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>			





<!-- FIM -->






