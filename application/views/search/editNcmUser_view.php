
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
	
{dados}

	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-hover'>
		<thead>
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width="8%"><b>NCM</b></td>
				<td width=""><b>Descrição</b></td>
				<td width=""><b>Categoria</b></td>
				<td width="%"><b>Marca</b></td>
				<td width="%"><b>Modelo</b></td>
				<td width="%"><b>Unidades</b></td>
			</tr>			
		</thead>		
			
		<tbody>
			<tr class="table-condensed">	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td><a href="#categoriaAlterar" data-toggle="modal">{CNome}</a></td>
				<td><a href="#marcaAlterar" data-toggle="modal">{MANome}</a></td>
				<td><a href="#modeloAlterar" data-toggle="modal">{MNome}</a></td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
			</tr>
		</tbody>
			
	</table>
	
	<!-- subcategorias -->
	<h3 align="center">Itens Alterados</h3><br>
		
	<table class="table table-bordered table-hover">
		
		<tr>		
			<td width="8%"><b>Categoria:</b></td>
			<td>{categoriaNome}</td>			
		</tr>

		<tr>
			<td width="8%"><b>Marca:</b></td>
			<td>{marcaNome}</td>			
		</tr>

		<tr>		
			<td width="8%"><b>Modelo:</b></td>
			<td>{modeloNome}</td>			
		</tr>

	</table>

</div>



<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da categoria -->
<form action="<?php echo base_url();?>index.php/ncm/update/CategoriaRequisicao" method="POST">	
	
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
			<input type="hidden" name="userID" value="<?php echo $this->session->userdata('usuarioID');?>">

		</div>	
	</div>

</form>

<!-- Modal para alteração da Marca -->
<form action="<?php echo base_url();?>index.php/ncm/update/MarcaRequisicao/" method="POST">	
	
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
			<input type="hidden" name="userID" value="<?php echo $this->session->userdata('usuarioID');?>">

		</div>	
	</div>

</form>

<!-- Modal para alteração do Modelo -->
<form action="<?php echo base_url();?>index.php/ncm/update/ModeloRequisicao/" method="POST">	
	
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
			<input type="hidden" name="userID" value="<?php echo $this->session->userdata('usuarioID');?>">

		</div>	
	</div>

</form>

{/dados}


