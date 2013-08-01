<!-- Estrutura -->
<div class="container">

	<div class="">
		<h2>Categoria <small> lista de categorias cadastradas no sistema</small></h2>
	</div>

	<div class="" align="right">
		<a href="addCategoria" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova Categoria</a>		
	</div>					
	<hr>
	<br>
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped table-hover'>
			
			<tr class="">				
				<td width="7%"><b>ID</b></td>
				<td><b>Categoria</td>
				<td width="6%"><b>Editar</td>
				<td width="6%"><b>NCMs</td>
				<td width="6%"><b>Subcategoria</td>
				<td width="6%"><b>Excluir</b></td>
			</tr>			

			{categorias}
			<tr class="table-condensed">	
				<td>{CID}</td>
				<td>{CNome}</td>
				<td><a href="editCategoria/{CID}" class='icon-edit'> <a/></td>
				<td><a href="associarCategoria/{CID}" class='icon-plus'> <a/></td>
				<td><a href="tituloCategoria/{CID}" class='icon-plus'> <a/></td>
				<td><a onclick='Remove("{CID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/categorias}
	
	</table>
	

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a categoria ?</p>
		</div>

		 <div class="modal-footer">
		<a href="" class="btn" data-dismiss="modal">Não</a>
		<a href="" class="btn btn-danger" id="Excluir">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">

function Remove(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="deleteCategoria/"+id;

}	

</script>


