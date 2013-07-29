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
			
			<tr class="table-condensed">	
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
	<h3 align="center"><small>Subcategorias de </small><strong>{CNome}</strong></h3><br>
		
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped'>			
			<tr class="">				
				<td width="5%"><b>ID</b></td>
				<td width="47%"><b>Subcategoria</td>
				<td width="47%"><b>Item</td>
			</tr>			
{titulos}
			<tr class="table-condensed">	
				<td>{TColuna}</td>
				<td>{TNome}</td>
<?php 
				if ($checkModelo)
				{
?>	
					<td>{SubCategoria}</td>						
<?php
				}
				else
				{
?>
					<td><a href="#subcategoria{TColuna}" data-toggle="modal">{SubCategoria}</a></td>						
<?php		
				}
?>

				
			</tr>
{/titulos}
	
	</table>



<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

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

<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração das subcategorias ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da subcategoria1 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria1">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria1}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria1}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="1">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria2 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria2">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria2}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria2}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="2">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria3 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria3">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria3}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria3}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="3">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria3 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria4">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria4}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria4}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="4">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria5 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria5">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria5}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria5}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="5">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria6 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria6">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria6}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria6}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="6">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria7 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria7">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria7}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria7}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="7">

		</div>	
	</div>

</form>

<!-- Modal para alteração da subcategoria8 -->
<form action="<?php echo base_url();?>index.php/pesquisa/update/SubCategoria" method="POST">	
	
	<div class="modal hide" id="subcategoria8">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria8}
			<input type="radio" id ="subcategoria" name="subcategoria" value="{SCID}"> {SCNome}<br>
{/subcategoria8}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
			<input type="hidden" name="coluna" value="8">

		</div>	
	</div>

</form>


{/dados}


