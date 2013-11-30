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
				
				<option value="{ncm}">{ncm}</option>
				{ncms}		
					<option value="{NNome}">{NNome}</option>
				{/ncms}
				
		    </select>

		    &nbsp;&nbsp;&nbsp;

			<select id="anoCombo" name="ano" class="span2" onchange="this.form.submit()">
				
				<option value="{ano}">{ano}</option>
				{anos}		
					<option value="{AAno}">{AAno}</option>
				{/anos}
				
		    </select>		        

		</form>	


	</blockquote>

	<hr>

	<table class='table table-bordered table-hover' id="idTabela">
		<thead>
			<tr class="">				
				<td width=""><b>Meses</td>
				<td width=""><b>Total</td>
				<td width=""><b>Marcas</td>
				<td width=""><b>Modelos</td>
				<td width=""><b>Outros</td>
				<td width=""><b>Categorias</td>			
			</tr>			
		</thead>	
		{dados}	
		
			<tr class="table-condensed">	
				<td><a onclick='Visualizar("{mesID}")' data-toggle="modal" href="#">{mes}</a></td>
				<td>{total}</td>
				<td>{marcaEncontrada}</td>
				<td>{modeloEncontrado}</td>
				<td>{outros}</td>	
				<td>{categorias}</td>							
			</tr>
		
		{/dados}

			<tr class="table-condensed">	
				<td><b>TOTAL</b></td>
				<td><b>{total}</b></td>
				<td><b>{marcaEncontrada}</b></td>
				<td><b>{modeloEncontrado}</b></td>
				<td><b>{outros}</b></td>	
				<td></td>	
			</tr>		
	
	</table>


</div>

<script type="text/javascript">
	function Visualizar(mes)
	{
		var url = '<?php echo base_url();?>index.php/search/visualizeNcmByMonth';
		var form = $('<form action="' + url + '" method="POST">' +
		  '<input type="hidden" name="mes" value="' + mes + '" />' +
		  '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
		  '<input type="hidden" name="ncm" value="' + <?php echo $ncm;?> + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
	}	
</script>	