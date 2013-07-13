<!-- Estrutura -->
<div class="container">

		
	<div class="page-header">
		<h2>Edição <small> edição de modelos</small></h2>
	</div>						

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('modelo/updateModelo', $atributos); 
	?>

	<fieldset>
		{modelos}
	


		<div class="control-group">
			<label class="control-label" for="">ID</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="idModelo" value="{MOID}" name="idModelo" disabled>
			</div>
		</div>


		<div class="control-group">
			<label class="control-label" for="">Nome</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" value="{MNome}" name="nomeModelo" rel="popover" 
				data-content="Nome do modelo" data-original-title="Modelo" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" value="{MNome1}" name="nomeModelo1" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" value="{MNome2}" name="nomeModelo2" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" value="{MNome3}" name="nomeModelo3" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="">Sinônimo</label>
			<div class="controls">
				<input type="text" class="input-xlarge" id="nomeModelo" value="{MNome4}" name="nomeModelo4" rel="popover" 
				data-content="Sinônimo do modelo" data-original-title="Sinônimo" autocomplete="off">
			</div>
		</div>		

		<div class="control-group" >
			<label class="control-label" for="" >Marca</label>
			<div class="controls" valing="top">
				<b><a  class="" href="#modalMarca" data-toggle="modal">{MANome}</a></b>
			</div>
		</div>		


		<div class="form-actions">
			<button type="submit" class="btn btn-success">Salvar</button>
			<button class="btn" type="reset">Limpar</button>
		</div>

	{/modelos}
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

