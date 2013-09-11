<?php 

class Model extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->logged();		
	}

	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Apresenta a view com todos os modelos cadastrados no sistema //
	public function listAll()
	{

		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;

		// Recebe os dados do FORM //			
		$search	= $this->input->post('buscaModelo');		

		// Busca as categorias //
		$data['categorias'] = $this->category_model->listCategory();
		$data['marcas'] 		= $this->brand_model->listAllBrand();		

		if (empty($search))
		{
	        $config["base_url"] 	= base_url() . "index.php/model/listAll";
	        $config["total_rows"] 	= $this->model_model->countModel();
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data["modelos"] 		= $this->model_model->listModel($config["per_page"], $page);
	        $data["links"] 			= $this->pagination->create_links();
		}
		else
		{
			$data["modelos"] = $this->model_model->listModelSearch($search);
			$data["links"] 			= NULL;
		}

		// pegar todas as tabelas de NCMs do sistema
		$ncms = $this->ncm_model->listAllNcm();
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->model_model->findModel($value->$table, $value1->MOID);
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

		$data['main_content'] = 'model/model_view';		
		$this->parser->parse('template', $data);

	}

	// Lista de modelos de uma categoria //
	public function listModel()
	{		
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;

		// Recebe os dados do form //
		$categoria 				= $this->input->post('categoria');		
		$marca 					= $this->input->post('marca');



		$session['idCategoria'] 	= $categoria;
		$session['idMarca'] 		= $marca;

		// Busca as categorias e marcas //
		$data['categorias'] 	= $this->category_model->listCategory();
		$data['marcas'] 		= $this->brand_model->listAllBrand();

		if (empty($categoria))
		{
			$categoria = $this->session->userdata('idCategoria');
		}
		else
		{
			$this->session->set_userdata($session);
		}

		if (empty($marca))
		{
			$marca = $this->session->userdata('idMarca');
		}
		else
		{
			$this->session->set_userdata($session);
		}		

		$check = FALSE;

		// Busca os modelos filtrando somente por categoria //
		if (empty($marca) OR ($marca == 1) AND (!empty($categoria)))
		{
			// Configurando paginação //
	        $config["base_url"] 	= base_url() . "index.php/model/listModel";
	        $config["total_rows"] 	= $this->model_model->countModelByCategory($categoria);
	        $config["per_page"] 	= 20;
	        
	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        // Lista todos os modelos //
	        $data["modelos"] 	= $this->model_model->listModelByCategory($config['per_page'], $page, $categoria);
	        $data["links"] 		= $this->pagination->create_links();
		}
		// Busca os modelos filtrando somente por marca //
		elseif( (empty($categoria) AND !empty($marca)) OR ($categoria == 1) AND (!empty($marca)))
		{
			// Configurando paginação //
	        $config["base_url"] 	= base_url() . "index.php/model/listModel";
	        $config["total_rows"] 	= $this->model_model->countModelByBrand($marca);
	        $config["per_page"] 	= 20;
	        
	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        // Lista todos os modelos //
	        $data["modelos"] 	= $this->model_model->listModelByBrand($config['per_page'], $page, $marca);
	        $data["links"] 		= $this->pagination->create_links();
		}
		// Busca os modelos filtrando por marca e categoria //
		elseif ( !empty($marca) AND !empty($categoria) AND $categoria != 1 AND $marca != 1 )
		{
			// Configurando paginação //
	        $config["base_url"] 	= base_url() . "index.php/model/listModel";
	        $config["total_rows"] 	= $this->model_model->countModelByBrandAndCategory($marca, $categoria);
	        $config["per_page"] 	= 20;
	        
	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	        // Lista todos os modelos //
	        $data["modelos"] 	= $this->model_model->listModelByBrandAndCategory($config['per_page'], $page, $marca, $categoria);
	        $data["links"] 		= $this->pagination->create_links();
		}

		// pegar todas as tabelas de NCMs do sistema
		$ncms = $this->ncm_model->listAllNcm();
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->model_model->findModel($value->$table, $value1->MOID);
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
		$data['marcaNome'] 		= $this->brand_model->getBrand($marca);
		$data['marcaNome'] 		= $data['marcaNome'][0]->MANome;

		$data['categoriaNome'] = $this->category_model->getCategory($categoria);
		$data['categoriaNome'] = $data['categoriaNome'][0]->CNome;

		$data['main_content'] = 'model/model_view';
		$this->parser->parse('template', $data);
	}

	// Apresenta a view para edição de modelos
	public function editModel($id)
	{		
		// Busca informações do modelo //
		
		$data['marca'] 			= $this->brand_model->getBrandByModel($id);
		$data['categoria']		= $this->category_model->getCategoryModel($id);

		$data['subcategoria1']	= $this->category_model->listElement('SubCategoria1', $data['categoria'][0]->CID);
		$data['subcategoria2']	= $this->category_model->listElement('SubCategoria2', $data['categoria'][0]->CID);
		$data['subcategoria3']	= $this->category_model->listElement('SubCategoria3', $data['categoria'][0]->CID);		
		$data['subcategoria4']	= $this->category_model->listElement('SubCategoria4', $data['categoria'][0]->CID);
		$data['subcategoria5']	= $this->category_model->listElement('SubCategoria5', $data['categoria'][0]->CID);
		$data['subcategoria6']	= $this->category_model->listElement('SubCategoria6', $data['categoria'][0]->CID);
		$data['subcategoria7']	= $this->category_model->listElement('SubCategoria7', $data['categoria'][0]->CID);
		$data['subcategoria8']	= $this->category_model->listElement('SubCategoria8', $data['categoria'][0]->CID);		

		if (!empty($data['categoria']))
		{
			$data['titulos']	= $this->category_model->listTitle($data['categoria'][0]->CID);			
		}

		// Loop para verficar as subcategorias do modelo //
		if (!empty($data['titulos']))
		{
			foreach ($data['titulos'] as $key => $value)
			{
				$data['titulos'][$key]->SubCategoriaID 	= $this->category_model->listTitleByModel($id, $value->TColuna);				
				$data['titulos'][$key]->SubCategoria 	= $this->category_model->getItensByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
			}					
		}
	
		// Lista de informações para view //
		$data['marcas'] 	= $this->brand_model->listAllBrand();
		$data['modelos'] 	= $this->model_model->getModel($id);
		$data['categorias'] = $this->category_model->listCategory();

		// Envia todas as informações para tela //
		$data['main_content'] = 'model/editModel_view';
		$this->parser->parse('template', $data);

	}

	// Atualiza um modelo //
	public function updateModel()
	{
		$id 			= $this->input->post('id');
		$data['MOID'] 	= $id;
			
		if ($this->input->post('controle') != 1)
		{
			$data['MNome0'] 			= $this->input->post('nomeModelo0');
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
		
		$this->model_model->updateModel($data);

		redirect("model/editModel/$id");				
	}

	// Deletar modelo //
	public function deleteModel($id)
	{
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;		

		// Recebe todas as NCMs cadastradas no sistema //
		$data = $this->ncm_model->listAllNcm();

		// Loop para apagar a referência da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->ncm_model->emptyModel($value->$table, $id);
		}

		// Deletar o modelo //
		$this->model_model->delete($id);

		// Redereciona a página //
		redirect("model/listAll");

	}	

	// Apresenta a view para adicionar modelo //
	public function addModel()
	{
		

		// // Recebendo ID do modelo //
		$data['modeloID']		= $this->model_model->getNextID();
		$data['modeloID']		= $data['modeloID'][0]->Auto_increment;
		
		// Busca as informações //
		$data['categorias'] = $this->category_model->listCategory();
		$data['marcas'] 	= $this->brand_model->listAllBrand();
		$data['categoria']	= $this->category_model->getCategoryModel($data['modeloID']);

		if (!empty($data['categoria']))
		{
			$data['titulos']	= $this->category_model->listTitle($data['categoria'][0]->CID);			

			// Loop para verficar as subcategorias do modelo //
			foreach ($data['titulos'] as $key => $value)
			{
				$data['titulos'][$key]->SubCategoriaID 	= $this->category_model->listTitleByModel($data['modeloID'], $value->TColuna);
				$data['titulos'][$key]->SubCategoria 	= $this->category_model->getItensByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
			}
		}

		$data['main_content'] 	= 'model/addModel_view';
		$this->parser->parse('template', $data);

	}

	// Cadastrar um nova modelos //
	public function setModel()
	{
		// Recebe os dados do FORM //			
		$id						= $this->input->post('id');
		$data['MNome0']			= $this->input->post('nomeModelo0');
		$data['MNome']			= $this->input->post('nomeModelo');
		$data['MNome1']			= $this->input->post('nomeModelo1');
		$data['MNome2']			= $this->input->post('nomeModelo2');
		$data['MNome3']			= $this->input->post('nomeModelo3');
		$data['MNome4']			= $this->input->post('nomeModelo4');		
		$data['Marca_MAID']		= $this->input->post('marca');
		$data['Categoria_CID']	= $this->input->post('categoria');		

		// Chama o model responsável pela inserção no banco //
		$this->model_model->save($data);

		// Redereciona a página //
		redirect("model/editModel/$id");

	}	

}


?>