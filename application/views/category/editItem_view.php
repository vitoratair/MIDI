<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Editar <small>itens</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/model/listAll">Cadastro</a> <span class="divider"> / </span></li>
            <li class="active">Editar itens</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('category/updateItem', $atributos); 
	?>	  
		{itens}
		<div class="control-group">
			<label class="control-label" for="">Item</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="subcategoriaitem" value="{SCNome}" name="subcategoriaitem" rel="popover" 
				data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Item" autocomplete="off">
			</div>			
		</div>
		
			<input type="hidden" name="id" value="{SCID}">
			<input type="hidden" name="coluna" value="{coluna}">
			<input type="hidden" name="idCategoria" value="{Categoria_CID}">
			<input type="hidden" name="subcategoria" value="{subcategoria}">

		{/itens}
		<div class="form-actions">
			<button type="submit" class="btn-u">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>			

</div>

<!-- FIM -->






