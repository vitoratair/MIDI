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
	public function listModeloByCategoria()
	{		
		$id = $this->input->post('categoria');		
		$data['idCategoria'] = $id;

		if (empty($id))
		{
			$id = $this->session->userdata('idCategoria');
		}
		else
		{
			$this->session->set_userdata($data);
		}
		
		$check = FALSE;

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

		// Configurando paginação //
        $config["base_url"] 	= base_url() . "index.php/modelo/listModeloByCategoria";
        $config["total_rows"] 	= $this->modelo_model->countModeloByCategoria($id);
        $config["per_page"] 	= 20;
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        
        // Lista todos os modelos //
        $data["modelos"] = $this->modelo_model->listarModeloByCategoria($config['per_page'], $page, $id);
        
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

		// Recebe os dados do FORM //			
		$search	= $this->input->post('buscaModelo');		

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modelo_view';

		if (empty($search))
		{
	        $config["base_url"] 	= base_url() . "index.php/modelo/listAll";
	        $config["total_rows"] 	= $this->modelo_model->countModelo();
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data["modelos"] = $this->modelo_model->listarModelo($config["per_page"], $page);
	        $data["links"] = $this->pagination->create_links();
		}
		else
		{
			$data["modelos"] = $this->modelo_model->listarModeloPesquisa($search);
		}

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
		$data['marcas'] = $this->marca_model->listarAllMarca();

		// Lista todos os modelos //
		$data['modelos'] = $this->modelo_model->bucaModelo($id);			

		// // Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * Apresenta a view para adicionar modelos
	 */
	public function addModelo()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'modelo/modeloAdd_view';

		// // Busca as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// // Busca as marcas //
		$data['marcas'] = $this->marca_model->listarAllMarca();

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * setar novo modelo no banco
	 */
	public function setModelo()
	{
		// Recebe os dados do FORM //			
		$data['MNome']		= $this->input->post('nomeModelo');
		$data['MNome1']		= $this->input->post('nomeModelo1');
		$data['MNome2']		= $this->input->post('nomeModelo2');
		$data['MNome3']		= $this->input->post('nomeModelo3');
		$data['MNome4']		= $this->input->post('nomeModelo4');		
		$data['Marca_MAID']	= $this->input->post('marca');		

		// Chama o model responsável pela inserção no banco //
		$this->modelo_model->cadastrar($data);

		// Redereciona a página //
		redirect('modelo/listAll');

	}




}


