<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Adionar <small>itens</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/model/listAll">Cadastro</a> <span class="divider"> / </span></li>
            <li class="active">Adicionar itens</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->



<div class="container">


		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('category/setItem', $atributos); 
		?>	  
			
			<div class="control-group">
				<label class="control-label" for="">Novo Item</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="subcategoriaitem" placeholder="Novo item" name="subcategoriaitem" rel="popover" 
					data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Item" autocomplete="off">
				</div>			
			</div>
			<input type="hidden" name="idCategoria" value="{idCategoria}">
			<input type="hidden" name="idSubcategoria" value="{idSubcategoria}">
			<input type="hidden" name="coluna" value="{coluna}">

			<div class="form-actions">
				<button type="submit" class="btn-u">Salvar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>			
		

	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped table-hover'>
			
			<tr class="">				
				<td width="7%"><b>ID</b></td>
				<td width=""><b>Item</b></td>
				<td width="6%"><b>Editar</b></td>
				<td width="6%"><b>Excluir</b></td>
			</tr>			

			{itens}
			<tr class="table-condensed">
				<td>{SCID}</td>
				<td>{SCNome}</td>
				<td><a href="../../../editItem/{SCID}/{coluna}/{idSubcategoria}" class='icon-edit'> </a></td>
				<td><a onclick='Remove("{SCID}","{coluna}","{idCategoria}","{idSubcategoria}")' data-toggle="modal" href="#myModal" class='icon-trash'></a></td>
			</tr>
			{/itens}
	
	</table>
</div>