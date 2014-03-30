<?php 

class Search extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->logged();
	}

	// Verifica se o usuario está logado //
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Apresenta a view com todos as opções para o usuário //
	public function ncm()
	{
		// Retorna o tio de usuário//
		$userType 		= $this->session->userdata('usuarioTipo');

		// Verifica se existe dados de formulário //
		$ncm 			= $this->input->post('ncm');
		$year 			= $this->input->post('ano');	
		$month 			= $this->input->post('mes');
		$brand 			= $this->input->post('marca');
		$model 			= $this->input->post('modelo');
		$search 		= $this->input->post('search');
		$unSearch 		= $this->input->post('unSearch');
		$categoria 		= $this->input->post('categoria');
		$control 		= $this->input->post('controle');
				
		// Carrega os dados necessários da model //
		$data['ncms'] 			= $this->ncm_model->listNcm();
		$data['anos'] 			= $this->ncm_model->listYear();					
		$data['categorias1'] 	= $this->category_model->listCategory();
		$data['categorias2'] 	= $data['categorias1']; 
		$data['marcas1'] 		= $this->brand_model->listAllBrand();
		$data['marcas2'] 		= $data['marcas1']; // Rever essa linha 


		if (empty($control))
		{
			if (!empty($this->session->userdata['control']))
			{
				$control = $this->session->userdata['control'];	
			}				
		}
		else
		{
			$session['control'] 	= $control;
			$this->session->set_userdata($session);
		}
		
		// Caso a variável ncm esteja vazia, recebe os dados que estão em sessão //
		if (empty($ncm))
		{
			if (!empty($this->session->userdata['ncm']))
			{
				$ncm 	= $this->session->userdata['ncm'];	
				$year 	= $this->session->userdata['ano'];
				$month 	= $this->session->userdata['mes'];
			}	
		}
		else
		{
			$session['ncm'] 	= $ncm;
			$session['ano'] 	= $year;
			$session['mes'] 	= $month;
			$session['control'] = $control;			
			$this->session->set_userdata($session);
		}

		if ($control == CATEGORY)
		{			
			if (empty($categoria))
			{
				if (!empty($this->session->userdata['categoria']))
				{
					$categoria = $this->session->userdata['categoria'];				
				}				
			}
			else
			{
				$session['categoria'] 	= $categoria;
				$session['control'] 	= $control;
				$this->session->set_userdata($session);
			}	
		}

		elseif ($control == BRAND) 
		{			
			if (!empty($this->session->userdata['categoria']))
			{
				$categoria = $this->session->userdata['categoria'];				
			}

			if (empty($brand))
			{
				if (!empty($this->session->userdata['brand']))
				{					
					$brand 		= $this->session->userdata['brand'];
				}				
			}
			else
			{
				$session['brand'] 		= $brand;
				$session['categoria'] 	= $categoria;
				$session['control'] 	= $control;
				$this->session->set_userdata($session);	
			}
		}	

		elseif ($control == MODEL)
		{
			if (!empty($this->session->userdata['categoria']))
			{
				$categoria = $this->session->userdata['categoria'];				
			}

			if (empty($model))
			{
				if (!empty($this->session->userdata['model']))
				{
					$model 		= $this->session->userdata['model'];
				}				
			}
			else
			{
				$session['model'] 		= $model;
				$session['categoria'] 	= $categoria;
				$session['control'] 	= $control;			
				$this->session->set_userdata($session);					
			}
			if (empty($brand))
			{
				if (!empty($this->session->userdata['brand']))
				{
					$brand 		= $this->session->userdata['brand'];
				}				
			}
			else
			{
				$session['brand'] 		= $brand;
				$session['categoria'] 	= $categoria;
				$session['control'] 	= $control;
				$this->session->set_userdata($session);	
			}			
		}
		elseif ($control == SEARCH)
		{
			if (!empty($search) AND (empty($unSearch)))
			{				
				$session['search'] 		= $search;
				$session['control'] 	= SEARCH_SEARCH;
				$this->session->set_userdata($session);
			}			
			elseif (!empty($unSearch) AND (empty($search)))
			{
				$session['unSearch'] 	= $unSearch;
				$session['control'] 	= SEARCH_UNSEARCH;
				$this->session->set_userdata($session);
			}
			elseif (!empty($search) AND (!empty($unSearch)))
			{
				$session['unSearch'] 	= $unSearch;
				$session['search'] 		= $search;
				$session['control'] 	= SEARCH_SEARCH_UNSEARCH;
				$this->session->set_userdata($session);
			}			
		}
		elseif ($control == SEARCH_SEARCH)
		{
			$search 				= $this->session->userdata['search'];
			$session['control'] 	= SEARCH_SEARCH;
			$this->session->set_userdata($session);
		}
		elseif ($control == SEARCH_UNSEARCH)
		{
			$unSearch 				= $this->session->userdata['unSearch'];
			$session['control'] 	= SEARCH_UNSEARCH;			
			$this->session->set_userdata($session);
		}
		elseif ($control == SEARCH_SEARCH_UNSEARCH)
		{
			$unSearch 				= $this->session->userdata['unSearch'];
			$search 				= $this->session->userdata['search'];
			$session['control'] 	= SEARCH_SEARCH_UNSEARCH;			
			$this->session->set_userdata($session);			
		}

		// Montando a nome da tabela a ser procurada //
		$table 	= $ncm . "_" . $year;
		
		// Verfica se a tabela possui 13 caracteres, um valor menor que 13 significa que a tabela não possui ou a ncm ou o ano //
		if ($this->ncm_model->checkNcm($table))
		{
	        // Configurando a url base para paginação //
	        $config["base_url"] 	= base_url() . "index.php/search/ncm";
			
			// Carrega o array com a ncm e o ano para a view //
			$data['ncm'] 	= $ncm;
			$data['year'] 	= $year;
			$data['month'] 	= $month;

			// Pesquisando por uma palavra chave
			if (!empty($search) AND (($control == SEARCH) OR ($control == SEARCH_SEARCH) OR ($control == SEARCH_SEARCH_UNSEARCH)))
			{
				// Pesquisando por uma palavra chave e retirando uma palavra chave
				if (!empty($unSearch))
				{
					// echo "<br>SEARCH E UNSEARCH<br>";
			        $config["total_rows"] 	= $this->ncm_model->countData($table, $month, '5', NULL, NULL, $search, $unSearch, NULL, NULL);		       
			        $config["per_page"] 	= 20;

			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, $month, '5', NULL, NULL, $search, $unSearch, NULL, NULL);
					$data["links"] 	= $this->pagination->create_links();
				}
				// Pesquisando por uma palavra chave
				else
				{
					// echo "<br>SEARCH<br>";
			        $config["total_rows"] 	= $this->ncm_model->countData($table,$month, '4', NULL, NULL, $search, NULL, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, $month, '4', NULL, NULL, $search, NULL, NULL, NULL);
					$data["links"] 	= $this->pagination->create_links();
				}
			}			
			elseif (!empty($unSearch) AND (($control == SEARCH) OR ($control == SEARCH_UNSEARCH)))		// Retirando uma palavra chave
			{
				// echo "<br>UNSEARCH<br>";
		        $config["total_rows"] 	= $this->ncm_model->countData($table,$month, '6', NULL, NULL, NULL, $unSearch, NULL, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, $month, '6', NULL, NULL, NULL, $unSearch, NULL, NULL);
				$data["links"] 	= $this->pagination->create_links();								

			}			
			elseif ($control == WITHOUT_FILTER)
			{
				// echo "<br>SEM FILTROS<br>";
		        $config["total_rows"] 	= $this->ncm_model->countData($table, $month, '1', NULL, NULL, NULL, NULL, NULL, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, $month, '1', NULL, NULL, NULL, NULL, NULL, NULL);
				$data["links"] 	= $this->pagination->create_links();
			}
			elseif ($control == CATEGORY)
			{
		        // echo "<br>CATEGORIA<br>";
		        $config["total_rows"] 	= $this->ncm_model->countData($table, $month, '8', NULL, NULL, NULL, NULL, NULL, $categoria);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, $month, '8', NULL, NULL, NULL, NULL, NULL, $categoria);
				$data["links"] = $this->pagination->create_links();									
			}			
			elseif ($control == BRAND)
			{				
				// echo "<br>MARCA<br>";
				if ($categoria != 1)
					$data['modelos'] 		= $this->model_model->getModelByBrand($brand, $categoria);
				else
					$data['modelos'] 		= $this->model_model->getModelByBrand($brand, NULL);			

		        $config["total_rows"] 	= $this->ncm_model->countData($table, $month, '2', $brand, NULL, NULL, NULL, NULL, $categoria);
		        $config["per_page"] 	= 20;

		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, $month, '2', $brand, NULL, NULL, NULL, NULL, $categoria);
				$data["links"] = $this->pagination->create_links();	

			}
			elseif ($control == MODEL) // Pesquisando por modelo
			{
				// echo "<br>MODELO<br>";
				if ($categoria != 1)
					$data['modelos'] 		= $this->model_model->getModelByBrand($brand, $categoria);
				else
					$data['modelos'] 		= $this->model_model->getModelByBrand($brand, NULL);

		        $config["total_rows"] 	= $this->ncm_model->countData($table, $month, '3', $brand, $model, NULL, NULL, NULL, $categoria);

		        if ($config["total_rows"] > 0)
		        {				        
			        $config["per_page"] 	= 20;
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, $month, '3', $brand, $model, NULL, NULL, NULL, $categoria);
					$data["links"] = $this->pagination->create_links();				       		
		       	}
			}

			if (!empty($data['dados']))
			{
				$data['dados'] 			= $this->others->formatarDados(1, $data['dados']);		
				$data['ids'] 			= $this->getIdsSearch($data['dados']);
				
				// verifica se todas as marcas são iguais
				$equalBrand 	= $this->checkEqualBrand($data['dados']);
				$equalCategory 	= $this->checkEqualCategory($data['dados']);

				if(($equalCategory != NULL) AND ($equalBrand != NULL))
				{
					$data['modelos1'] = $this->model_model->getModelByBrand($equalBrand, $equalCategory);
				}				
			}

			if (isset($config["total_rows"]))
			{				
				if (($config["total_rows"]) > 0)
				{
					// Verificar se o usuário é administrador //
					if ($userType == 1)
						$data['main_content'] 	= 'search/ncm_view';					
					elseif ($userType == 2)
						$data['main_content'] 	= 'search/ncmUser_view';	
				}
				else
				{
					$data['main_content'] = 'search/ncmFilterEmpty_view';					
				}				
			}
			else
			{
				$data['main_content'] 	= 'search/ncmFilterEmpty_view';
			}
		}
		else
		{
			// Exibe uma view vazia //
			$data['main_content'] = 'search/ncmEmpty_view';
		}

    	$this->parser->parse('template', $data);	
		
	}

	// Visualizar NCM por Mês, para debug //
	public function visualizeNcmByMonth()
	{
		$ncm 	= $this->input->post('ncm');
		$ano 	= $this->input->post('ano');
		$mes 	= $this->input->post('mes');	

		// Caso a variável ncm esteja vazia, recebe os dados que estão em sessão //
		if (empty($ncm))
		{
			if (!empty($this->session->userdata['ncm']))
			{
				$ncm 	= $this->session->userdata['ncm'];	
				$ano 	= $this->session->userdata['ano'];
				$mes 	= $this->session->userdata['mes'];			
			}	
		}
		else
		{
			$session['ncm'] 	= $ncm;
			$session['ano'] 	= $ano;
			$session['mes'] 	= $mes;
			$this->session->set_userdata($session);
		}

		$table 			= $ncm . "_" . $ano;
		$data['ncm'] 	= $ncm;
		$data['ano'] 	= $ano;
		$data['mes'] 	= $this->others->buscaMes($mes);

		$config["base_url"] 	= base_url() . "index.php/search/visualizeNcmByMonth";
        $config["total_rows"] 	= $this->ncm_model->countData($table, NULL, '7', NULL, NULL, NULL, NULL, $mes, NULL);
        $config["per_page"] 	= 20;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Carrega os dados somente com ano e ncm //
		$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, NULL, '7', NULL, NULL, NULL, NULL, $mes, NULL);		
		$data['dados'] = $this->others->formatarDados(1, $data['dados']);
		$data["links"] = $this->pagination->create_links();			

		$data['main_content'] = 'search/ncmMonth_view.php';
		$this->parser->parse('template', $data);


	}

	// retorna todos os IDs da pesquisa realizada para botão alterar todos //
	function getIdsSearch($data)
	{
		$ids = NULL;
		foreach ($data as $key => $value)
		{
			$ids = $ids . ", " . $value->IDN;
		}
		$ids = substr($ids, 2);

		return $ids;
	}

	// Verifica se todas as marcas são iguais //
	function checkEqualBrand($data)
	{
		$aux = FALSE;

		foreach ($data as $key => $value)
		{
			if ($data[0]->Marca != $value->Marca)
				$aux = TRUE;		
		}

		if ($aux)
			return NULL;
		else
			return $data[0]->Marca;

	}

	// Verifica se todas as marcas são iguais //
	function checkEqualCategory($data)
	{
		$aux = FALSE;

		foreach ($data as $key => $value)
		{
			if ($data[0]->Categoria != $value->Categoria)
				$aux = TRUE;		
		}

		if ($aux)
			return NULL;
		else
			return $data[0]->Categoria;

	}	




}

?>
