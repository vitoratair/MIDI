<!-- Estrutura -->
<div class="container">

	<br>
	<h2>Usuários <small>cadastrados</small></h2>
	<hr>	

	<div align="right">
		<!-- Adicionar novo usuario -->
		<a href="newUser" class="btn btn-success"> <i class="icon-plus icon-white"></i> Novo Usuário </a>				
	</div>
	<br>


	<!-- Tabela com a lista dos usuarios do sistema -->
	<table class='table table-bordered table-striped table-hover'>

			<tr>
				<th>Nome</th>
				<th>Login</th>
				<th>E-mail</th>
				<th>Função</th>
				<th>Departamento</th>
				<th>Tipo de usuario</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
				
		{usuarios}
			<tr class="table-condensed">
				<td>{usuarioNome}</td>
				<td>{usuarioLogin}</td>
				<td>{usuarioEmail}</td>
				<td>{cargoNome}</td>
				<td>{unidadeNome}</td>
				<td>{tipoNome}</td>
				<td><a href="editUser/{usuarioID}" class='icon-edit'> <a/></td>
				<td><a onclick='RemoveUser("{usuarioID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
		{/usuarios}

	</table>
	<br>


<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p> Todos os dados relacionados a esse usuário serão apagados também. Deseja realmente excluir o usuário ?</p>
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


