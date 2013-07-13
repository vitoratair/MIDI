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

		$check = FALSE;

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

		// Configurando paginação //
        $config["base_url"] 	= base_url() . "index.php/modelo/listModeloByCategoria/$id";
        $config["per_page"] 	= 20;
        $config["total_rows"] 	= $this->modelo_model->countModeloByCategoria($id);

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Lista todos os modelos //
        $data["modelos"] = $this->modelo_model->listarModeloByCategoria($id,$config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

		// pegar todas as tabelas de NCMs do sistema
		$ncms = $this->categoria_model->getAllNcm();
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->modelo_model->verificarCadastro($value->Table,$value1->MOID);
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

		// Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}	


	/**
	 * Apresenta a view com todos os modelos cadastrados no sistema 
	 */
	public function listAll()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

        $config["base_url"] 	= base_url() . "index.php/modelo/listAll";
        $config["total_rows"] 	= $this->modelo_model->countModelo();
	    $config["per_page"] 	= 20;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data["modelos"] = $this->modelo_model->listarModelo($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

		// pegar todas as tabelas de NCMs do sistema
		$ncms = $this->categoria_model->getAllNcm();
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->modelo_model->verificarCadastro($value->Table,$value1->MOID);
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


