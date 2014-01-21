<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Cadastro <small>subcategorias para {categoriaNome}{CNome}{/categoriaNome}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/category/listAll">Cadastro</a> <span class="divider"> / </span></li>
            <li class="active">Categorias</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('category/setTitle', $atributos); 
	?>
	<blockquote>			
		<div class="control-group">					
			<div class="controls">
				<input type="hidden" class="input-xlarge" id="idCategoria" value='{idCategoria}' name="idCategoria">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Subcategoria</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="subcategoria" placeholder="Nome da subcategoria" name="subcategoria" rel="popover" 
				data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Categoria" autocomplete="off">
			</div>
		</div>			

		<div class="control-group">
			<label class="control-label" for="">Índice</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="indice" placeholder="Índice da subcategoria" name="indice" rel="popover" 
				data-content="Deve possuir o valor entre 1 e 8" data-original-title="Descrição" autocomplete="off">
			</div>
		</div>
	</blockquote>

		<div class="form-actions">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>
	</form>	 
	
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-hover'>
		<thead>
			<tr class="">				
				<td width="7%"><b>Índice</b></td>
				<td><b>Subcategoria</td>
				<td width="6%"><b>Editar</td>
				<td width="6%"><b>Itens</td>
				<td width="6%"><b>Excluir</td>
			</tr>			
		</thead>
			{titulos}
			<tr class="table-condensed">
				<td>{TColuna}</td>
				<td>{TNome}</td>
				<td><a href="../editTitle/{TID}" class='icon-edit'> <a/></td>
				<td><a href="../addItem/{TID}/{Categoria_CID}/{TColuna}" class='icon-plus'> <a/></td>
				<td><a onclick='Remove("{TID}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/titulos}
	
	</table>

</div><!--/end container-->

<div class="modal hide" id="myModal">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Exclusão de subcategoria</h3>
		</div>

		<div class="modal-body">
		<p>Deseja realmente excluir a subcategoria?</p>
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
		document.getElementById('Excluir').href="../deleteTitle/"+id;
	}	

</script>