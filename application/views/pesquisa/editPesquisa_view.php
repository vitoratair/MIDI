<!-- Estrutura -->
<div class="container">			
	
	{dados}

	<!-- Legenda da pesquisa -->
	<h3 align="center"><small>Visualização do id </small><strong>{IDN}</strong><small> na NCM </small><b>{ncm}</b><small> no ano de </small>{year}</h3><br>
		
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
			</tr>			
			
			<tr>	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td><a href="#categoriaAlterar" data-toggle="modal">{CNome}</a></td>
				<td><a href="#marcaAlterar" data-toggle="modal">{MANome}</a></td>
				<td><a href="#modeloAlterar" data-toggle="modal">{MNome}</a></td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
			</tr>
			
	</table>
	<br>
	<hr>
	<br>

	<!-- subcategorias -->
	<h3 align="center"><small>Subcategorias da categoria </small><strong>{CNome}</strong></h3><br>
		
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped'>
			
			<tr class="">				
				<td width="7%"><b>Índice</b></td>
				<td><b>Subcategoria</td>
				<td><b>Item</td>
			</tr>			

{titulos}
			<tr>	
				<td>{TColuna}</td>
				<td>{TNome}</td>
				<td>{SubCategoria}</td>
			</tr>
{/titulos}
	
	</table>






<!-- Modal para alteração da categoria -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/Categoria/" method="POST">	
	
	<div class="modal hide" id="categoriaAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da categoria</h3>
		</div>	
		<div class="modal-body">			

{categorias}
			<input type="radio" id ="categoria" name="categoria" value="{CID}"> {CNome}<br>
{/categorias}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">

		</div>	
	</div>

</form>

<!-- Modal para alteração da Marca -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/Marca/" method="POST">	
	
	<div class="modal hide" id="marcaAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da marca</h3>
		</div>	
		<div class="modal-body">			

{marcas}
			<input type="radio" id ="marca" name="marca" value="{MAID}"> {MANome}<br>
{/marcas}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">

		</div>	
	</div>

</form>

<!-- Modal para alteração do Modelo -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/Modelo/" method="POST">	
	
	<div class="modal hide" id="modeloAlterar">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração do modelo</h3>
		</div>	
		<div class="modal-body">			

{modelos}
			<input type="radio" id ="modelo" name="modelo" value="{MOID}"> {MNome}<br>
{/modelos}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">

		</div>	
	</div>

</form>
{/dados}





