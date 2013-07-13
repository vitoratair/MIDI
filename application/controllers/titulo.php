<?php 

class Titulo extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}


	/**
	 * Verifica se o usuario está logado
	 */
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	
	/**
	 * Apresenta a view com todos os titulos cadastrados no sistema 
	 */
	public function listAll()
	{

		// Lista todos os projetos //
		$data['titulos'] = $this->titulo_model->listar();

		// Carrega a view correspondende //
		$data['main_content'] = 'categoria/categoria_view';
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}
	
}


