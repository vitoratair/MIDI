<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição <small>de subcategoria</small></h1>
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
		echo form_open('category/updateTitle', $atributos); 
	?>

	<blockquote>
		
		{subcategoria}
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="idCategoria" value='{Categoria_CID}' name="idCategoria">
					<input type="hidden" class="input-xlarge" id="id" value='{TID}' name="id">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="">Subcategoria</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="subcategoria" value="{TNome}" name="subcategoria" rel="popover" 
					data-content="Deve possuir no mínimo 3 caracteres e no máximo 45." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			

			<div class="control-group">
				<label class="control-label" for="">Índice</label>
				<div class="controls">
					<input type="text" class="input-xlarge" id="indice" value="{TColuna}" name="indice" rel="popover" 
					data-content="Deve possuir o valor entre 0 e 8" data-original-title="Descrição" autocomplete="off">
				</div>
			</div>
	</blockquote>

		<div class="form-actions">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>

	{/subcategoria}		

</div>	<!-- end container -->


	