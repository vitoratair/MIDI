<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Usuários <small>cadastrados</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Usuários <span class="divider"> / </span></li>
            <li class="active">Lista de Usuários</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<!-- Estrutura -->
<div class="container">	

	<div align="right">
		<!-- Adicionar novo usuario -->
		<a href="newUser" class="btn-u"> <i class="icon-plus icon-white"></i> Novo Usuário </a>				
	</div>
	<br>


	<!-- Tabela com a lista dos usuarios do sistema -->
	<table class='table table-bordered table-hover'>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Login</th>
				<th>E-mail</th>
				<th>Função</th>
				<th>Departamento</th>
				<th>Tipo de usuário</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>

		{usuarios}
			<tr class="table-condensed">
				<td>{usuarioNome}</td>
				<td>{usuarioLogin}</td>
				<td>{usuarioEmail}</td>
				<td>{cargoNome}</td>
				<td>{unidadeNome}</td>
				<td>{tipoNome}</td>
				<td><a href="editUser/{usuarioID}" class='icon-edit'> </a></td>
				<td><a onclick='RemoveUser("{usuarioID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
		{/usuarios}

	</table>

</div>


<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Exclusão de usuário</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir o usuário?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">

function RemoveUser(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="deleteUser/"+id;

}	

</script>


