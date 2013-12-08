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
		<h3>Não consta novas requisições de Modelos</h3>
	</div>

</div>
