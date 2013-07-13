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

		// Lista todos as marcas //
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

		// Busca a marca com ID passado por parâmetro //
		$data['marcas'] = $this->marca_model->buscaMarca($id);

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * Adicionar marca
	 */
	public function addMarca()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'marca/marcaAdd_view';

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}			


	/**
	 * setar nova marca no banco
	 */
	public function setMarca()
	{
		// Recebe os dados do FORM //			
		$data['MANome']		= $this->input->post('marcaNome');
		$data['MANome1']	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		// Chama o model responsável pela inserção no banco //
		$this->marca_model->cadastrar($data);

		redirect('marca/listAll');

	}

	/**
	 * Atualiza a marca
	 */
	public function updateMarca()
	{
		$data['MAID'] 		= $this->input->post('ID');
		$data['MANome'] 	= $this->input->post('marcaNome');
		$data['MANome1'] 	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		$this->marca_model->updateMarca($data);

		redirect('marca/listAll');
	
	}


	/**
	 * Deleta a categoria e suas referencias em outras tabelas
	 */
	public function deleteMarca($id)
	{

		// pegar todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();

		// Loop para apagar a referencia da marca em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->marca_model->updateMarcaForNcm($value->Table,$id);
		}

		// Deleta a referencia da marca na tabela Modelo // 
		$this->marca_model->updateModelo($id);

		// Deleta a marca do banco de dados //
		$this->marca_model->deleteMarca($id);

		redirect('marca/listAll','refresh');
	}
	




	


}


