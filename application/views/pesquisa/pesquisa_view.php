<!-- Estrutura -->
<div class="container">			
<br>
	<table class="table" width="96%" border="0px" align="center">
		<tr>
			<td valign="top">
				<!-- Formulário para combobox sem botão submit -->
				<?php
					$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
					echo form_open('pesquisa/listAll', $atributos); 
				?>		
						
				<fieldset>
					<div class="control-group">
						<div class="controls">

							<select id="ncm" name="ncm" class="span2">
								<option value="">NCM</option>	
								{ncms}		
									<option value="{NNome}">{NNome}</option>
								{/ncms}
								
						    </select>

							<select id="ano" onchange="this.form.submit()" name="ano" class="span2">
								<option value="">Ano</option>
								{anos}		
									<option value="{AAno}">{AAno}</option>
								{/anos}
								
						    </select>
						    <input type="hidden" name="controle" value="1">
						   </div>
					</div>
				</fieldset>
				</form>				
			
				<!-- Formulário para combobox sem botão submit -->
				<?php
					$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
					echo form_open('pesquisa/listAll', $atributos); 
				?>		
						
				<fieldset>
					<div class="control-group">
						<div class="controls">
							<select id="marca" name="marca" class="span2" onchange="this.form.submit()">
								<option value="">Marca</option>	
								{marcas}		
									<option value="{MAID}">{MANome}</option>
								{/marcas}								
						    </select>
						    <input type="hidden" name="controle" value="2">						
				</form>

						<!-- Formulário para combobox sem botão submit -->
						<?php
							$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
							echo form_open('pesquisa/listAll', $atributos); 
						?>		

						<select id="modelo" name="modelo" class="span2" onchange="this.form.submit()">
							<option value="">Modelo</option>	
							{modelos}		
								<option value="{MOID}">{MNome}</option>
							{/modelos}								
					    </select>
					</div>
				</fieldset>
				</form>	
			</td>
			<td>

	<!-- Buscador-->		
				<?php
					$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
					echo form_open('pesquisa/listAll', $atributos); 
				?>					

 				<div class="control-group">
				  	<div class="controls">
				    	<input type="text" class="span3 search-query" placeholder="Pesquisar por ..." name="search">
					</div>
				</div>

 				<div class="control-group">
				  	<div class="controls">
				    	<input type="text" class="span3 search-query" placeholder="Retirar a palavra ..." name="unSearch">
					</div>
				</div>				
				<input type="hidden" name="controle" value="3">
				<button type="submit" class="btn btn"><i class="icon-search"></i> Buscar</button>
				
				</form>
			</td>
		<tr>

	</table>

	<hr>

	<!-- Legenda da pesquisa -->
	<h3 align="center"><small>Pesquisa na NCM </small><b>{ncm}</b><small> no ano de </small>{year}</h3>
	<br>
		
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-striped table-condensed'>
			
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
				<td><a href="<?php echo base_url();?>index.php/pesquisa/edit/{IDN}/{ncm}/{year}" target="_blank"><i class="icon-edit"></a></i></td>
			</tr>
			{/dados}
	
	</table>

	<div align="center">
		{links}	
	</div>
	

<!-- FIM -->



