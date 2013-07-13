<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Edição <small>de marca</small></h2>
	<hr>
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('marca/updateMarca', $atributos); 
		?>

		<fieldset>

		{marcas}

		<div class="control-group">					
			<div class="controls">
				<input type="hidden" class="input-xlarge" id="ID" value='{MAID}' name="ID">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Marca</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome" value="{MANome}" name="marcaNome" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Marca" value="" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome1" value="{MANome1}" name="marcaNome1" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome2" value="{MANome2}" name="marcaNome2" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>

		{/marcas}

	<div class="form-actions">
		<button type="submit" class="btn btn-success">Salvar</button>
		<button class="btn" type="reset">Limpar</button>
	</div>	
	</form>	  

<!-- FIM -->


