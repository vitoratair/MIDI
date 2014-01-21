<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Requisições  <small>para alteração</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Processamento</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">			
		
	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('request/listAll', $atributos); 
	?>				

		<div class="control-group" align="right">

			<select id="categoria" onchange="this.form.submit()" name="categoria" class="span2">
				
				<option value=""> Categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select>			
		</div>	
	</form>	

	<div class="headline" align="center">
		<h3>Não consta requisições para a categoria {categoria}</h3>
	</div>

</div>
