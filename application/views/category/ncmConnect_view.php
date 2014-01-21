<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">{categoriaNome}{CNome}{/categoriaNome}<small> - selecione as NCMs</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/category/listAll">Categoria</a> <span class="divider"> / </span></li>
            <li class="active">Associar NCM</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">
					
	<blockquote>
		<?php
			$atributos = array('form class'=>'',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('category/connectNcmCategoria', $atributos); 

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
	</blockquote>

	<input type="hidden" class="span3" id="idCategoria" value='{id}' name="idCategoria">
	<div class="form-actions">
		<button type="submit" class="btn btn-large btn-u">Salvar</button>
	</div>
</div>

