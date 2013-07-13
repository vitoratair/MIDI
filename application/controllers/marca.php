<?php 

class Marca extends CI_Controller {


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
	 * Apresenta a view com todos as marcas cadastrados no sistema 
	 */
	public function listAll()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'marca/marca_view';

		// Lista todos os projetos //
		$data['marcas'] = $this->marca_model->listarMarca();

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}	

	/**
	 * Edição da marca
	 */
	public function editMarca($id)
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'marca/marcaEdit_view';

		// Lista todos os projetos //
		$data['marcas'] = $this->marca_model->buscaMarca($id);

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}		




	


}


