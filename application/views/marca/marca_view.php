<!-- Estrutura -->
<div class="container">

	<!-- Buscador  + Adicionar nova marca-->
		
	<div class="page-header">
		<h2>Marcas <small> cadastradas no sistema</small></h2>
	</div>

	<?php
		$atributos = array('form class'=>'form-search',  'align'=>'right', 'method'=>'POST');
		echo form_open('marca/listAll', $atributos); 
	?>		
	
	<input type="text" class="input-xlarge search-query" placeholder="Busca de marca..." name="buscaMarca">
	<button type="submit" class="btn btn-success"><i class="icon-search icon-white"></i> Buscar</button>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
	<a href="addMarca" class="btn btn-success"><i class="icon-plus icon-white"></i> Nova marca</a>	  	
	</form>
									
	<table class='table table-bordered table-striped table-hover' id="idTabela">
			
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
			<tr class="table-condensed">	
				<td>{MAID}</td>
				<td>{MANome}</td>
				<td>{MANome1}</td>
				<td>{MANome2}</td>
				<td><a href="#" onclick='EnviaMarca("{MAID}")' class='icon-search'> <a/></td>
				<td><a href="<?php echo base_url();?>index.php/marca/editMarca/{MAID}" class='icon-edit'> <a/></td>
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

// Formulario para enviar variavel via POST //
function EnviaMarca(marca){  
{
    
	var url = '<?php echo base_url();?>index.php/marca/modelos';
	var form = $('<form action="' + url + '" method="post">' +
	  '<input type="hidden" name="marca" value="' + marca + '" />' +
	  '<input type="hidden" name="categoria" value="-1" />' +
	  '</form>');
	$('body').append(form);
	$(form).submit();

    // location.href="<?php echo base_url();?>index.php/marca/modelos/"+marca;   
}

}
function Remove(id){

	document.getElementById("Excluir");
	document.getElementById('Excluir').href="deleteMarca/"+id;

}	

</script>




