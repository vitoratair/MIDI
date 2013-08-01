<!-- Estrutura -->
<div class="container">

		<div class="page-header">
			<h2>{categoriaNome}{CNome}{/categoriaNome}<small>, selecione as NCMs referente a categoria escolhida</small></h2>
		</div>						
					
	<table class="table table-striped">					
		<?php
			$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('categoria/updateAssociarCategoria', $atributos); 
		?>		

 		<?php
	
			foreach ($ncm as $key => $value)
			{			
				if (in_array($ncm[$key]->NID, $categoria))
				{
					echo
					"
						<label class=\"checkbox\">
						  <input type=\"checkbox\" CHECKED name=categoriancmNCMs[] value=\"".$ncm[$key]->NID."\">
						  ".$ncm[$key]->NNome." - ".$ncm[$key]->NDescricao."

						</label>					
					";
				}
		    	else
		    	{
					echo
					"
						<label class=\"checkbox\">
						  <input type=\"checkbox\" name=categoriancmNCMs[] value=\"".$ncm[$key]->NID."\">
						  ".$ncm[$key]->NNome." - ".$ncm[$key]->NDescricao."
						</label>					
					";		    		
		    	}
			}
		?> 
			
			<input type="hidden" class="input-xlarge" id="idCategoria" value='{id}' name="idCategoria">
			<div class="form-actions">
				<button type="submit" class="btn btn-success">Alterar</button>
			</div>		


	<br>

<!-- FIM -->



