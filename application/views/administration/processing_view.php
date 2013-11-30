<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Processamento  <small>de dados</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Processamento</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">	
	<blockquote class="">
		
		<!-- Formulário para combobox sem botão submit -->
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align'=> 'left',  'method'=>'POST');
			echo form_open('administration/processing', $atributos); 
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
				<td width="10%"><b>Meses</td>
				<td width="%"><b>Total</td>
				<td width="%"><b>Marcas</td>
				<td width="%"><b>Modelos</td>
				<td width="%"><b>Outros</td>
				<td width="7%"><b>Visualizar</td>
				<td width="7%"><b>Processar</td>
				<td width="7%"><b>Limpar</td>
			</tr>	
		</thead>		
			
		{dados}	
		
		<tbody>
			<tr class="table-condensed">	
				<td>{mes}</td>
				<td>{total}</td>
				<td>{marcaEncontrada}</td>
				<td>{modeloEncontrado}</td>
				<td>{outros}</td>				
				<td><a onclick='Visualizar("{mesID}")' data-toggle="modal" href="#" class='icon icon-search'></a></td>									
				<td><a onclick='Processar("{mesID}")' data-toggle="modal" href="#" class='icon icon-wrench'></a></td>					
				<td><a onclick='CleanNcm("{mesID}")' data-toggle="modal" href="#" class='icon icon-remove'></a></td>					
			</tr>

		{/dados}
			
			<tr class="table-condensed">	
				<td><b>TOTAL</b></td>
				<td><b>{total}</b></td>
				<td><b>{marcaEncontrada}</b></td>
				<td><b>{modeloEncontrado}</b></td>
				<td><b>{outros}</b></td>
				<td><a onclick='Visualizar("{mesID}")' data-toggle="modal" href="#visualizar" class='icon icon-search'></a></td>									
				<td><a onclick='Processar("{mesID}")' data-toggle="modal" href="#processar" class='icon icon-remove'></a></td>
				<td><a onclick='CleanNcm("{mesID}")' data-toggle="modal" href="#CleanNcm" class='icon icon-remove'></a></td>										
			</tr>		
		</tbody>

	</table>
</div>

<div class="modal hide" id="processar">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>d!</h3>
		</div>

		<div class="modal-body">
			<p>
				Você deseja processar os dados dessa NCM?
			</p>
		</div>

		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<a href="" class="btn btn-danger" id="Processamento">Sim</a>
	 	</div>
</div>

<div class="modal hide" id="CleanNcm">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Atenção!</h3>
		</div>

		<div class="modal-body">
			<p>
				Você deseja realmente apagar todos os registros de marcas, modelos e categorias dessa NCM?
			</p>
		</div>

		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<a href="" class="btn btn-danger" id="CleanNcm">Sim</a>
	 	</div>
</div>


<script type="text/javascript">

	function CleanNcm(mes)
	{

		var url = '<?php echo base_url();?>index.php/ncm/ncmEmpty';
		var form = $('<form action="' + url + '" method="POST">' +
		  '<input type="hidden" name="mes" value="' + mes + '" />' +
		  '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
		  '<input type="hidden" name="ncm" value="' + <?php echo $ncm;?> + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
	}

	function Processar(mes)
	{
		var url = '<?php echo base_url();?>index.php/ncm/process';
		var form = $('<form action="' + url + '" method="POST">' +
		  '<input type="hidden" name="mes" value="' + mes + '" />' +
		  '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
		  '<input type="hidden" name="ncm" value="' + <?php echo $ncm;?> + '" />' +
		  '</form>');
		$('body').append(form);
		$(form).submit();
	}

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




