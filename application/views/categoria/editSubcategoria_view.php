<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Edição <small>de subcategoria</small></h2>
	<hr>

		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('categoria/updateSubcategoria', $atributos); 
		?>
		<fieldset>
			{subcategoria}
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="idCategoria" value='{Categoria_CID}' name="idCategoria">
					<input type="hidden" class="input-xlarge" id="id" value='{TID}' name="id">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Subcategoria</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="subcategoria" value="{TNome}" name="subcategoria" rel="popover" 
					data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			

			<div class="control-group">
				<label class="control-label" for="">Índice</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="indice" value="{TColuna}" name="indice" rel="popover" 
					data-content="Deve possuir o valor entre 0 e 8" data-original-title="Descrição" autocomplete="off">
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>
		{/subcategoria}
		</fieldset>		  

<!-- FIM -->


