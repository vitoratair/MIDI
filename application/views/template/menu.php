<!-- Navbar
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
  	<div class="navbar-inner">
    	<div class="container">

	    	<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
	      	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	      	</a>

			<div class="btn-group pull-right">
				
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> 
					
					<?php 

						$usuario = $this->session->userdata('usuarioLogin');
						$tipo 	 = $this->session->userdata('usuarioTipo');
					?>
					
					<i class="icon-user"> </i> <?php echo $usuario ?> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<input type="hidden" class="input-xlarge" id="login" value='{usuarioLogin}' name="login">
					<li><?php echo anchor("usuario/pageUser/$usuario",'Perfil');?></li>
					<li><?php echo anchor("requisicoes/listAll",'Requisições');?></li>
					<li class="divider"></li>
					<li><?php echo anchor('login/logout','Sair');?></li>
					
				</ul>
			</div>



          	<div class="nav-collapse">
            	
            	<ul class="nav">
              							
					<li><?php echo anchor('app/home','Home');?></li>

					<li class="dropdown">
						
						<a class="dropdown-toggle" href="#">Cadastro </a>
						
						<ul class="dropdown-menu">
							
							<li><?php echo anchor('categoria/listAll','Categoria');?></li>						

							<li><?php echo anchor('ncm/listAll','NCM');?></li>													

							<li><?php echo anchor('marca/listAll','Marca');?></li>
							
							<li><?php echo anchor('modelo/listAll','Modelo');?></li>

							<li><?php echo anchor('usuario/listAll','Usuário');?></li>

						</ul>
					</li>					

					<li><?php echo anchor('pesquisa/listAll','Pesquisa');?></li>

					<li><?php echo anchor('analise/listAll','Análise');?></li>
					
				</ul>
			</div>

		</div>
	</div>
</div>
