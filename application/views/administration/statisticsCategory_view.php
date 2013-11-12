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
		    
		    &nbsp;&nbsp;&nbsp;

			<select id="categoria" name="categoria" class="span3" onchange="this.form.submit()">
				
				<option value="">Selecione uma categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select>			    

		</form>	
	</blockquote>

	<table class="table table-bordered">
		<thead>
			<tr class="">				
				<td width="10%r"><b>NCM</td>
				<td width=""><b>Ano</td>
				<td width=""><b>Última atualização</td>
				<td width=""><b>Último processamento</td>
			</tr>			
		</thead>

		{dados}	
			<tr class="table-condensed">	
				<td>{ncm}</td>
				<td>{anos}</td>
				<td>{lastUpdate}</td>	
				<td>{lastProcessing}</td>		
			</tr>
		{/dados}
	</table>



		

</div>