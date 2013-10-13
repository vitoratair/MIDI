<?php 

class ncm extends CI_Controller
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

	// Apresenta a view com todos as NCMs cadastrados no sistema //
	public function listAll()
	{
		// Lista todos os projetos //
		$data['ncm'] = $this->ncm_model->listNcm();
	
		$data['main_content'] = 'ncm/ncm_view';
		$this->parser->parse('template', $data);
	}
	
	// Recupera as informações de ncm e aprenseta na view para o usuaário //
	public function editNCM($id)
	{
		$data['main_content'] 	= 'ncm/editNcm_view';	
		$data['ncmNome'] 		= $this->ncm_model->getNcm($id);		

		$this->parser->parse('template',$data);	
	}	

	// Atualiza a NCM //
	public function updateNcm()
	{
		$data['NID'] 		= $this->input->post('ID');
		$data['NNome'] 		= $this->input->post('ncmNome');
		$data['NDescricao'] = $this->input->post('ncmDescricao');
		$this->ncm_model->updateNcm($data);

		redirect('ncm/listAll');
	}

	// Adiciona nova NCM no banco //
	public function setNcm()
	{
		// Recebe os dados do FORM //			
		$data['NID'] 		= $this->input->post('ID');
		$data['NNome'] 		= $this->input->post('ncmNome');
		$data['NDescricao'] = $this->input->post('ncmDescricao');
		$this->ncm_model->save($data);

		redirect('ncm/listAll');
	}

	// Deleta a NCM e suas referências em outras tabelas //
	public function deleteNcm($id)
	{
		// Deleta a referência da NCM na tabela NCM-has-Categoria // 
		$this->ncm_model->updateNCMForDelete($id);

		redirect('ncm/listAll');
	}	

	// Edição de item importado //
	public function edit($idn, $ncm, $year)
	{
		// Variável para cotrolar se os modelos vieram da NCM ou da requisição //
		$control 	= FALSE;
		$userType 	= $this->session->userdata('usuarioTipo');
		$table 		= $ncm . "_" . $year;
		$user 		= $this->input->post('userID');		

		if ($userType == 1)
		{
			
			// verifica os dados atuais da NCM //
			$categoria 	= $this->ncm_model->getCategoryByNcm($table, $idn);
			$marca 		= $this->ncm_model->getBrandByNcm($table, $idn);	
			$modelo 	= $this->ncm_model->getModelByNcm($table, $idn);			

			// Busca as informações para os modais //
			$data['categorias'] 		= $this->category_model->listCategory();
			$data['marcas'] 			= $this->brand_model->listAllBrand();
			$data['subcategoria1']		= $this->category_model->listElement('SubCategoria1', $categoria[0]->Categoria);
			$data['subcategoria2']		= $this->category_model->listElement('SubCategoria2', $categoria[0]->Categoria);
			$data['subcategoria3']		= $this->category_model->listElement('SubCategoria3', $categoria[0]->Categoria);
			$data['subcategoria4']		= $this->category_model->listElement('SubCategoria4', $categoria[0]->Categoria);
			$data['subcategoria5']		= $this->category_model->listElement('SubCategoria5', $categoria[0]->Categoria);
			$data['subcategoria6']		= $this->category_model->listElement('SubCategoria6', $categoria[0]->Categoria);
			$data['subcategoria7']		= $this->category_model->listElement('SubCategoria7', $categoria[0]->Categoria);
			$data['subcategoria8']		= $this->category_model->listElement('SubCategoria8', $categoria[0]->Categoria);

			// Verifica se existe marca //
			if (!empty($marca))
			{			
				$data['modelos'] 	= $this->model_model->getModelByBrand($marca[0]->Marca, $categoria[0]->Categoria);				
			}

			if (!empty($categoria))
			{
				$data['titulos']	= $this->category_model->listTitle($categoria[0]->Categoria);			
			}

			if (!empty($modelo))
			{
				if ($modelo[0]->Modelo != 1)
				{
					$data['checkModelo'] = TRUE;
					// Loop para verficar as subcategorias do modelo //
					foreach ($data['titulos'] as $key => $value)
					{
						$data['titulos'][$key]->SubCategoriaID 	= $this->model_model->listSubcategoryModel($modelo[0]->Modelo, $value->TColuna);
						$data['titulos'][$key]->SubCategoria 	= $this->ncm_model->getElementByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
					}			
				}
				else
				{			

					$data['checkModelo'] = FALSE;
					
					// Loop para verficar as subcategorias do modelo //
					foreach ($data['titulos'] as $key => $value)
					{
						$data['titulos'][$key]->SubCategoriaID 	= $this->ncm_model->listarSubcategoriasNcm($table, $value->TColuna, $idn);
						$data['titulos'][$key]->SubCategoria 	= $this->ncm_model->getElementByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
					}	
				}				
			}

			$data['dados']	 	= $this->ncm_model->listDataNcm($table, $idn);
			$data['dados'] 		= $this->others->formatarDados(8, $data['dados']);
			
			// // Envia os dados para a view //
			$data['ncm'] 	= $ncm; 
			$data['year'] 	= $year;

			$data['main_content'] = 'search/editNcm_view';
			$this->parser->parse('template',$data);
		}	
		elseif($userType == 2)
		{

			// Busca as informações para os modais //
			$data['categorias'] 	= $this->category_model->listCategory();
			$data['marcas'] 		= $this->brand_model->listAllBrand();

			// Verfica se já existe dados de requisições para esse ID //
			$check = $this->request_model->checkRequest($ncm, $year, $idn);

			if (empty($check))
			{
				// verifica os dados atuais da NCM //
				$categoria 	= $this->ncm_model->getCategoryByNcm($table, $idn);				
				$marca 		= $this->ncm_model->getBrandByNcm($table, $idn);						
				$modelo 	= $this->ncm_model->getModelByNcm($table, $idn);	


				// Verifica se existe marca //
				if (empty($marca))
				{			
					$data['modelos'] = '';
				}
				else
				{
					$data['modelos'] 	= $this->model_model->getModelByBrand($marca[0]->Marca, $categoria[0]->Categoria);
				}			

				$data['dados']	 	= $this->ncm_model->listDataNcm($table, $idn);
				$data['dados'] 		= $this->others->formatarDados(8, $data['dados']);
				
				// Envia os dados para a view //
				$data['categoriaNome'] 	= NULL;
				$data['marcaNome'] 		= NULL;
				$data['modeloNome']	 	= NULL;
						
			}
			else
			{

				if (empty($check[0]->RequestCategoria))
				{					
					$categoria 	= $this->ncm_model->getCategoryByNcm($table, $idn);
					$data['categoriaNome'] 	= NULL;				
				}
				else
				{
					$data['categoriaNome'] 	= $this->category_model->getCategory($check[0]->RequestCategoria);
					$data['categoriaNome'] 	= $data['categoriaNome'][0]->CNome;	
				}


				if (empty($check[0]->RequestMarca))
				{					
					$marca 				= $this->ncm_model->getBrandByNcm($table, $idn);
					$data['modelos'] 	= $this->model_model->getModelByBrand($marca[0]->Marca, $check[0]->RequestCategoria);
					$data['marcaNome'] 	= NULL;													
				}
				else
				{										
					$data['modelos'] 		= $this->model_model->getModelByBrand($check[0]->RequestMarca, $check[0]->RequestCategoria);
					$data['marcaNome'] 		= $this->brand_model->getBrand($check[0]->RequestMarca);
					$data['marcaNome'] 		= $data['marcaNome'][0]->MANome;
				}

				if (empty($check[0]->RequestModelo))
				{					
					$modelo 				= $this->ncm_model->getModelByNcm($table, $idn);
					$data['modeloNome'] 	= NULL;														
				}
				else
				{
					$data['modeloNome'] 	= $this->model_model->getModel($check[0]->RequestModelo);
				
					if (empty($data['modeloNome']))
					{
						$data['modeloNome'] 	= NULL;							
					}
					else
					{
						$data['modeloNome'] 	= $data['modeloNome'][0]->MNome;							
					}

				}

			}
			
			$data['dados']	 	= $this->ncm_model->listDataNcm($table, $idn);
			$data['dados'] 		= $this->others->formatarDados(1, $data['dados']);					

			$data['ncm'] 	= $ncm; 
			$data['year'] 	= $year;
			
			$data['main_content'] = 'search/editNcmUser_view';
			$this->parser->parse('template',$data);
		}
	}

	// Apresenta a view para ediid, $ncm, $anor a ncm //
	public function update($id)
	{		
		$user 	= $this->input->post('userID');
		$ncm 	= $this->input->post('ncm');
		$year 	= $this->input->post('year');		
		$idn 	= $this->input->post('idn');
		$coluna = $this->input->post('coluna');

		$coluna = "SubCategoria".$coluna."_SCID";
		$table 	=  $ncm . "_" . $year;

		switch ($id)
		{
			case 'Categoria':
				$categoria = $this->input->post('categoria');
				if (!empty($categoria))
				{
					$this->ncm_model->update(1, $table, $id, $idn, $categoria);	
				}				
				break;

			case 'CategoriaAll':
				$categoria 	= $this->input->post('categoria');
				$ids 		= $this->input->post('ids');

				if (!empty($categoria))
				{
					$this->ncm_model->update(4, $table, $id, $ids, $categoria);	
				}	

				redirect("search/ncm/");			
				
				break;

			case 'Marca':
				$marca = $this->input->post('marca');
				if (!empty($marca))
				{
					$this->ncm_model->update(2, $table, $id, $idn, $marca);
				}
				break;

			case 'MarcaAll':
				$marca = $this->input->post('marca');
				$ids 		= $this->input->post('ids');

				if (!empty($marca))
				{
					$this->ncm_model->update(5, $table, $id, $ids, $marca);
				}
				redirect("search/ncm/");
				break;

			case 'Modelo':
				$modelo = $this->input->post('modelo');
				if (!empty($modelo))
				{
					$this->ncm_model->update(1, $table, $id, $idn, $modelo);					
				}				
				break;							
			
			case 'SubCategoria':
				$subcategoria = $this->input->post('subcategoria');
				if (!empty($subcategoria))
				{
					$this->ncm_model->update(3, $table, $coluna, $idn, $subcategoria);					
				}			
				break;	

			case 'CategoriaRequisicao':
				$categoria = $this->input->post('categoria');				
				
				$check = $this->request_model->checkRequest($ncm, $year, $idn);				
				
				if (!empty($check))
				{
					if (!empty($categoria))
					{						 
						 $this->request_model->updateItem(1, $check[0]->RequestID, $ncm, $year, $idn, $categoria);					
					}
				} 
				else
				{					
					if (!empty($categoria))
					{
						 $this->request_model->addRequest(1, $user, $ncm, $year, $idn, $categoria);					
					}
				}
				break;	

			case 'MarcaRequisicao':
				$marca = $this->input->post('marca');				
				$check = $this->request_model->checkRequest($ncm, $year, $idn);				
				
				if (empty($check))
				{
					if (!empty($marca))
					{
						 $this->request_model->addRequest(2, $user, $ncm, $year, $idn, $marca);					
					}
				}
				else
				{
					if (!empty($marca))
					{
						 $this->request_model->updateItem(2, $check[0]->RequestID, $ncm, $year, $idn, $marca);					
					}
				}
				break;

			case 'ModeloRequisicao':
				$modelo = $this->input->post('modelo');				
				$check = $this->request_model->checkRequest($ncm, $year, $idn);				

				if ($check)
				{
					if (!empty($modelo))
					{
						 $this->request_model->updateItem(3, $check[0]->RequestID, $ncm, $year, $idn, $modelo);					
					}
				}
				else
				{
					if (!empty($modelo))
					{
						 $this->request_model->addRequest(3, $user, $ncm, $year, $idn, $modelo);
					}
				}
				break;									

			default:
				# code...
				break;
		}	

		redirect("ncm/edit/$idn/$ncm/$year/$idn");
	}	

	// Limpa uma determinada NCM, colocando 1 em todos os campos dinâmicos //
	public function ncmEmpty()
	{
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');
		$mes = $this->input->post('mes');
		$table = $ncm . "_" . $ano;
		$this->ncm_model->ncmEmpty($table, $mes);

		redirect('administration/processing', 'refresh');
	}

	// Processa os dados de uma NCM //
	public function process()
	{
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');
		$mes = $this->input->post('mes');
		$table = $ncm . "_" . $ano;

		// Busca todos os modelos cadastrados no sistema //
		$modelos = $this->model_model->listAllModel();		

		// Percorre o array de modelos buscando referência em cada linha de importação //
		foreach ($modelos as $key => $value)
		{	
			$dados = array(
				'Modelo' 	=> $value->MOID,
				'Categoria' => $value->Categoria_CID,
				'Marca' 	=> $value->Marca_MAID
			);
			$this->ncm_model->modelProcess($table, $dados, $mes, $value->MNome, $value->MNome1, $value->MNome2, $value->MNome3, $value->MNome4);
		}

		// Busca todos as marcas cadastrados no sistema //
		$marcas = $this->brand_model->listAllBrand();

		foreach ($marcas as $key => $value)
		{
			$dados = array(
				'Marca' 	=> $value->MAID
			);
			$this->ncm_model->brandProcess($table, $mes, $value->MANome, $value->MANome1, $value->MANome2, $dados);
		}

		redirect('administration/processing');

	}

}

?>