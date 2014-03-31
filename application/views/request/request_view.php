<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Requisições  <small>para alteração</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Administração <span class="divider"> / </span></li>
            <li class="active">Processamento</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">			
		
	<!-- Formulário para combobox sem botão submit -->
	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('request/listAll', $atributos); 
	?>				

		<div class="control-group" align="right">

			<select id="categoria" onchange="this.form.submit()" name="categoria" class="span2">
				
				<option value=""> Categoria</option>
				{categorias}		
					<option value="{CID}">{CNome}</option>
				{/categorias}
				
		    </select>			
		</div>

	</form>	

	<div class="headline" align="center">
		<h3>Requisições referente a categoria {categoria}</h3>
	</div>


	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-hover'>
			
		<thead>
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width=""><b>Descrição</b></td>
				<td width=""><b>Usuário</b></td>
				<td width=""><b>Categoria</b></td>
				<td width=""><b>Marca</b></td>
				<td width=""><b>Modelo</b></td>
				<td width=""><b>Opções</b></td>
			</tr>			
		</thead>
		{dados}	

			<tr class="table-condensed">	
				<td>{idn}</td>	
				<td>{descricao}</td>
				<td>{user}</td>
				<td><font color=""><strong>{categoriaRe}</strong></font></td>
				<td><font color=""><strong>{marcaRe}</strong></font></td>				
				<td><font color=""><strong>{modeloRe}</strong></font></td>							
				<td><a onclick='Excluir("{idRe}")' data-toggle="modal" href="#deletar" class='icon-trash'></a></td>								
			</tr>					
		{/dados}			
	</table>
	
	<div align="center">
		{links}
	</div>	

</div>


<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da categoria -->	
	
	<div class="modal hide" id="deletar">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					×
				</button>
				<h3>Exclusão de requisição</h3>
			</div>

			<div class="modal-body">
				<p>Deseja realmente excluir a requisição?</p>
			</div>

			 <div class="modal-footer">
				<a href="" class="btn" data-dismiss="modal">Não</a>
				<a href="" class="btn-u btn-u-red" id="Excluir">Sim</a>
		 	</div>
	</div>


	<div class="modal hide" id="alterar">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					×
				</button>
				<h3>Alteração</h3>
			</div>

			<div class="modal-body">
				<p>Deseja realmente realizar a alteração?</p>
			</div>

			 <div class="modal-footer">
				<a href="" class="btn" data-dismiss="modal">Não</a>
				<a href="" class="btn-u btn-u-red" id="altera">Sim</a>
		 	</div>
	</div>

<script type="text/javascript">

	function Excluir(id)
	{

		document.getElementById("Excluir");
		document.getElementById('Excluir').href="<?php echo base_url();?>index.php/request/deleteRequest/"+id;
	}

	
	function altera(id, idn, table, categoria, marca, modelo)
	{
	
		if (modelo == "{categoriaReID}")
		{
			modelo = 'NULL';
		}

		if (modelo == "{marcaReID}")
		{
			modelo = 'NULL';
		}

		if (modelo == "{modeloReID}")
		{
			modelo = 'NULL';
		}
		document.getElementById("altera");
		document.getElementById('altera').href="<?php echo base_url();?>index.php/request/updateRequest/"+id+"/"+table+"/"+idn+"/"+categoria+"/"+marca+"/"+modelo;

	}	


</script>



