<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Visualização  <small>de dados</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Processamento</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">
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
				<!-- Exibindo o nome do modelo que não foi utilizado para o parser -->
				<!-- <td>{MNome0}</td> -->

				<td>{MNome}</td>
				<td>{QUANTIDADE_COMERCIALIZADA_PRODUTO}</td>				
				<td><a href="<?php echo base_url();?>index.php/ncm/edit/{IDN}/{ncm}/{ano}" target="_blank"><i class="icon-edit"></a></i></td>
			</tr>
			{/dados}
	
	</table>

	<div align="center">
		{links}	
	</div>

</div>	
	