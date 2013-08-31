<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição <small>de categoria</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
			<li><a href="<?php echo base_url();?>index.php/category/listAll">Categoria</a> <span class="divider"> / </span></li>
            <li class="active">Categorias</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('category/updateCategory', $atributos); 
		?>

		<fieldset>
			
			{categoriaNome}		
			<div class="control-group">					
				<div class="controls">
					<input type="hidden" class="input-xlarge" id="ID" value='{CID}' name="ID">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for=""><p>Categoria</p></label>
				<div class="controls">
					<input type="text" class="span3" id="categoriaNome" value="{CNome}" name="categoriaNome" rel="popover" 
					data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Categoria" autocomplete="off">
				</div>
			</div>			
			<br>
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Atualizar</button>
				<button class="btn" type="reset">Limpar</button>
			</div>
			{/categoriaNome}

		</fieldset>		  

</div>



