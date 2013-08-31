<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Cadastro  <small>de marcas</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/brand/listAll">Marcas</a> <span class="divider"> / </span></li>
            <li class="active">Adicionar</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<div class="row-fluid margin-bottom-10">
    	<form id="FormCadastro" action="setBrand" class="reg-page" method="POST">			        	
        	<h3>Registrar nova marca</h3>

            <div class="controls">    
                <label>Marca <span class="color-red">*</span></label>
				<input type="text" class="span12" id="marcaNome" name="marcaNome" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Marca" value="" autocomplete="off">
                
                <label>Sinônimo</label>
				<input type="text" class="span12" id="marcaNome1" name="marcaNome1" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">
                
                <label>Sinônimo</label>
				<input type="text" class="span12" id="marcaNome2" name="marcaNome2" rel="popover" 
				data-content="Deve ter no minimo 2 caracteres e no maxímo 45 caracteres." data-original-title="Sinônimo" value="" autocomplete="off">

            </div>
            <div class="controls form-inline">
                <button class="btn-u pull-right" type="submit">Cadastrar</button>
            </div>
            <br><br>
            <hr />
			
        </form>
    </div><!--/row-fluid-->	  
</div>	

		


