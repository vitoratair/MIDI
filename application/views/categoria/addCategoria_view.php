<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Cadastro <small>de categoria</small></h2>
	<hr>

	<form id="FormCadastro" action="setCategoria" class="form-horizontal" method="POST">			
		<fieldset>

		<div class="control-group">
			<label class="control-label" for="">Categoria</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="categoriaNome" placeholder="Nome da categoria" name="categoriaNome" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Categoria" value="" autocomplete="off">
			</div>
		</div>			

	<div class="form-actions">
		<button type="submit" class="btn btn-success">Salvar</button>
		<button class="btn" type="reset">Limpar</button>
	</div>	
	</form>	  

<!-- FIM -->


