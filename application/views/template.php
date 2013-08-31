<?php 

	$this->load->view("template/header");

	$tipo 	 = $this->session->userdata('usuarioTipo');
	
	switch ($tipo)
	{
		
		case USER_ADMIN:
			$this->load->view("template/menu"); 
			break;

		case USER_USUARIO:
			$this->load->view("template/menu_usuario"); 
			break;

		default:
			# code...
			break;
	}

	$this->load->view($main_content);

	$this->load->view("template/footer"); 

?>