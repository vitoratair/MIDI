<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição  <small>de modelos</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/model/listAll">Modelos</a> <span class="divider"> / </span></li>
            <li class="active">Edição de modelos</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">
	
	<div class="row-fluid margin-bottom-10">
		
	<?php
		$atributos = array('form class'=>'reg-page',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('model/updateModel', $atributos); 
	?>

	{modelos}
			<h3>Edição de modelos</h3>
				
            <div class="controls">    
                <label>Modelo <span class="color-red">*</span></label>
				<input type="text" class="span12" id="nomeModelo0" value="{MNome0}" name="nomeModelo0">

                <label>Sinônimo <span class="color-red">*</span></label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome}" name="nomeModelo">				
                
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome1}" name="nomeModelo1">
				
				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome2}" name="nomeModelo2">

				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome3}" name="nomeModelo3">

				<label>Sinônimo</label>
				<input type="text" class="span12" id="nomeModelo" value="{MNome4}" name="nomeModelo4">
            </div>

            <div class="controls">
                <div class="span6">
                    <label>Marca <span class="color-red">*</span></label>
					<select id="marca"  name="marca" class="span12">					
						{marca}
							<option value="{MANome}"> {MANome}</option>					
						{/marca}
						{marcas}	
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>
                </div>
                <div class="span6">
                    <label>Categoria <span class="color-red">*</span></label>

					<select id="categoria"  name="categoria" class="span12">					
						{categoria}
							<option value="{CID}"> {CNome}</option>					
						{/categoria}
						{categorias}	
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>
                </div>
            </div>


            <div class="controls form-inline">
            	<input type="hidden" value="{MOID}" name="id">
                <button class="btn-u pull-right" type="submit">Atualizar</button>
            </div>
            <br><br>
            <hr />
			
        </form>
</div>
	<br>
	<hr>
	<br>
	<!-- subcategorias -->
	<h3 align="center"><small>Edição das subcategorias do modelo </small><strong>{MNome}</strong></h3><br>
		
	<!-- Tabela com a lista dos categoria do sistema -->
	<table class='table table-bordered table-hover'>			
		<thead>
			<tr>				
				<td width="5%"><b>ID</b></td>
				<td width="47%"><b>Subcategoria</b></td>
				<td width="47%"><b>Item</b></td>
			</tr>			
		</thead>	
	{titulos}
			<tr class="table-condensed">	
				<td>{TColuna}</td>
				<td>{TNome}</td> 
				<td><a href="#subcategoria{TColuna}" data-toggle="modal">{SubCategoria}</a></td>				
			</tr>
	{/titulos}
	
	</table>
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">	
	
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
<form action="<?php echo base_url();?>index.php/model/updateModel" method="POST">
	
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