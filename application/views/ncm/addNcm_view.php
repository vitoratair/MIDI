<!-- Estrutura -->

<div class="container">

	<br>
	<h2>Cadastro <small>de ncm</small></h2>
	<hr>


		<form id="FormCadastro" action="setNcm" class="form-horizontal" method="POST">			
		<fieldset>
		
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="NID" value='{NID}' name="ID">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Categoria</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="categoriaNome" placeholder="Nome da NCM" name="ncmNome" rel="popover" 
					data-content="Deve possuir 8 caracteres numéricos." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			

			<div class="control-group">
				<label class="control-label" for="">Descrição</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="categoriaNome" placeholder="Descriçao da NCM" name="ncmDescricao" rel="popover" 
					data-content="Deve possuir de 6 há 150 caracteres" data-original-title="Descrição" autocomplete="off">
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>

		</fieldset>	
		</form>	  

<!-- FIM -->


