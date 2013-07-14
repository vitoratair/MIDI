
<!-- Estrutura -->
 <div class="container">

 	<div class="page-header">
 		<h2>
 			Perfil <small> do Usuário</small>
 		</h2>
 	</div>
  
<div class="span12">

	<div class="row">

	<ul class="thumbnails">
  	
  	<li class="span">
    <div class="thumbnail" align = "center">
      <img src="<?php echo base_url();?>img/users.jpg"  alt="" width="150px">
{usuario} 
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
 		<button class="btn btn-info" id="AlterarSenha"> Alterar a Senha </button>

 		<br>
 		<br>
 		<br>

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
						<input class="input-xlarge" id="senhaAtual" type="password" name="">
						<i class="icon-ok" id="Pass_atual_ok"></i>
						<i class="icon-remove" id="Pass_atual_nok"></i>	
				</div>
			</div>

			<!-- nova senha -->
			<div class="control-group">
				<label class="control-label" for="">Nova Senha</label>
				<div class="controls">
						<input class="input-xlarge" id="senhaNova" type="password" name="">
						<i class="icon-ok" id="Pass_novo_ok"></i>
						<i class="icon-remove" id="Pass_novo_nok"></i>
						<small id='msg_tamanho' class="alert hide alert-error"> Nova senha deve possuir no minimo 1 e no maximo 8 caracteres !</small>
				</div>
			</div>

			<!-- confirmacao da senha -->
			<div class="control-group">
				<label class="control-label" for="">Repetir Senha</label>
				<div class="controls">
						<input class="input-xlarge" id="senhaConf" type="password" name="">
						<i class="icon-ok" id="Pass_conf_ok"></i>
						<i class="icon-remove" id="Pass_conf_nok"></i>	
				</div>
			</div>

			<div class="">
				<button class="btn btn-danger" id="submit_altera_senha"> Confirmar </button>
		 	</div>
		</div>


 	</li>
	</ul>

	</div>
{/usuario}
</div>	

<br>


<script type="text/javascript">
    var path = '<?php echo site_url(); ?>'
</script>
<!-- FIM -->
