<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Estatísticas <small>de NCMs</small></h1>
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
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align'=> 'right',  'method'=>'POST');
			echo form_open('administration/statistic', $atributos); 
		?>		
			
			<select id="ncm" name="ncm" class="span2">
				
				<option value="">Selecione uma NCM</option>
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;&nbsp;&nbsp;

			<select id="anoCombo" name="ano" class="span2" onchange="this.form.submit()">
				
				<option value="">Selecione um ano</option>
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>	

		</form>	
	</blockquote>

	<br><br><br><br><br><br><br><br><br>
</div>