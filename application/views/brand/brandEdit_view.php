<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição <small>de marcas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/brand/listAll">Marcas</a> <span class="divider"> / </span></li>
            <li class="active">Editar</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('brand/updateBrand', $atributos); 
	?>

	<fieldset>

		{marcas}

		<div class="control-group">					
			<div class="controls">
				<input type="hidden" class="input-xlarge" id="ID" value='{MAID}' name="ID">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Marca</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome" value="{MANome}" name="marcaNome" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Marca" value="" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome1" value="{MANome1}" name="marcaNome1" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="marcaNome2" value="{MANome2}" name="marcaNome2" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
			</div>
		</div>

		{/marcas}

	</fieldset>

		<div class="form-actions">
			<button type="submit" class="btn-u">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>	
	</form>	  

</div>


