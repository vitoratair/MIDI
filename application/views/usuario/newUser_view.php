
<!-- Estrutura -->
<div class="container">

	<div class="page-header">
			<h2>
				Cadastro <small> de novo usuário</small>
			</h2>
		</div>

	<form class="form-horizontal" id="FormCadastro" method="POST" action="cadastrarUser">  
			
			<fieldset>

			<div class="control-group">
				<label class="control-label" for="">Nome</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="Nome" placeholder="Nome completo" name="Nome" rel="popover" 
					data-content="Deve ter no minimo 6 caracteres e no maxímo 45 caracteres." data-original-title="Nome" value="" autocomplete="off">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Matrícula</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="Matricula" placeholder="Informe a matrícula do usuário" name="Matricula" rel="popover" 
					data-content="Deve possuir 6 números." data-original-title="Matricula" value="" autocomplete="off">
				</div>
			</div>		


			<div class="control-group">
				<label class="control-label" for="">E-mail</label>
				<div class="controls">
					<input type="email" class="input-xlarge" id="Email" placeholder="Informe o e-mail do usuário" name="Email" rel="popover"
					data-content="Informe seu endereco de e-mail" data-original-title="E-mail" value="" autocomplete="off">
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="">Função</label>
				<div class="controls">
					<select id=""  name="Cargo" class="input-xlarge">
						{cargos}		
						<option value="{cargoID}"> {cargoNome} </option>
						{/cargos}
				    </select>
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="">Unidade</label>
				<div class="controls">
					<select id="" name="Unidade" class="input-xlarge" >
						
						<option value=""> Escolha </option>
						{unidades}		
						<option value="{unidadeID}"> {unidadeNome} </option>
						{/unidades}					
						
				    </select>
				</div>
			</div>
		
			<div class="control-group">
				<label class="control-label" for="">Tipo de usuário</label>
				<div class="controls">
					<select id="" name="Tipo"class="input-xlarge">
						
						{tipos}		
						<option value="{tipoID}"> {tipoNome} </option>
						{/tipos}
						
				    </select>
				</div>
			</div>				
			

			<div class="form-actions">
				<button type="submit" class="btn btn-success">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>
	
		</fieldset>
	</form>

<script type="text/javascript">
    var path = '<?php echo site_url(); ?>'
</script>
<!-- FIM -->


