<!-- Estrutura -->
<div class="container">

	<br>

	<table class="table table-striped">					
		<div class="page-header">
			<h2>NCM <small> - lista de NCMs cadastradas no sistema</small></h2>
		</div>						

		<p align=right>
			<a href="addNCM" class="btn btn-large btn-success"><i class="icon-plus icon-white"></i> Nova NCM</a>	  
		</p>
					
	
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped'>
		<thead>
			<tr>				
				<td width="7%">ID</td>
				<td width="15%">NCM</td>
				<td>Descrição</td>				
				<td width="10%">Editar</td>
				<td width="10%">Excluir</td>
			</tr>
		</thead>				
		<tbody>
			{ncm}
			<tr>	
				<td>{NID}</td>
				<td>{NNome}</td>
				<td>{NDescricao}</td>
				<td><a href="editNCM/{NID}" class='icon-edit'> <a/></td>
				<td><a onclick='RemoveNCM("{NID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
				</tr>
			{/ncm}
		</tbody>
	</table>
	<br>

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a NCM ?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">

function RemoveNCM(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="deleteNCM/"+id;

}	

</script>


