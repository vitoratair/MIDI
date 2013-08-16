<?php 

class Modelo extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();
		error_reporting(E_ALL ^ (E_NOTICE));

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
			$varTable = "Tables_in_" . DATABASE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->modelo_model->verificarCadastro($value->$varTable, $value1->MOID);
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
				$varTable = "Tables_in_" . DATABASE;
				$countModelos = $this->modelo_model->verificarCadastro($value->$varTable, $value1->MOID);
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

		// Busca informações do modelo //
		$data['marca'] 			= $this->modelo_model->bucaMarcaByModelo($id);
		$data['categoria']		= $this->categoria_model->getCategoriaModelo($id);
		$data['subcategoria1']	= $this->categoria_model->listaItens('SubCategoria1', $data['categoria'][0]->CID);
		$data['subcategoria2']	= $this->categoria_model->listaItens('SubCategoria2', $data['categoria'][0]->CID);
		$data['subcategoria3']	= $this->categoria_model->listaItens('SubCategoria3', $data['categoria'][0]->CID);		
		$data['subcategoria4']	= $this->categoria_model->listaItens('SubCategoria4', $data['categoria'][0]->CID);
		$data['subcategoria5']	= $this->categoria_model->listaItens('SubCategoria5', $data['categoria'][0]->CID);
		$data['subcategoria6']	= $this->categoria_model->listaItens('SubCategoria6', $data['categoria'][0]->CID);
		$data['subcategoria7']	= $this->categoria_model->listaItens('SubCategoria7', $data['categoria'][0]->CID);
		$data['subcategoria8']	= $this->categoria_model->listaItens('SubCategoria8', $data['categoria'][0]->CID);		

		if (!empty($data['categoria']))
		{
			$data['titulos']	= $this->categoria_model->listarTitulos($data['categoria'][0]->CID);			
		}

		// Loop para verficar as subcategorias do modelo //
		if (!empty($data['titulos']))
		{
			foreach ($data['titulos'] as $key => $value)
			{
				$data['titulos'][$key]->SubCategoriaID 	= $this->categoria_model->listarSubcategoriasModelo($id, $value->TColuna);
				$data['titulos'][$key]->SubCategoria 	= $this->categoria_model->getItensByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
			}					
		}
	

		// Lista de informações para view //
		$data['marcas'] 	= $this->marca_model->listarAllMarca();
		$data['modelos'] 	= $this->modelo_model->bucaModelo($id);
		$data['categorias'] = $this->categoria_model->listar();

		// Envia todas as informações para tela //
		$data['main_content'] = 'modelo/modeloEdit_view';
		$this->parser->parse('template', $data);

	}

	/**
	 * Atualiza a modelo
	 */
	public function updateModelo()
	{
		$id 			= $this->input->post('id');
		$data['MOID'] 	= $id;

			
		if ($this->input->post('controle') != 1)
		{
			$data['MNome'] 				= $this->input->post('nomeModelo');
			$data['MNome1'] 			= $this->input->post('nomeModelo1');
			$data['MNome2'] 			= $this->input->post('nomeModelo2');
			$data['MNome3'] 			= $this->input->post('nomeModelo3');
			$data['MNome4'] 			= $this->input->post('nomeModelo4');			
		}

		
		if ($this->input->post('subcategoria1'))
		{
			$data['SubCategoria1_SCID'] = $this->input->post('subcategoria1');
		}
		elseif ($this->input->post('subcategoria2'))
		{
			$data['SubCategoria2_SCID'] = $this->input->post('subcategoria2');
		}
		elseif ($this->input->post('subcategoria3'))
		{
			$data['SubCategoria3_SCID'] = $this->input->post('subcategoria3');
		}
		elseif ($this->input->post('subcategoria4'))
		{
			$data['SubCategoria4_SCID'] = $this->input->post('subcategoria4');
		}
		elseif ($this->input->post('subcategoria5'))
		{
			$data['SubCategoria5_SCID'] = $this->input->post('subcategoria5');
		}								
		elseif ($this->input->post('subcategoria6'))
		{
			$data['SubCategoria6_SCID'] = $this->input->post('subcategoria6');
		}						
		elseif ($this->input->post('subcategoria7'))
		{
			$data['SubCategoria7_SCID'] = $this->input->post('subcategoria7');
		}						
		elseif ($this->input->post('subcategoria8'))
		{
			$data['SubCategoria8_SCID'] = $this->input->post('subcategoria8');
		}										



		if ($this->input->post('marca') != 0)
		{
			$data['Marca_MAID'] = $this->input->post('marca');
		}
		if ($this->input->post('categoria') != 0)
		{
			$data['Categoria_CID'] 	= $this->input->post('categoria');	
		}

		$this->modelo_model->updateModelo($data);

		redirect("modelo/editModelo/$id");				
	}

	/**
	 * Apresenta a view para adicionar modelos
	 */
	public function addModelo()
	{

		// Carrega a view correspondende //
		$data['main_content'] 	= 'modelo/modeloAdd_view';

		// Recebendo ID do modelo //
		$data['modeloID']		= $this->modelo_model->getID();
		$data['modeloID']		= $data['modeloID'][0]->Auto_increment;
		
		// // Busca as informações //
		$data['categorias'] = $this->categoria_model->listar();
		$data['marcas'] 	= $this->marca_model->listarAllMarca();
		$data['categoria']	= $this->categoria_model->getCategoriaModelo($data['modeloID']);

		if (!empty($data['categoria']))
		{
			$data['titulos']	= $this->categoria_model->listarTitulos($data['categoria'][0]->CID);			

			// Loop para verficar as subcategorias do modelo //
			foreach ($data['titulos'] as $key => $value)
			{
				$data['titulos'][$key]->SubCategoriaID 	= $this->categoria_model->listarSubcategoriasModelo($data['modeloID'], $value->TColuna);
				$data['titulos'][$key]->SubCategoria 	= $this->categoria_model->getItensByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
			}
		}

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * setar novo modelo no banco
	 */
	public function setModelo()
	{
		// Recebe os dados do FORM //			
		$id						= $this->input->post('id');
		$data['MNome']			= $this->input->post('nomeModelo');
		$data['MNome1']			= $this->input->post('nomeModelo1');
		$data['MNome2']			= $this->input->post('nomeModelo2');
		$data['MNome3']			= $this->input->post('nomeModelo3');
		$data['MNome4']			= $this->input->post('nomeModelo4');		
		$data['Marca_MAID']		= $this->input->post('marca');
		$data['Categoria_CID']	= $this->input->post('categoria');		

		// Chama o model responsável pela inserção no banco //
		$this->modelo_model->cadastrar($data);

		// Redereciona a página //
		redirect("modelo/editModelo/$id");

	}

	/**
	 * Deletar um modelo
	 */
	public function deleteModelo($id)
	{
		$varTable = "Tables_in_" . DATABASE;
		// pegar todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();

		// Loop para apagar a referencia da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->modelo_model->updateNcm($value->$varTable, $id);
		}

		// Deletar o modelo //
		$this->modelo_model->delete($id);

		// Redereciona a página //
		redirect("modelo/listAll");

	}	




}


