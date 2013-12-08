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
		<h3>Requisições de Modelos</h3>
	</div>


	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered table-hover'>
			
		<thead>
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<td width=""><b>Categoria</b></td>
				<td width=""><b>Marca</b></td>
				<td width=""><b>Nome</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td width=""><b>Sinônimo</b></td>
				<td width=""><b>Sinônimo</b></td>
				<!-- <td width=""><b>Subcategorias</b></td> -->
				<td colspan="2" width=""><b>Opções</b></td>
			</tr>			
		</thead>
		{dados}	

			<tr class="table-condensed">	
				<td>{moid}</td>	
				<td>{categoriaNome}</td>						
				<td>{marcaNome}</td>
				<td>{nome}</td>
				<td>{nome1}</td>
				<td>{nome2}</td>
				<td>{nome3}</td>
				<td>{nome4}</td>
				<td>{nome5}</td>
				<!-- <td><a data-toggle="modal" href="#visualizar" class='icon-search'></a></td> -->
				<td><a onclick='Excluir("{moid}")' data-toggle="modal" href="#deletar" class='icon-thumbs-down'></a></td>
				<td><a onclick='Adicionar("{moid}", "{nome}", "{nome1}", "{nome2}", "{nome3}", "{nome4}","{nome5}","{categoria}", "{marca}","{sc1}", "{sc2}", "{sc3}", "{sc4}", "{sc5}", "{sc6}", "{sc6}", "{sc7}", "{sc8}")' data-toggle="modal" href="#add" class='icon-thumbs-up'></a></td>				
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
				<p>Deseja realmente adicionar o modelo?</p>
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
		document.getElementById('Excluir').href="<?php echo base_url();?>index.php/request/deleteRequestModel/"+id;
	}

	function Adicionar(moid, MNome0, MNome, MNome1, MNome2, MNome3, MNome4, Categoria_CID, Marca_MAID, SubCategoria1_SCID, SubCategoria2_SCID, SubCategoria3_SCID, SubCategoria4_SCID, SubCategoria5_SCID, SubCategoria6_SCID, SubCategoria7_SCID, SubCategoria8_SCID)
	{
		var url = '<?php echo base_url();?>index.php/model/setRequestModel';
        form = $('<form action="' + url + '" method="POST">' +
          '<input type="hidden" name="moid" value="' + moid + '" />' +
          '<input type="hidden" name="nome" value="' + MNome0 + '" />' +
          '<input type="hidden" name="nome1" value="' + MNome + '" />' +
          '<input type="hidden" name="nome2" value="' + MNome1 + '" />' +
          '<input type="hidden" name="nome3" value="' + MNome2 + '" />' +
          '<input type="hidden" name="nome4" value="' + MNome3 + '" />' +
          '<input type="hidden" name="nome5" value="' + MNome4 + '" />' +
          '<input type="hidden" name="categoria" value="' + Categoria_CID + '" />' +
          '<input type="hidden" name="marca" value="' + Marca_MAID + '" />' +
          '<input type="hidden" name="sc1" value="' + SubCategoria1_SCID + '" />' +
          '<input type="hidden" name="sc2" value="' + SubCategoria2_SCID + '" />' +
          '<input type="hidden" name="sc3" value="' + SubCategoria3_SCID + '" />' +
          '<input type="hidden" name="sc4" value="' + SubCategoria4_SCID + '" />' +
          '<input type="hidden" name="sc5" value="' + SubCategoria5_SCID + '" />' +
          '<input type="hidden" name="sc6" value="' + SubCategoria6_SCID + '" />' +
          '<input type="hidden" name="sc7" value="' + SubCategoria7_SCID + '" />' +
          '<input type="hidden" name="sc8" value="' + SubCategoria8_SCID + '" />' +
          '</form>');
        $('body').append(form);
        $(form).submit();
	}	

</script>