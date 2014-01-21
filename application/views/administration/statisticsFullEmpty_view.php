<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Categoria - NCM  <small></small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Estatísticas</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	
	<blockquote class="">
		
		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align'=> 'left',  'method'=>'POST');
			echo form_open('administration/statistic', $atributos); 
		?>		

			<select id="categoriaCombo" name="categoria" class="span2" onchange="this.form.submit()">
				
				<option value="">Categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select>
 			
 			&nbsp;&nbsp;&nbsp; -  &nbsp;&nbsp;&nbsp;

			<select id="ncm" name="ncm" class="span2">
				
				<option value="">NCM</option>
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;

			<select id="anoCombo" name="ano" class="span2" onchange="this.form.submit()">
				
				<option value="">Ano</option>
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>	

		</form>	
	</blockquote>

	<br>
	<div class="headline" align="center">
		<h3>Selecione uma categoria ou ncm e ano para consulta</h3>
	</div>
	<br>
</div>