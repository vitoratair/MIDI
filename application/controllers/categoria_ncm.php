<?php 

class categoria_ncm extends CI_Controller {


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
	 * Apresenta a view com todos as categorias e associações com ncm do sitema
	 */
	public function listAll()
	{

		// Lista todos os projetos //
		$data['categorias'] = $this->categoria_model->listar();

		// Carrega a view correspondende //
		$data['main_content'] = 'categoria_ncm/categoria_ncm_view';
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	
}


