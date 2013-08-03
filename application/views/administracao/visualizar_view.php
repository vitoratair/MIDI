<!-- Estrutura -->
<div class="container">			
	<div class="">
		<h2>Visualização <small> da ncm {ncm} em {mes} de {ano}</small></h2>
	</div>

	<div class="" align="right">
		<a href="<?php echo base_url();?>index.php/administracao/processamento" class="btn"><i class="icon-arrow-left"></i> Voltar</a>		
	</div>					
	<hr>
	<br>
		
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-striped table-hover'>
			
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width="6%"><b>NCM</td>
				<td width=""><b>Descrição</td>
				<td width=""><b>Categoria</td>
				<td width="%"><b>Marca</td>
				<td width="%"><b>Modelo</td>
				<td width="%"><b>Unidades</td>
				<td width="%"><b>Alterar</td>
			</tr>			

			{dados}
			<tr class="table-condensed">	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td>{CNome}</td>
				<td>{MANome}</td>
				<td>{MNome}</td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
				<td><a href="<?php echo base_url();?>index.php/pesquisa/edit/{IDN}/{ncm}/{ano}" target="_blank"><i class="icon-edit"></a></i></td>
			</tr>
			{/dados}
	
	</table>

	<div align="center">
		{links}	
	</div>
	

<!-- FIM -->



