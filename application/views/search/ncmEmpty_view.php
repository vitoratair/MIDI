<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Pesquisas  <small>de importações</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Pesquisas <span class="divider"> / </span></li>
            <li class="active"><a href="<?php echo base_url();?>index.php/app/home">Importações</a> <span class="divider"> / </span></li>

        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">			

	<blockquote>
		<table class="" width="100%" border="0" width="100%" >		
			<tr>			
				<td width="16%" valign="top">
					
<!-- Formulário para combobox sem botão submit -->
<?php
	$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
	echo form_open('search/ncm', $atributos); 
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
								<div>
							</div>
						</fieldset>

				</td>

				<td colspan="" width="12%" valign="top">
					
						<fieldset>
								<div class="control-group">
									<div class="controls">
										<select id="ano" name="ano" class="span2">
											<option value="">Ano</option>
											{anos}		
												<option value="{AAno}">{AAno}</option>
											{/anos}
											
									    </select>
								   </div>
							</div>
						</fieldset>							

				</td>

				<td colspan="" width="12%" valign="top">
					
						<fieldset>
								<div class="control-group">
									<div class="controls">
										<select id="mes" onchange="this.form.submit()" name="mes" class="span2">
											<option value="">Mês</option>
												<option value="0">Todos</option>
												<option value="1">Janeiro</option>
												<option value="2">Fevereiro</option>
												<option value="3">Março</option>
												<option value="4">Abril</option>
												<option value="5">Maio</option>
												<option value="6">Junho</option>
												<option value="7">Julho</option>
												<option value="8">Agosto</option>
												<option value="9">Setembro</option>
												<option value="10">Outubro</option>
												<option value="11">Novembro</option>
												<option value="12">Dezembro</option>											
									    </select>
								    	<input type="hidden" name="controle" value="1">
								   </div>
							</div>
						</fieldset>							

				</td>				

</form>	


				<td rowspan="2" align="">

						<!-- Buscador-->		
						<?php
							$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
							echo form_open('search/ncm', $atributos); 
						?>					

			 				<div class="control-group" align="right">
							  	<div class="controls">
							    	<input type="text" class="span3 search-query" placeholder="Pesquisar por ..." name="search">
								</div>
							</div>

			 				<div class="control-group" align="right">
							  	<div class="controls">
							    	<input type="text" class="span3 search-query" placeholder="Retirar a palavra ..." name="unSearch">
								</div>
							</div>

							<input type="hidden" name="controle" value="3">
							<p align="right">								
								<button type="submit" class="btn-u"></i> Buscar </button>								
							</p>
							
						</form>
				</td>
			</tr>

			<tr>

				<td>
					<!-- Formulário para combobox sem botão submit -->
					<?php
						$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
						echo form_open('search/ncm', $atributos); 
					?>		
							
						<fieldset>
							<div class="control-group">
								<div class="controls">
									<select id="categoria" name="categoria" class="span2" onchange="this.form.submit()">
										<option value="">Categoria</option>	
										{categorias2}		
											<option value="{CID}">{CNome}</option>
										{/categorias2}								
								    </select>
								    <input type="hidden" name="controle" value="4">						
								</div>
							</div>
						</fieldset>
					</form>			

				</td>				
				
				<td width="16%">
					<!-- Formulário para combobox sem botão submit -->
					<?php
						$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
						echo form_open('search/ncm', $atributos); 
					?>		
							
						<fieldset>
							<div class="control-group">
								<div class="controls">
									<select id="marca" name="marca" class="span2" onchange="this.form.submit()">
										<option value="">Marca</option>	
										{marcas1}		
											<option value="{MAID}">{MANome}</option>
										{/marcas1}								
								    </select>
								    <input type="hidden" name="controle" value="5">						
								</div>
							</div>
						</fieldset>
					</form>			

				</td>


				<td>
					<!-- Formulário para combobox sem botão submit -->
					<?php
						$atributos = array('form class'=>'form',  'id'=>'FormCadastro', 'method'=>'POST');
						echo form_open('search/ncm', $atributos);  
					?>		
						<fieldset>
							<div class="control-group">
								<div class="controls">					
									<select id="modelo" name="modelo" class="span2" onchange="this.form.submit()">
										<option value="">Modelo</option>	
										{modelos}		
											<option value="{MOID}">{MNome0}</option>
										{/modelos}								
								    </select>
								    <input type="hidden" name="controle" value="6">
								</div>
							</div>
						</fieldset>
					
					</form>				

				</td>		

			</tr>	
		</table>


	</blockquote>
	
	<!-- Legenda da pesquisa -->
	<div class="headline" align="center">
		<h3 align="center"><small>A NCM no ano escolhido não consta na base de dados</h3>
	</div>	

</div>



