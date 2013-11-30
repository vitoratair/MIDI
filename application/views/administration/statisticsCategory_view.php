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
			echo form_open('administration/statisticCategory', $atributos); 
		?>		

			<select id="categoria" name="categoria" class="span2" onchange="this.form.submit()">
				
				<option value="">Categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select>			    

		</form>	
	</blockquote>

	<table class="table table-bordered">
		<thead>
			<tr class="">				
				<td width="20%"><b>NCM</td>
				<td width=""><b>Última atualização</td>
				<td width=""><b>Último processamento</td>
			</tr>			
		</thead>

		{dados}	
			<tr class="table-condensed">	
				<td>{ncm} - {anos}</td>
				<td>{lastUpdate}</td>	
				<td>{lastProcessing}</td>		
			</tr>
		{/dados}
	</table>

</div>