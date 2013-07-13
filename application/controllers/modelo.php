<?php 

class Modelo extends CI_Controller {


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
	 * Apresenta a view com todos os modelos cadastrados no sistema por categoria
	 */
	public function listModeloByCategoria($id)
	{

		$table = array();
		$check = FALSE;

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

		// Lista todos os modelos //
		$data['modelos'] = $this->modelo_model->listarModeloByCategoria($id);

		// pegar todas as tabelas de NCMs do sistema
		$ncms = $this->categoria_model->getAllNcm();
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->modelo_model->verificarCadastro($id,$value->Table,$value1->MOID);
				$countModelos = $countModelos[0]->IDN;

				if ($countModelos != 0)
				{
					$check = TRUE;
					break;
				}				
			}			

			if ($check == TRUE)
			{
				$value1->CHECK = 'icon-ok';
			}
			else
			{
				$value1->CHECK = 'icon-remove';	
			}

		}	

		// // Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// // Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}	


	/**
	 * Apresenta a view com todos os modelos cadastrados no sistema 
	 */
	public function listAll()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

		// Lista todos os modelos //
		$data['modelos'] = $this->modelo_model->listarModelo();			

		// Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}	

	/**
	 * Apresenta a view para edição de modelos
	 */
	public function editModelo($id)
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modeloEdit_view';

		// Busca a lista de marcas cadastradas no sistema //
		$data['marcas'] = $this->modelo_model->listarMarca();

		// Lista todos os modelos //
		$data['modelos'] = $this->modelo_model->bucaModelo($id);			

		// // Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}	





}


