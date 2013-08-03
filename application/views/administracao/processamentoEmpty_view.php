<!-- Estrutura -->
<div class="container">

	<div class="">
		<h2>Processamento <small> de NCMs</small></h2>

	</div>
		
	<hr>				
	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'align'=> 'right',  'method'=>'POST');
		echo form_open('administracao/processamento', $atributos); 
	?>		
		<fieldset>

			<select id="ncm" name="ncm" class="span2">
				
				<option value="">Selecione uma NCM</option>
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;&nbsp;&nbsp;

			<select id="anoCombo" name="ano" class="span2" onchange="this.form.submit()">
				
				<option value="">Selecione um ano</option>
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>			    

		</fieldset>

	</form>


	
