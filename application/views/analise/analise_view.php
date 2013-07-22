<!-- Estrutura -->
<div class="container">
				
	<div class="">
		<h2>Análise <small> de importações</small></h2>
	</div>
	<br>									

	<?php
		$atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('analise/listAll', $atributos); 
	?>

	<div align="right">
		<select id="categoria"  name="categoria" class="span3" onchange="this.form.submit()">					
			
			<option value=""> Selecione uma categoria </option>					
			{categorias}	
				<option value="{CID}">{CNome}</option>
			{/categorias}
			
	    </select>
    </div>

	<hr>
	
	<table border="0px">
		<tr>
			<td>
				

			</td>

			<td align="right">
				
				<table class='table table-bordered table-striped' id="idTabela" align="right">
						
						<tr class="">				
							<td width="5%"><b>Ano</b></td>
							<td width=""><b>Unidades</td>
							<td width=""><b>Volume</td>
							<td width=""><b>Detalhes</td>
						</tr>			

						{dados}
						
						<tr>	
							<td>{ano}</td>
							<td>{unidades}</td>
							<td>{volume}</td>
							<td><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
						</tr>

						{/dados}
				
				</table>

			</td>

		</tr>

	</table>
 