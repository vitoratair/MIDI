
<div
	class="container">

	<div class="page-header">
		<h2>
			Edição <small> de Usuário</small>
		</h2>
	</div>

	<?php
	$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
	echo form_open('usuario/editUsuario', $atributos);
	?>

	<fieldset>

		<div class="control-group">
			<div class="controls">
				<input type="hidden" class="input-xlarge" id="ID"
					value='{usuarioID}' name="ID">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input01">Nome</label>
			<div class="controls">
				<input type="text" name="Nome" class="input-xlarge" id="input01"
					value='{usuarioNome}'>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="input01">E-mail</label>
			<div class="controls">
				<input type="text" name="Email" class="input-xlarge" id="input01"
					value="{usuarioEmail}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Função</label>
			<div class="controls">
				<select id="" name="Cargo" class="input-xlarge"> 
				{cargos}
					<option value="{cargoID}">{cargoNome}</option> 
				{/cargos}
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Unidade</label>
			<div class="controls">
				<select id="" name="Unidade" class="input-xlarge"> 
				{unidades}
					<option value="{unidadeID}">{unidadeNome}</option> 
				{/unidades}
				</select>
			</div>
		</div>

<!-- 		<div class="control-group">
			<label class="control-label" for="">Departamento</label>
			<div class="controls">
				<select id="" name="Setor" class="input-xlarge"> 
				{departamentos}
					<option value="{departamentoID}">{departamentoNome}</option>
				{/departamentos}

				</select>
			</div>
		</div> -->

		<div class="control-group">
			<label class="control-label" for="">Tipo de usuário</label>
			<div class="controls">
				<select id="" name="Tipo" class="input-xlarge"> 
				{tipos}
					<option value="{tipoID}">{tipoNome}</option> 
				{/tipos}

				</select>
			</div>
		</div>

<!-- 		<div class="control-group">
			<label class="control-label" for="">Ativo</label>
			<div class="controls">
				<select id="Ativo" name="Ativo" class="input-xlarge"> 
					<option value="SIM">SIM</option>
					<option value="NÃO">NÃO</option>
				</select>
			</div>
		</div> -->
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Salvar</button>
			<button class="btn">Limpar</button>
		</div>
	</fieldset>

</form>

<!-- FIM -->

