<!-- Estrutura -->
<div class="container">
			
	

		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('pesquisa/listAll', $atributos); 
		?>		
			
			<fieldset>
			<div class="control-group">
				<label class="control-label" for="">Pesquisa</label>
				<div class="controls">

					<select id="ncm" name="ncm" class="input" class="">
						
						{ncms}		
							<option value="{NNome}">{NNome}</option>
						{/ncms}
						
				    </select>

					<select id="ano" onchange="this.form.submit()" name="ano" class="input">
					
						{anos}		
							<option value="{AAno}">{AAno}</option>
						{/anos}
						
				    </select>

			</div>

		</fieldset>
	</form>


	<!-- Buscador-->		
	<?php
		$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
		echo form_open('pesquisa/listAll', $atributos); 
	?>		
		
		<input type="text" class="input-xlarge search-query" placeholder="Pesquisa..." name="buscaModelo">	
		<button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Buscar</button>
	
	</form>


		
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-striped'>
			
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width="8%"><b>NCM</td>
				<td width=""><b>Descrição</td>
				<td width=""><b>Categoria</td>
				<td width="%"><b>Marca</td>
				<td width="%"><b>Modelo</td>
				<td width="%"><b>Unidades</td>
				<td width="%"><b>Alterar</td>
			</tr>			

			{dados}
			<tr>	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td>{CNome}</td>
				<td>{MANome}</td>
				<td>{MNome}</td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
				<td><i class="icon-edit"></i></td>
			</tr>
			{/dados}
	
	</table>

	<div align="center">
		{links}	
	</div>
	

<!-- FIM -->



