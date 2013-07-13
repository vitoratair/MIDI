<?php 

class ncm extends CI_Controller {


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
	 * Apresenta a view com todos as NCMs cadastrados no sistema 
	 */
	public function listAll()
	{

		// Lista todos os projetos //
		$data['ncm'] = $this->ncm_model->listar();

		// Carrega a view correspondende //
		$data['main_content'] = 'ncm/ncm_view';
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}


	/**
	 * Apresenta view de cadastro de novas categorias
	 */
	public function addNCM()
	{
		// Carrega a view correspondende //
		$data['main_content'] = 'ncm/addNcm_view';

		// Envia todas as informações para tela //			
		$this->load->view('template',$data);
		// $this->parser->parse('template', $data);		
	}

	/**
	 * setar nova categoria no banco
	 */
	public function setNCM()
	{
		// Recebe os dados do FORM //			
		$data['NID'] = $this->input->post('ID');

		$data['NNome'] = $this->input->post('ncmNome');

		$data['NDescricao'] = $this->input->post('ncmDescricao');

		// Chama o model responsável pela inserção no banco //
		$this->ncm_model->cadastrar($data);

		redirect('ncm/listAll');

	}


	/**
	 * Recupera as informações de ncm e grava no banco de dados
	 */
	public function editNCM($id)
	{
		$data['main_content'] = 'NCM/editNcm_view';	

		// busca as informações da categoria
		$data['ncmNome'] = $this->ncm_model->buscar($id);
		
		$this->parser->parse('template',$data);
	
	}
	
	/**
	 * Atualiza a categoria
	 */
	public function updateNCM()
	{
		$data['NID'] = $this->input->post('ID');
		$data['NNome'] = $this->input->post('ncmNome');
		$data['NDescricao'] = $this->input->post('ncmDescricao');

		$this->ncm_model->updateNCM($data);

		redirect('ncm/listAll');
	
	}



	/**
	 * Deleta a NCM e suas referencias em outras tabelas
	 */
	public function deleteNCM($id)
	{

		// Deleta a referencia da NCM na tabela NCM-has-Categoria // 
		$this->ncm_model->updateNCMForDelete($id);
		
		// deleta a categoria do banco de dados //
		// $this->categoria_model->deleteCategoria($id);

		redirect('ncm/listAll','refresh');
	}
	
}


