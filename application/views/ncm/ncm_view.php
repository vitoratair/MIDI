<!-- Estrutura -->
<div class="container">
	
	<div class="">
		<h2>NCM<small>s cadastradas no sistema</small></h2>
	</div>
	<hr>
	
	<div class="" align="right">
		<a href="addNCM" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova NCM</a>	  
	</div>						
	<br>

	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped'>

			<tr>				
				<td width="7%"><strong>ID</strong></td>
				<td width="15%"><strong>NCM</strong></td>
				<td><strong>Descrição</strong></td>				
				<td width="10%"><strong>Editar</strong></td>
				<td width="10%"><strong>Excluir</strong></td>
			</tr>

			{ncm}
			<tr class="table-condensed">	
				<td>{NID}</td>
				<td>{NNome}</td>
				<td>{NDescricao}</td>
				<td><a href="editNCM/{NID}" class='icon-edit'> <a/></td>
				<td><a onclick='RemoveNCM("{NID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
				</tr>
			{/ncm}
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


