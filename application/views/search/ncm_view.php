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
		<h3 align="center"><small>Pesquisa na NCM </small><b>{ncm}</b><small> no ano de </small>{year}</h3>
	</div>	
	
	<p align="right">
		<a href="<?php echo base_url();?>index.php/search/ncm" class="btn-u">Refrehs <i class="icon-refresh"></i></a>		
	</p>
	
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-hover'>
		<thead>
			<tr class="">				
				<td width="4%"><b>Seleção</b></td>
				<td width="4%"><b>Mês</b></td>
				<!-- <td width="8%"><b>NCM</b></td> -->
				<td width="8%"><b>FOB</b></td>
				<td width=""><b>Descrição</b></td>
				<td width="%"><b>Unidades</b></td>
				<td width=""><b>Categoria</b></td>				
				<td width="%"><b>Marca</b></td>
				<td width="%"><b>Modelo</b></td>				
				<td width="%"><b>Alterar</b></td>
			</tr>
		</thead>				

		{dados}
				<tr>	
					<td><input type="checkbox" id="{IDN}" value="{IDN}"/></td>
					<td>{MES}</td>
					<!-- <td>{ncm}</td>	 -->
					<td>$ {VALOR_UNIDADE_PRODUTO_DOLAR}</td>				
					<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
					<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>
					<td>{CNome}</td>
					<td>{MANome}</td>
					<td>{MNome0}</td>				
					<td><a href="<?php echo base_url();?>index.php/ncm/edit/{IDN}/{ncm}/{year}" target="_blank"><i class="icon-edit"></i></a></td>
				</tr>		
		{/dados}
		
		<thead>
			<tr>	
				<td colspan=9></td>
			</tr>
		</thead>
		
		<!-- Alterar todas as NCMs visíveis na tela -->
		<thead>
			<tr class="">
				<td colspan=5><p align="center">Alterar todas as entradas acima</p></td>
				<td><a href="#categoriaAlterar" class="" data-toggle="modal">Categoria</a></td>
				<td><a href="#marcaAlterar" data-toggle="modal">Marca</a></td>
				<td></td>
			</tr>
		</thead>

	</table>

	<div align="center">
		{links}	
	</div>

</div>

<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da categoria -->
	
	<div class="modal hide" id="categoriaAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da categoria</h3>
		</div>	
		<div class="modal-body">			

{categorias1}
			<input type="radio" id ="categoria" name="categoria" value="{CID}"> {CNome}<br>
{/categorias1}

			</div>
		<div class="modal-footer">
			<a href="<?php echo base_url();?>index.php/category/listAll" target="_blank" class="btn">Outros</a>
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger" id="botaoCategoria">Sim</button>			
		</div>	
	</div>

<!-- </form> -->

<!-- Modal para alteração da Marca -->
	<div class="modal hide" id="marcaAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da marca</h3>
		</div>	
		<div class="modal-body">			

{marcas2}
			<input type="radio" id ="marca" name="marca" value="{MAID}"> {MANome}<br>
{/marcas2}

			</div>
		<div class="modal-footer">
			<a href="<?php echo base_url();?>index.php/brand/setBrandView" target="_blank" class="btn">Outros</a>
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger" id="botaoMarca">Sim</button>
		</div>	
	</div>

<!-- Modal para alteração do Modelo -->
<!-- 	<div class="modal hide" id="modeloAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração do modelo</h3>
		</div>	
		<div class="modal-body">			

{modelos1}
			<input type="radio" id ="modelo" name="modelo" value="{MOID}"> {MNome0}<br>
{/modelos1}
			</div>
		<div class="modal-footer">
			<a href="<?php echo base_url();?>index.php/model/addModel" target="_blank" class="btn">Outros</a>
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger" id="botaoModelo">Sim</button>
		</div>	
	</div> -->


<script type="text/javascript">

    function marcaAll()
    {
	    var idSelector = function() { return this.id; };
	    var idsSelecionados = $(":checkbox:checked").map(idSelector).get() ;
	    var marca = $("input[id='marca']:checked").val();

	    $(':checkbox:checked').removeAttr('checked');

		var url = '<?php echo base_url();?>index.php/ncm/update/MarcaAll/';
		var form = $('<form action="' + url + '" method="POST">' +
		  '<input type="hidden" name="ncm" value="' + <?php echo $ncm;?> + '" />' +
		  '<input type="hidden" name="year" value="' + <?php echo $year;?> + '" />' +
		  '<input type="hidden" name="marca" value="' + marca + '" />' +
		  '<input type="hidden" name="ids" value="' + idsSelecionados + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
    }

    function categoriaAll()
    {
	    var idSelector = function() { return this.id; };
	    var idsSelecionados = $(":checkbox:checked").map(idSelector).get() ;
	    var categoria = $("input[id='categoria']:checked").val();

	    $(':checkbox:checked').removeAttr('checked');

		var url = '<?php echo base_url();?>index.php/ncm/update/CategoriaAll/';
		var form = $('<form action="' + url + '" method="POST">' +
		  '<input type="hidden" name="ncm" value="' + <?php echo $ncm;?> + '" />' +
		  '<input type="hidden" name="year" value="' + <?php echo $year;?> + '" />' +
		  '<input type="hidden" name="categoria" value="' + categoria + '" />' +
		  '<input type="hidden" name="ids" value="' + idsSelecionados + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
    }

    $("#botaoCategoria").bind("click", function(){
        categoriaAll();
    });

    $("#botaoMarca").bind("click", function(){
       marcaAll();
    });       

</script>



