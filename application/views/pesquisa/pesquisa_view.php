<!-- Estrutura -->
<div class="container">
			
	
	<table class="table" border="0px">
		<tr>
			<td>
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
						   </div>
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
					
				<input type="text" class="input-xlarge search-query" placeholder="Pesquisa..." name="buscaDados">
				<button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Buscar</button>
				
				</form>
			</td>
		<tr>
		<tr>
			
			<td>
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
							<input type="hidden" name="ncm" value="<?php echo $this->session->userdata('ncm');?>">
							<input type="hidden" name="ano" value="<?php echo $this->session->userdata('ano');?>">

				</form>

							<!-- Formulário para combobox sem botão submit -->
							<?php
								$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
								echo form_open('pesquisa/listAll', $atributos); 
							?>		
						

							<select id="modelo" name="marca" class="span2">
								<option value="">Modelo</option>	
								{modelos}		
									<option value="{MOID}">{MNome}</option>
								{/modelos}
								
						    </select>
					</div>
				</fieldset>
				</form>	

			</td>


		</tr>



	</table>

	<hr>

	<!-- Legenda da pesquisa -->
	<h3 align="center"><small>Pesquisa na NCM </small><b>{ncm}</b><small> no ano de </small>{ano}</h3>


		
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



