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
				
				<option value="{ncm}">{ncm}</option>
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;&nbsp;&nbsp;

			<select id="anoCombo" name="ano" class="span2" onchange="this.form.submit()">
				
				<option value="{ano}">{ano}</option>
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>		    

		</fieldset>

	</form>

	<br>
	<table class='table table-bordered table-hover table-striped' id="idTabela">
			
			<tr class="">				
				<td width="%"><b>Meses</td>
				<td width="%"><b>Total</td>
				<td width="%"><b>Marcas</td>
				<td width="%"><b>Modelos</td>
				<td width="%"><b>Outros</td>
				<td width="%"><b>Categorias</td>
			</tr>			
			
		{dados}	
		
			<tr class="table-condensed">	
				<td>{mes}</td>
				<td>{total}</td>
				<td>{marcaEncontrada}</td>
				<td>{modeloEncontrado}</td>
				<td>{outros}</td>	
				<td>{categorias}</td>			
			</tr>
		
		{/dados}

			<tr class="table-condensed info">	
				<td><b>TOTAL</b></td>
				<td><b>{total}</b></td>
				<td><b>{marcaEncontrada}</b></td>
				<td><b>{modeloEncontrado}</b></td>
				<td><b>{outros}</b></td>	
				<td></td>	
			</tr>		
	
	</table>

