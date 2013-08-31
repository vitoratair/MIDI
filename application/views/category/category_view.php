<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Categorias  <small>cadastradas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Cadastro <span class="divider"> / </span></li>
            <li class="active">Categorias</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	

	<form id="FormCadastro" action="setCategory" class="form-horizontal" method="POST">	    
			
		<button type="submit" class="btn-u"><i class="icon-plus"></i></button>
		<input type="text" class="span3" id="categoriaNome" placeholder="Nome da categoria" name="categoriaNome" rel="popover" 
		data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Categoria" value="" autocomplete="off">	

	</form>
	
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-hover'>
		
		<thead>
			<tr class="">				
				<td width="7%"><b>ID</b></td>
				<td><b>Categoria</td>
				<td width="6%"><b>Editar</td>
				<td width="6%"><b>NCMs</td>
				<td width="6%"><b>Subcategoria</td>
				<td width="6%"><b>Excluir</b></td>
			</tr>			
		</thead>

		{categorias}
		<tr class="table-condensed">	
			<td>{CID}</td>
			<td>{CNome}</td>
			<td><a href="editCategory/{CID}" class='icon-edit'> <a/></td>
			<td><a href="ncmConnect/{CID}" class='icon-plus'> <a/></td>
			<td><a href="titleCategory/{CID}" class='icon-plus'> <a/></td>
			<td><a onclick='Remove("{CID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
		</tr>
		{/categorias}
	
	</table>

</div><!--/end container-->

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Exclusão de categoria</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a categoria?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>

<script type="text/javascript">

function Remove(id)
{
	document.getElementById("Excluir");
	document.getElementById('Excluir').href="deleteCategory/"+id;
}	

</script>
