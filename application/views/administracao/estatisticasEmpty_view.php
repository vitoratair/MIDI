<!-- Estrutura -->
<div class="container">

	<div class="">
		<h2>Estatísticas <small> de NCMs</small></h2>

	</div>
		
	<hr>				
	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'align'=> 'right',  'method'=>'POST');
		echo form_open('administracao/estatisticasListAll', $atributos); 
	?>		
		<fieldset>

			<select id="ncm" name="ncm" class="span2">
				
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;&nbsp;&nbsp;

			<select id="anoCombo" name="ano" class="span2">
				
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>		    
	
		    &nbsp;&nbsp;&nbsp;
		    
			<button type="submit" class="btn btn-success"><i class=""></i> Pesquisa</button>

		</fieldset>

	</form>


	
