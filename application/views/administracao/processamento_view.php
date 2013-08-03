<!-- Estrutura -->
<div class="container">

	<div class="">
		<h2>Processamento <small> de NCMs</small></h2>

	</div>
		
	<hr>				
	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'align'=> 'right',  'method'=>'POST');
		echo form_open('administracao/estatisticasListAll', $atributos); 
	?>		
		<fieldset>

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

		</fieldset>

	</form>

	<br>
	<table class='table table-bordered table-hover table-striped' id="idTabela">
			
			<tr class="">				
				<td width="10%"><b>Meses</td>
				<td width="%"><b>Total</td>
				<td width="%"><b>Marcas</td>
				<td width="%"><b>Modelos</td>
				<td width="%"><b>Outros</td>
				<td width="7%"><b>Processar</td>
				<td width="7%"><b>Limpar</td>
			</tr>			
			
		{dados}	
		
			<tr class="table-condensed">	
				<td>{mes}</td>
				<td>{total}</td>
				<td>{marcaEncontrada}</td>
				<td>{modeloEncontrado}</td>
				<td>{outros}</td>				
				<td><a onclick='Processar("{mesID}")' data-toggle="modal" href="#processar" class='icon icon-wrench'></a></td>					
				<td><a onclick='CleanNcm("{mesID}")' data-toggle="modal" href="#clean" class='icon icon-remove'></a></td>					
			</tr>
		
		{/dados}

			<tr class="table-condensed info">	
				<td><b>TOTAL</b></td>
				<td><b>{total}</b></td>
				<td><b>{marcaEncontrada}</b></td>
				<td><b>{modeloEncontrado}</b></td>
				<td colspan="3"><b>{outros}</b></td>	
			</tr>		
	
	</table>




<!-- <div class="modal hide" id="processar">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>d!</h3>
		</div>

		<div class="modal-body">
			<p>
				Você deseja realmente apagar todos os registros de marcas e modelos dessa NCM?
			</p>
		</div>

		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<a href="" class="btn btn-danger" id="Processamento">Sim</a>
	 	</div>
</div> -->

<div class="modal hide" id="Clean">
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
			<a href="" class="btn btn-danger" id="Processamento">Sim</a>
	 	</div>
</div>


<!-- FIM -->

<script type="text/javascript">

	function CleanNcm(mes)
	{

        document.write('<form action="cleanNcm" name="Myform" method="POST">')
		document.write('<input type="hidden" name="mes" value="'+mes+'">');                       
        document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        document.write('<input type="hidden" name="ncm" value="'+<?php echo $ncm;?>+'">');
        document.write('</form>')
        document.Myform.submit()
	}

	function Processar(mes)
	{

        document.write('<form action="processar" name="Myform" method="POST">')
		document.write('<input type="hidden" name="mes" value="'+mes+'">');                       
        document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        document.write('<input type="hidden" name="ncm" value="'+<?php echo $ncm;?>+'">');
        document.write('</form>')
        document.Myform.submit()
	}		

</script>