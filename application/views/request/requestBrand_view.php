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
		echo form_open('request/brandAndModel', $atributos); 
	?>				

		<blockquote>
			
			<label class="radio">
				<?php 
					if ($op == 1)
						echo "<input type=\"radio\" name=\"radio\"  value=\"1\" checked onClick=\"this.form.submit();\">Marcas";
					else
						echo "<input type=\"radio\" name=\"radio\"  value=\"1\" onClick=\"this.form.submit();\">Marcas";
				?>				
			</label>

			<label class="radio">
				<?php 
					if ($op == 2)
						echo "<input type=\"radio\" name=\"radio\"  value=\"2\" checked onClick=\"this.form.submit();\">Modelos";
					else
						echo "<input type=\"radio\" name=\"radio\"  value=\"2\" onClick=\"this.form.submit();\">Modelos";
				?>					
			</label>

		</blockquote>

	</form>	

	<div class="headline" align="center">
		<h3>Requisições de Marcas</h3>
	</div>


	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-hover'>
			
		<thead>
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width=""><b>Marca</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td colspan="2" width=""><b>Opções</b></td>
			</tr>			
		</thead>
		{dados}	

			<tr class="table-condensed">	
				<td>{maid}</td>	
				<td>{nome}</td>						
				<td>{nome1}</td>
				<td>{nome2}</td>
				<td><a onclick='Excluir("{maid}")' data-toggle="modal" href="#deletar" class='icon-trash'></a></td>								
				<td><a onclick='Adicionar("{maid}", "{nome}", "{nome1}", "{nome2}")' data-toggle="modal" href="#add" class='icon-check'></a></td>
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


	<div class="modal hide" id="add">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					×
				</button>
				<h3>Adicionar</h3>
			</div>

			<div class="modal-body">
				<p>Deseja realmente adicionar a marca?</p>
			</div>

			 <div class="modal-footer">
				<a href="" class="btn" data-dismiss="modal">Não</a>
				<a href="" class="btn-u btn-u-red" id="add">Sim</a>
		 	</div>
	</div>

<script type="text/javascript">

	function Excluir(id)
	{
		document.getElementById("Excluir");
		document.getElementById('Excluir').href="<?php echo base_url();?>index.php/request/deleteRequestBrand/"+id;
	}

	function Adicionar(maid, nome, nome1, nome2)
	{
		var url = '<?php echo base_url();?>index.php/request/setBrandRequest';
        form = $('<form action="' + url + '" method="POST">' +
		'<input type="hidden" name="maid" value="' + maid + '" />' +
		'<input type="hidden" name="marcaNome" value="' + nome + '" />' +
		'<input type="hidden" name="marcaNome1" value="' + nome1 + '" />' +
		'<input type="hidden" name="marcaNome2" value="' + nome2 + '" />' +	
		'</form>');
        $('body').append(form);
        $(form).submit();
	}	

</script>