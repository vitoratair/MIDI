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

	<?php
		$atributos = array('form class'=>'reg-page',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('model/setModel', $atributos); 
	?>
        	<h3>Registrar novo modelo </h3>

            <div class="controls">    
                <label>Modelo <span class="color-red">*</span></label>
				<input type="text" class="span12" id="nomeModelo0" placeholder="" name="nomeModelo0">

                <label>Sinônimo <span class="color-red">*</span></label>
				<input type="text" class="span12" id="nomeModelo" placeholder="" name="nomeModelo">				
                
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo1" name="nomeModelo1">
				
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo2" name="nomeModelo2">

				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo3" name="nomeModelo3">

				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo4" name="nomeModelo4">
            </div>

            <div class="controls">
                <div class="span6">
                    <label>Marca <span class="color-red">*</span></label>
					<select id="marca"  name="marca" class="span12">					
						<option value=""> - </option>
						{marcas}	
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>
                </div>
                <div class="span6">
                    <label>Categoria <span class="color-red">*</span></label>

					<select id="categoria"  name="categoria" class="span12">					
							<option value=""> - </option>					

						{categorias}	
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>
                </div>
            </div>

            <div class="controls form-inline">
            	<input type="hidden" value="{modeloID}" name="id">
                <button class="btn-u pull-right" type="submit">Cadastrar</button>
            </div>
            <br><br>
            <hr />
			
        </form>
    </div><!--/row-fluid-->	  
</div>	

	

<!-- Modal mensagem salvar -->

<div id="salvar" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
  	</div>

  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Aplicar</button>
  </div>
</div>

