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

	<br>
	<table class='table table-bordered table-hover table-striped' id="idTabela">
			
			<tr class="">				
				<td width="10%"><b>Meses</td>
				<td width="%"><b>Total de importações</td>
				<td width="%"><b>Marcas encontradas</td>
				<td width="%"><b>Modelos encontrados</td>
				<td width="%"><b>Marca e Modelo encontrados</td>
				<td width="8%"><b>Outros</td>
				<td width="8%"><b>Categorias</td>
			</tr>			
			
		{dados}	
			<tr class="table-condensed">	
				<td>{mes}</td>
				<td>{total}</td>
				<td>{marcaEncontrada}</td>
				<td>{modeloEncontrado}</td>
				<td>{marca_modelo}</td>
				<td>{outros}</td>	
				<td><i class="icon icon-search"></td>				
			</tr>
		{/dados}

			<tr class="table-condensed info">	
				<td><b>TOTAL</b></td>
				<td><b>{total}</b></td>
				<td><b>{marcaEncontrada}</b></td>
				<td><b>{modeloEncontrado}</b></td>
				<td><b>{marca_modelo}</b></td>
				<td><b>{outros}</b></td>	
				<td><i class="icon icon-search"></td>				
			</tr>		
	
	</table>


