<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Últimas <small>atualizações</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Atualizações</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	

	<blockquote class="">
		
		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align'=> 'left',  'method'=>'POST');
			echo form_open('administration/date', $atributos); 
		?>		
			
			<select id="categoriaCombo" name="categoria" class="span2" onchange="this.form.submit()">
				
				<option value="">Categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select> 				       

		</form>
	</blockquote>	

	<div class="headline" align="center">
		<h3><small>Atualizações da categoria </small>{categoria}</h3>
	</div>

	<table class='table table-bordered table-hover' id="idTabela">
			
		<thead>
			<tr class="">				
				<td width="10%"><b>NCM</td>
				<td width="%"><b>Ano</td>
				<td width="%"><b>Mês</td>
			</tr>	
		</thead>		
			
		{dados}	
		
		<tbody>
			<tr class="table-condensed">	
				<td>{ncm}</td>
				<td>{ano}</td>
				<td>{mes}</td>
			</tr>

		{/dados}
				
		</tbody>

	</table>



</div>