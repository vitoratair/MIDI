<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
	<div class="container">
        <h1 class="pull-left">Perfil <small>de usuário</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li>Usuários <span class="divider"> / </span></li>
            <li class="active">Edição de senha</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


{usuario}
<!-- Estrutura -->
<div class="container">
	<div class="span12">
		<div class="row">
			
			<ul class="thumbnails">		  	
			  	
			  	<li class="span">
			    	<div class="thumbnail" align = "center">
			      		<img src="<?php echo base_url();?>assets/img/user-perfil.jpg"  alt="" width="200px">
						<p><small>{tipoNome}</small></p>
		    		</div>
		  		</li>
		  		
		  		<li class="span">	      
		      		<h3>{usuarioNome}</h3>
			      	<div>
						
			      		<h4>Email: <small> {usuarioEmail}</small></h4>
			 			<h4>Login: <small> {usuarioLogin}</small></h4>

			 		</div>
		 			<hr>

			 		<button class="btn-u" id="AlterarSenha"> Alterar senha </button>
		 			<br><br>	
			 		<div class="hide" id="Altera">

			 			<!-- Cadastro efetuado com sucesso -->
						<div class="alert hide alert-success" id="CadastroPass_ok">
							<p> Senha alterada com sucesso !</p>
						</div>
						<div class="alert hide alert-error" id="CadastroPass_nok">
							<p> Não foi possivel alterar a senha !</p>
						</div>	

				 		<!-- senha Atual -->
						<div class="control-group">
							<label class="control-label" for="">Senha Atual</label>
							<div class="controls">
									<input class="span3" id="senhaAtual" type="password" name="">
									<i class="icon-ok" id="Pass_atual_ok"></i>
									<i class="icon-remove" id="Pass_atual_nok"></i>	
							</div>
						</div>

						<!-- nova senha -->
						<div class="control-group">
							<label class="control-label" for="">Nova Senha</label>
							<div class="controls">
									<input class="span3" id="senhaNova" type="password" name="">
									<i class="icon-ok" id="Pass_novo_ok"></i>
									<i class="icon-remove" id="Pass_novo_nok"></i>
									<small id='msg_tamanho' class="alert hide alert-error"> Nova senha deve possuir no minimo 1 e no maximo 8 caracteres !</small>
							</div>
						</div>

						<!-- confirmacao da senha -->
						<div class="control-group">
							<label class="control-label" for="">Repetir Senha</label>
							<div class="controls">
									<input class="span3" id="senhaConf" type="password" name="">
									<i class="icon-ok" id="Pass_conf_ok"></i>
									<i class="icon-remove" id="Pass_conf_nok"></i>	
							</div>
						</div>

						<div class="">
							<button class="btn-u btn-u-red" id="submit_altera_senha"> Confirmar </button>
					 	</div>
					</div>

		 		</li>
			</ul>

		</div> <!-- End Row -->
	</div> <!-- End span12 -->
</div> <!-- End container -->

{/usuario} <!-- End foreach -->


<script type="text/javascript">
    var path = '<?php echo site_url(); ?>'
</script>
<!-- FIM -->


