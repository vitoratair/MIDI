<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">NCMs <small>cadastradas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Cadastro <span class="divider"> / </span></li>
            <li class="active">Cadastro de NCM</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	

	<form id="FormCadastro" action="setNcm" class="form-horizontal" method="POST">	    
			
		<button type="submit" class="btn-u"><i class="icon-plus"></i></button>
		<input type="hidden" class="span2" value=' ' name="ncmDescricao">
		<input type="text" class="span2" id="categoriaNome" placeholder="Entre com a nova NCM" name="ncmNome" rel="popover" 
		data-content="Deve possuir 8 caracteres numéricos." data-original-title="Categoria" autocomplete="off">

	</form>

	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-hover'>
		<thead>
			<tr>				
				<td width="7%"><strong>ID</strong></td>
				<td width="15%"><strong>NCM</strong></td>
				<td><strong>Descrição</strong></td>				
				<td width="10%"><strong>Editar</strong></td>
				<td width="10%"><strong>Excluir</strong></td>
			</tr>
		</thead>
			{ncm}
			<tr class="table-condensed">	
				<td>{NID}</td>
				<td>{NNome}</td>
				<td>{NDescricao}</td>
				<td><a href="editNcm/{NID}" class='icon-edit'> <a/></td>
				<td><a onclick='RemoveNCM("{NID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
				</tr>
			{/ncm}
	</table>

</div>

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Exclusão de NCM</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a NCM?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>

<script type="text/javascript">

	function RemoveNCM(id)
	{
		document.getElementById("Excluir");
		document.getElementById('Excluir').href="deleteNcm/"+id;
	}	

</script>