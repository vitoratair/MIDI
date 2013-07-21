<!-- Estrutura -->
<div class="container">

		
	<div class="page-header">
		<h2>Edição <small> edição de modelos</small></h2>
	</div>						

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('modelo/updateModelo', $atributos); 
	?>	
	{modelos}
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-condensed table-striped'>
			
			<tr class="">				
				<td width=""><strong>Nome</strong></td>				
				<td width=""><strong>Sinônimo</strong></td>
				<td width=""><strong>Sinônimo</strong></td>
				<td width=""><strong>Sinônimo</strong></td>
				<td width=""><strong>Sinônimo</strong></td>
				<td width=""><strong>Marca</strong></td>
				<td width=""><strong>Categoria</strong></td>
			</tr>			
			
			<tr>					
				<td>
					<input type="text" class="span2" id="nomeModelo" value="{MNome}" name="nomeModelo">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo" value="{MNome1}" name="nomeModelo1">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo" value="{MNome2}" name="nomeModelo2">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo" value="{MNome3}" name="nomeModelo3">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo" value="{MNome4}" name="nomeModelo4">
				</td>
				<td>
					<select id="marca"  name="marca" class="span2">					
						{marca}
							<option value="{MANome}"> {MANome}</option>					
						{/marca}
						{marcas}	
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>
				</td>																				
				<td>
					<select id="categoria"  name="categoria" class="span2">					
						{categoria}
							<option value="{CID}"> {CNome}</option>					
						{/categoria}
						{categorias}	
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>			
			    </td>
			</tr>		
	</table>
		<div class="form-actions">
			<input type="hidden" value="{MOID}" name="id">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Voltar</button>
		</div>

	</fieldset>	
</form>
	<!-- subcategorias -->
	<h3 align="center"><small>Edição subcategorias para o modelo </small><strong>{MNome}</strong></h3><br>
		
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-striped'>			
			<tr class="">				
				<td width="5%"><b>ID</b></td>
				<td width="47%"><b>Subcategoria</td>
				<td width="47%"><b>Item</td>
			</tr>			
	{titulos}
			<tr>	
				<td>{TColuna}</td>
				<td>{TNome}</td> 
				<td><a href="#subcategoria{TColuna}" data-toggle="modal">{SubCategoria}</a></td>				
			</tr>
	{/titulos}
	
	</table>
	
	<div class=" form-search" align="right">
		<a href="<?php echo base_url();?>index.php/modelo/listAll" class="btn btn-success"><i class="icon-circle-arrow-left icon-white"></i> Voltar</a>	  
	</div>



<!-- Java Script com modal para alteração da marca -->

<!-- Modal MARCA ALTERAR-->

<div id="modalMarca" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
  	</div>

	{marcas}
	
			<input type="radio" name="marca" value="">{MANome}<br>
	
  	{/marcas}
  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Aplicar</button>
  </div>
</div>




<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração das subcategorias ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da subcategoria1 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria1">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria1}
			<input type="radio" name="subcategoria1" value="{SCID}"> {SCNome}<br>
{/subcategoria1}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria2 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria2">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria2}
			<input type="radio" name="subcategoria2" value="{SCID}"> {SCNome}<br>
{/subcategoria2}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria3 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria3">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria3}
			<input type="radio" name="subcategoria3" value="{SCID}"> {SCNome}<br>
{/subcategoria3}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria4 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria4">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria4}
			<input type="radio" name="subcategoria4" value="{SCID}"> {SCNome}<br>
{/subcategoria4}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria5 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria5">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria5}
			<input type="radio" name="subcategoria5" value="{SCID}"> {SCNome}<br>
{/subcategoria5}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria6 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria6">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria6}
			<input type="radio" name="subcategoria6" value="{SCID}"> {SCNome}<br>
{/subcategoria6}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria7 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria7">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria7}
			<input type="radio" name="subcategoria7" value="{SCID}"> {SCNome}<br>
{/subcategoria7}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>

<!-- Modal para alteração da subcategoria8 -->
<form action="<?php echo base_url();?>index.php/modelo/updateModelo" method="POST">	
	
	<div class="modal hide" id="subcategoria8">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Alteração da subcategoria</h3>
		</div>	
		<div class="modal-body">			

{subcategoria8}
			<input type="radio" name="subcategoria8" value="{SCID}"> {SCNome}<br>
{/subcategoria8}

			</div>
		<div class="modal-footer">
			<a href="" class="btn" data-dismiss="modal">Não</a>
			<input type="hidden" value="{MOID}" name="id">
			<input type="hidden" value="1" name="controle">
			<button type="submit" class="btn btn-danger">Sim</button>
		</div>	
	</div>
</form>






{/modelos}