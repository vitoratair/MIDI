<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Cadastro <small>de usuários</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/user/listAll">Usuários</a> <span class="divider"> / </span></li>
            <li class="active">Cadastro de Usuários</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<!-- Estrutura -->
<div class="container">

	<div class="row-fluid margin-bottom-10">

	<?php
		$atributos = array('form class'=>'reg-page',  'id'=>'FormCadastro', 'method'=>'POST');
		echo form_open('user/setUser', $atributos); 
	?>
        	<h3>Registrar novo usuário</h3>
            <div class="controls">    

                <label>Nome <span class="color-red">*</span></label>
					<input type="text" class="span12" id="NomeUsuario"  name="NomeUsuario" rel="popover" 
					data-content="Deve ter no minimo 6 caracteres e no maxímo 45 caracteres." data-original-title="Nome" value="" autocomplete="off">				
                
				<label>Login <span class="color-red">*</span></label>
					<input type="text" class="span12" id="Login"  name="Login" rel="popover" 
					data-content="Deve possuir no mínimo 5 caracteres" data-original-title="Login" value="" autocomplete="off">				
				
				<label>Senha <span class="color-red">*</span></label>
					<input type="password" class="span12" id="password"  name="password" rel="popover" 
					data-content="Deve possuir no mínimo 6 caracteres" data-original-title="Senha" value="" autocomplete="off">				

				<label>E-mail</label>
					<input type="email" class="span12" id="Email"  name="Email" rel="popover"
					data-content="Informe seu endereco de e-mail" data-original-title="E-mail" value="" autocomplete="off">							
            </div>	

            <div class="controls">
                <div class="span6">
                    <label>Função <span class="color-red">*</span></label>

					<select id=""  name="Cargo" class="span12">
						
						{cargos}		
						<option value="{cargoID}"> {cargoNome} </option>
						{/cargos}
				    
				    </select>

                </div>
                <div class="span6">
                    <label>Unidades <span class="color-red">*</span></label>

					<select id="" name="Unidade" class="span12" >
						
						{unidades}		
						<option value="{unidadeID}"> {unidadeNome} </option>
						{/unidades}					
						
				    </select>
                </div>
            </div>

			<div class="control-group">
				<label>Tipo de usuário <span class="color-red">*</span></label>
				<div class="controls">
					<select id="" name="Tipo"class="span12">
						
						{tipos}		
						<option value="{tipoID}"> {tipoNome} </option>
						{/tipos}
						
				    </select>
				</div>
			</div>            			
			

			<div class="controls form-inline">
				<button class="btn-u pull-right" type="submit">Cadastrar</button>
			</div>
        
            <br>
            <br>
            <hr/>
		
		</form>
	</div>

</div>

<script type="text/javascript">
    var path = '<?php echo site_url(); ?>'
</script>
<!-- FIM -->


