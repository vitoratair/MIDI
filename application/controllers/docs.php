<?php 

class Docs extends CI_Controller {


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
	 * Apresenta a view com todos as categorias cadastrados no sistema 
	 */
	public function listAll()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'docs/docs_view';
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}
	


}


