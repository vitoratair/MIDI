<!-- Estrutura -->
<div class="container">

		
	<div class="page-header">
		<h2>Cadastro <small> de modelos</small></h2>
	</div>						

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('modelo/setModelo', $atributos); 
	?>

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
					<input type="text" class="span2" id="nomeModelo" placeholder="" name="nomeModelo">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo1" name="nomeModelo1">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo2" name="nomeModelo2">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo3" name="nomeModelo3">
				</td>
				<td>
					<input type="text" class="span2" id="nomeModelo4" name="nomeModelo4">
				</td>
				<td>
					<select id="marca"  name="marca" class="span2">					
						<option value=""> - </option>
						{marcas}	
							<option value="{MAID}">{MANome}</option>
						{/marcas}
						
				    </select>
				</td>																				
				<td>
					<select id="categoria"  name="categoria" class="span2">					
							<option value=""> - </option>					

						{categorias}	
							<option value="{CID}">{CNome}</option>
						{/categorias}
						
				    </select>			
			    </td>
			</tr>		
	</table>
		<div class="form-actions">
			<input type="hidden" value="{modeloID}" name="id">
			<button type="submit" class="btn btn-success" id="salvar">Salvar</button>
			<button class="btn" type="reset">Voltar</button>
		</div>

	</fieldset>	
</form>

<!-- Modal mensagem salvar -->

<div id="salvar" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
  	</div>

  
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Aplicar</button>
  </div>
</div>

