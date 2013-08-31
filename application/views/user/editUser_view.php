<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Edição <small>de usuários</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="<?php echo base_url();?>index.php/user/listAll">Usuários</a> <span class="divider"> / </span></li>
            <li class="active">Edição de Usuários</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">

	<div class="row-fluid margin-bottom-10">
		<?php
			$atributos = array('form class'=>'reg-page',  'id'=>'FormCadastro', 'method'=>'POST');
			echo form_open('user/updateUser', $atributos);
		?>

			<h3>Edição de usuário</h3>

			
			<label>Nome <span class="color-red">*</span></label>
			<input type="text" id="Nome" name="Nome" class="span12" value='{usuarioNome}'>

			<label>Login <span class="color-red">*</span></label>
			<input type="text" id="Login" name="Login" class="span12" id="input01" value='{usuarioLogin}'>

			<label>E-mail </label>
			<input type="text" name="Email" class="span12" id="input01" value="{usuarioEmail}">

            <div class="controls">
                <div class="span6">
                    <label>Função <span class="color-red">*</span></label>

					<select id="" name="Cargo" class="span12">

					<option value="{cargoIDUser}">{cargoNomeUser}</option> 
					{cargos}
						<option value="{cargoID}">{cargoNome}</option> 
					{/cargos}
					</select>

                </div>
                <div class="span6">
                    <label>Unidades <span class="color-red">*</span></label>

					<select id="" name="Unidade" class="span12" >
						
						<option value="{unidadeIDUser}">{unidadeNomeUser}</option> 
						{unidades}
							<option value="{unidadeID}">{unidadeNome}</option> 
						{/unidades}
						</select>
                </div>
            </div>

			<div class="control-group">
				<label>Tipo de usuário <span class="color-red">*</span></label>
				<div class="controls">
					<select id="" name="Tipo" class="span12"> 
					<option value="{tipoIDUser}">{tipoNomeUser}</option> 
					{tipos}
						<option value="{tipoID}">{tipoNome}</option> 
					{/tipos}

					</select>
				</div>
			</div> 			


			
			<div class="controls form-inline">
				<input type="hidden" class="span12" id="ID" value='{usuarioID}' name="ID">
				<button class="btn-u pull-right" type="submit">Atualizar</button>
			</div>
        
            <br>
            <br>
            <hr/>

		</form>

	</div>
</div>


