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
				<td width="12%" valign="top">
					
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
				
				<td valign="top">
					
						<fieldset>
								<div class="control-group">
									<div class="controls">
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

				</td>		

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
									<select id="marca" name="marca" class="span2" onchange="this.form.submit()">
										<option value="">Marca</option>	
										{marcas}		
											<option value="{MAID}">{MANome}</option>
										{/marcas}								
								    </select>
								    <input type="hidden" name="controle" value="2">						
								</div>
							</div>
						</fieldset>
					</form>			

				</td>

				<td colspan="">
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
											<option value="{MOID}">{MNome}</option>
										{/modelos}								
								    </select>
								</div>
							</div>
						</fieldset>
					
					</form>				

				</td>		

			</tr>	
		</table>
	</blockquote>
	<hr>						
	


</div>



