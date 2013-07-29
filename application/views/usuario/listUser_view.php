<!-- Estrutura -->
<div class="container">

	<br>

	<!-- Adicionar novo usuario -->
	<a href="newUser" class="btn btn-primary"> <i class="icon-plus icon-white"></i> Novo Usuário </a>
	<br>
	<br>

	<!-- Tabela com a lista dos usuarios do sistema -->
	<table class='table table-bordered table-striped'>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Login</th>
				<th>E-mail</th>
				<th>Função</th>
				<th>EAG</th>
				<th>Departamento</th>
				<th>Tipo de usuario</th>
				<th>Ativo</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
				
		<tbody>
			{usuarios}
			<tr>
				<td>{usuarioNome}</td>
				<td>{usuarioLogin}</td>
				<td>{usuarioEmail}</td>
				<td>{cargoNome}</td>
				<td>{departamentoNome}</td>
				<td>{unidadeNome}</td>
				<td>{tipoNome}</td>
				<td>{usuarioAtivo}</td>
				<td><a href="editUser/{usuarioID}" class='icon-edit'> <a/></td>
				<td><a onclick='RemoveUser("{usuarioID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/usuarios}
		</tbody>
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


