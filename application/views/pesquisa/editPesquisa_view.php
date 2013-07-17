<!-- Estrutura -->
<div class="container">			
	
	{dados}

	<!-- Legenda da pesquisa -->
	<h3 align="center"><small>Visualização do id </small><strong>{IDN}</strong><small> na NCM </small><b>{ncm}</b><small> no ano de </small>{year}</h3><br>
		
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-striped'>
			
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width="8%"><b>NCM</td>
				<td width=""><b>Descrição</td>
				<td width=""><b>Categoria</td>
				<td width="%"><b>Marca</td>
				<td width="%"><b>Modelo</td>
				<td width="%"><b>Unidades</td>
			</tr>			
			
			<tr>	
				<td>{IDN}</td>
				<td>{ncm}</td>				
				<td>{DESCRICAO_DETALHADA_PRODUTO}</td>
				<td>{CNome}</td>
				<td>{MANome}</td>
				<td>{MNome}</td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
			</tr>
			{/dados}
	
	</table>