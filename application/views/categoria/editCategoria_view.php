<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Edição <small>de categoria</small></h2>
	<hr>

		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('categoria/updateCategoria', $atributos); 
		?>

		<fieldset>
			{categoriaNome}
		
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="ID" value='{CID}' name="ID">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Categoria</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="categoriaNome" value="{CNome}" name="categoriaNome" rel="popover" 
					data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			

			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>

		{/categoriaNome}
		</fieldset>		  

<!-- FIM -->


