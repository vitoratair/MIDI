<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">NCMs <small>cadastradas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Cadastro <span class="divider"> / </span></li>
            <li class="active">Categorias</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	
	
	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('ncm/updateNcm', $atributos); 
	?>

	{ncmNome}

		<div class="control-group">					
			<div class="controls">
				<input type="hidden" class="input-xlarge" id="NID" value='{NID}' name="ID">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for=""><strong>NCM</strong></label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="categoriaNome" value="{NNome}" name="ncmNome" rel="popover" 
				data-content="Deve possuir 8 caracteres numéricos." data-original-title="Categoria" autocomplete="off">
			</div>
		</div>			

		<div class="control-group">
			<label class="control-label" for=""><strong>Descrição</strong></label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="categoriaNome" value="{NDescricao}" name="ncmDescricao" rel="popover" 
				data-content="Deve possuir de 6 há 150 caracteres" data-original-title="Descrição" autocomplete="off">
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>

	{/ncmNome}

</div>		