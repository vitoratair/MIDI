<!-- Estrutura -->
<div class="container">

	<!-- Buscador  + Adicionar nova marca-->
		
		<?php
			$atributos = array('form class'=>'well form-search',  'align'=>'right', 'method'=>'POST');
			echo form_open('marca/listAll', $atributos); 
		?>		
		
		<input type="text" class="input-xlarge search-query" placeholder="Busca de marca..." name="buscaMarca">
	
		<button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Buscar</button>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		<a href="addMarca" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova marca</a>	  
	
	</form>

	<table class="table table-striped">					
		<div class="page-header">
			<h2>Marca <small> lista das marcas cadastradas no sistema</small></h2>
		</div>									

	<table class='table table-bordered table-striped' id="idTabela">
			
			<tr class="">				
				<td width="7%"><b>ID</b></td>
				<td width=""><b>Marca</td>
				<td width=""><b>Sinônimo</td>
				<td width=""><b>Sinônimo</td>
				<td width="6%"><b>Modelos</td>
				<td width="6%"><b>Editar</b></td>
				<td width="6%"><b>Excluir</b></td>
			</tr>			

			{marcas}
			<tr>	
				<td>{MAID}</td>
				<td>{MANome}</td>
				<td>{MANome1}</td>
				<td>{MANome2}</td>
				<td><a href="editCategoria/{CID}" class='icon-search'> <a/></td>
				<td><a href="../editMarca/{MAID}" class='icon-edit'> <a/></td>
				<td><a onclick='Remove("{MAID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/marcas}
	
	</table> 
	
	<!-- 
		Exibe os links para paginação
	 -->
	<div align="center">
    	 {links}
    </div>
	

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Excluir</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a marca?</p>
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
	document.getElementById('Excluir').href="deleteMarca/"+id;

}	

</script>


