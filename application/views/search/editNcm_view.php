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


<!-- Estrutura -->
<div class="container">			
	
	{dados}

	<!-- Legenda da pesquisa -->
	<div class="headline" align="center">
		<h3 align="center"><small>Visualização da na NCM </small><b>{ncm}</b><small> no ano de </small>{year}</h3><br>
	</div>
	
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-striped'>
			
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width="8%"><b>NCM</td>
				<td width="%"><b>Descrição</td>
				<td width="%"><b>FOB</td>
				<td width="%"><b>Unidades</td>				
			</tr>			
			
			<tr class="table-condensed">	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td>{VALOR_UNIDADE_PRODUTO_DOLAR}</td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>
				
			</tr>			
	</table>

	<table class='table table-bordered table-striped'>
			
			<tr class="">				
				<td width=""><b>Categoria</td>
				<td width="%"><b>Marca</td>
				<td width="%"><b>Modelo</td>
				<td width="%"><b>PAIS_ORIGEM</b></td>
				<td width="%"><b>PAIS_AQUISICAO</td>
				<td width="%"><b>UNIDADE_COMERCIALIZACAO</td>
				<td width="%"><b>PESO_LIQUIDO_KG</td>
				<td width="%"><b>Flag</td>				
			</tr>			
			
			<tr class="table-condensed">	
				<td><a href="#categoriaAlterar" data-toggle="modal">{CNome}</a></td>
				<td><a href="#marcaAlterar" data-toggle="modal">{MANome}</a></td>
				<td><a href="#modeloAlterar" data-toggle="modal">{MNome}</a></td>				
				<td>{PAIS_ORIGEM}</td>
				<td>{PAIS_AQUISICAO}</td>				
				<td>{UNIDADE_COMERCIALIZACAO}</td>
				<td>{PESO_LIQUIDO_KG}</td>
				<?php
					if ($flag == 1)
						echo "<td><input id=\"flag\" type=\"checkbox\" checked onclick=\"Update({ncm}, {year}, {IDN})\"></td>";
					else
						echo "<td><input id=\"flag\" type=\"checkbox\" onclick=\"Update({ncm}, {year}, {IDN})\"></td>"
				?>				
			</tr>			
	</table>

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

</div>

<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<script type="text/javascript">

    function Update(ncm, ano, idn)
    {    

    	alert(document.getElementById("flag").value);
        // var url = '<?php echo base_url();?>index.php/ncm/update/Flag/';
        // var form = $('<form action="' + url + '" method="POST">' +
        //   '<input type="hidden" name="year" value="' + ano + '" />' +
        //   '<input type="hidden" name="ncm" value="' + ncm + '" />' +
        //   '<input type="hidden" name="idn" value="' + idn + '" />' +
        //   '</form>');
        // $('body').append(form);
        // $(form).submit();

    }
</script>

<!-- Modal para alteração da categoria -->
<form action="<?php echo base_url();?>index.php/ncm/update/Categoria/" method="POST">	
	
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
			<a href="<?php echo base_url();?>index.php/category/listAll" target="_blank" class="btn">Outros</a>
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
		</div>	
	</div>

</form>

<!-- Modal para alteração da Marca -->
<form action="<?php echo base_url();?>index.php/ncm/update/Marca/" method="POST">	
	
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
			<a href="<?php echo base_url();?>index.php/brand/setBrandView" target="_blank" class="btn">Outros</a>
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<button type="submit" class="btn btn-danger">Sim</button>
			<input type="hidden" name="ncm" value="{ncm}">
			<input type="hidden" name="year" value="{year}">
			<input type="hidden" name="idn" value="{IDN}">
		</div>	
	</div>

</form>

<!-- Modal para alteração do Modelo -->
<form action="<?php echo base_url();?>index.php/ncm/update/Modelo/" method="POST">	
	
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
			<a href="<?php echo base_url();?>index.php/model/addModel" target="_blank" class="btn">Outros</a>
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/ncm/update/SubCategoria" method="POST">	
	
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
