<!-- Estrutura -->
<div class="container">

		
	<div class="page-header">
		<h2>Cadastro <small> de modelos</small></h2>
	</div>						

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('modelo/setModelo', $atributos); 
	?>

	<fieldset>

		<div class="control-group">
			<label class="control-label" for="">Nome</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" placeholder="Nome" name="nomeModelo" rel="popover" 
				data-content="Nome do modelo" data-original-title="Modelo" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo1" placeholder="Sinônimo" name="nomeModelo1" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo2" placeholder="Sinônimo" name="nomeModelo2" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo3" placeholder="Sinônimo" name="nomeModelo3" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo4" placeholder="Sinônimo" name="nomeModelo4" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>				

		<div class="control-group" >
			<label class="control-label" for="" >Marca</label>
			<div class="controls" valing="top">
				
				<select id="marca" name="marca" class="input-xlarge">
						<!-- Valor sem marca cadastrada para tratamento de erro -->
						<option value=""> Selecione a marca</option>
					
					{marcas}		
						<option value="{MAID}"> {MANome} </option>
					{/marcas}
					
			    </select>
			</div>
		</div>

		<div class="control-group" >
			<label class="control-label" for="" >Categoria</label>
			<div class="controls" valing="top">
				
				<select id="marca" onchange="alert('ad');" name="marca" class="input-xlarge">
						<!-- Valor sem marca cadastrada para tratamento de erro -->
						<option value=""> Selecione a categoria</option>
					
					{categorias}		
						<option value="{CID}"> {CNome} </option>
					{/categorias}
					
			    </select>
			</div>
		</div>	

		<div class="form-actions">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>

	</fieldset>	


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

