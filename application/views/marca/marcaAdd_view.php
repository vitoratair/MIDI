<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Cadastro <small>de marca</small></h2>
	<hr>

	<form id="FormCadastro" action="setMarca" class="form-horizontal" method="POST">			
		<fieldset>

		<div class="control-group">
			<label class="control-label" for="">Marca</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome" placeholder="Nome da marca" name="marcaNome" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Marca" value="" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome1" placeholder="Sinônimo" name="marcaNome1" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome2" placeholder="Sinônimo" name="marcaNome2" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>





	<div class="form-actions">
		<button type="submit" class="btn btn-success">Salvar</button>
		<button class="btn" type="reset">Limpar</button>
	</div>	
	</form>	  

<!-- FIM -->


