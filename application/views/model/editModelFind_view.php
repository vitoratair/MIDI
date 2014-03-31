<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição  <small>de modelos</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/model/listAll">Modelos</a> <span class="divider"> / </span></li>
            <li class="active">Edição de modelos</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">
	
	<div class="row-fluid margin-bottom-10">
		
	<?php
		$atributos = array('form class'=>'reg-page',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('model/updateModel', $atributos); 
	?>

	{modelos}
			<h3>Edição de modelos</h3>			
				
            <div class="controls">    
                <label>Modelo <span class="color-red">*</span></label>
				<input type="text" class="span12" id="nomeModelo0" value="{MNome0}" name="nomeModelo0">

                <label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome}" name="nomeModelo">				
                
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome1}" name="nomeModelo1">
				
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome2}" name="nomeModelo2">

				<label>Sinônimo</label>
				<input type="text"  class="span12" id="nomeModelo" value="{MNome3}" name="nomeModelo3">

				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome4}" name="nomeModelo4">
            </div>
        
            <div class="controls">
                <div class="span6">
                    <label>Marca <span class="color-red">*</span></label>
					<select id="marca" name="marca" class="span12">					
						{marca}
							<option value="{MANome}"> {MANome}</option>					
						{/marca}
						{marcas}	
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>
                </div>
                <div class="span6">
                    <label>Categoria <span class="color-red">*</span></label>

					<select id="categoria" name="categoria" class="span12" onchange="this.form.submit()">					
						{categoria}
							<option value="{CID}"> {CNome}</option>					
						{/categoria}
						{categorias}	
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>
                </div>
            </div>

            <hr>

{titulos}
           <div class="controls">
                
                <div class="span6">
                    <label>{TNome}</label>
                </div>

                <div class="span6" align="right">
                    <label>{SubCategoria}</label>
                </div>                

            </div>            
{/titulos}			
		
            <div class="controls form-inline">
            	<input type="hidden" value="{MOID}" name="id">
            	<input type="hidden" value="{CHECK}" name="check">
            	<input type="hidden" value="2" name="controle">
                <button class="btn-u pull-right" type="submit">Atualizar</button>
            </div>
            <br><br>
            <hr/>
			
        </form>
	</div>

</div>	

{/modelos}