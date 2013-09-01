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
		// Verifica se existe dados de formulário //
		$ncm 			= $this->input->post('ncm');
		$year 			= $this->input->post('ano');	
		$brand 			= $this->input->post('marca');
		$model 			= $this->input->post('modelo');
		$search 			= $this->input->post('search');
		$unSearch 		= $this->input->post('unSearch');
		$control 		= $this->input->post('controle');

		// Carrega os dados necessários da model //
		$data['ncms'] 	= $this->ncm_model->listNcm();
		$data['anos'] 	= $this->ncm_model->listYear();					
		$data['marcas'] = $this->brand_model->listAllBrand();	

		// Caso a variável ncm esteja vazia, recebe os dados que estão em sessão //
		if (empty($ncm))
		{
			if (!empty($this->session->userdata['ncm']))
			{
				$ncm 	= $this->session->userdata['ncm'];	
				$year 	= $this->session->userdata['ano'];			
			}	
		}
		else
		{
			$session['ncm'] 	= $ncm;
			$session['ano'] 	= $year;
			$this->session->set_userdata($session);
		}

		if (empty($brand) && (empty($control)))
		{
			if (!empty($this->session->userdata['brand']))
			{
				$brand = $this->session->userdata['brand'];
			}
		}
		else
		{
			$session['brand'] = $brand;
			$this->session->set_userdata($session);	
		}		
		if (empty($model) && (empty($control)))
		{
			if (!empty($this->session->userdata['model']))
			{
				$model = $this->session->userdata['model'];
			}
		}
		else
		{
			$session['model'] = $model;
			$this->session->set_userdata($session);	
		}
		if (empty($search) && (empty($control)) && (empty($unSearch)))
		{
			if (!empty($this->session->userdata['search']))
			{
				$search = $this->session->userdata['search'];
			}	
		}
		else
		{
			$session['search'] = $search;
			$this->session->set_userdata($session);	
		}

		if (empty($unSearch) && (empty($control)))
		{
			
			if (empty($search))
			{
				if (!empty($this->session->userdata['unSearch']))
				{
					$unSearch = $this->session->userdata['unSearch'];
				}
			}
			else
			{
				if (!empty($this->session->userdata['unSearch']))
				{
					$unSearch = $this->session->userdata['unSearch'];
					$search = $this->session->userdata['search'];
				}
			}
		}
		else
		{
			$session['unSearch'] = $unSearch;
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

			// Pesquisando por uma palavra chave
			if (!empty($search))
			{
				// Pesquisando por uma palavra chave e retirando uma palavra chave
				if (!empty($unSearch))
				{
					// Configurando paginação //
			        $config["total_rows"] 	= $this->ncm_model->countData($table, '5', NULL, NULL, $search, $unSearch, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, '5', NULL, NULL, $search, $unSearch, NULL);
					$data["links"] 	= $this->pagination->create_links();
				}
				// Pesquisando por uma palavra chave
				else
				{
					// Configurando paginação //
			        $config["total_rows"] 	= $this->ncm_model->countData($table, '4', NULL, NULL, $search, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, '4', NULL, NULL, $search, NULL, NULL);
					$data["links"] 	= $this->pagination->create_links();
				}
			}
			// Retirando uma palavra chave
			elseif (!empty($unSearch))
			{
				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countData($table, '6', NULL, NULL, NULL, $unSearch, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, '6', NULL, NULL, NULL, $unSearch, NULL);
				$data["links"] 	= $this->pagination->create_links();								

			}

			// Pesquisando por marca
			elseif (empty($brand))
			{
				
				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countData($table, '1', NULL, NULL, NULL, NULL, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->getData($config['per_page'], $page, $table, '1', NULL, NULL, NULL, NULL, NULL);
				$data["links"] 	= $this->pagination->create_links();				

			}
			else
			{				
				if (empty($model))
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] = $this->model_model->getModelByBrand($brand, NULL);			

			        $config["total_rows"] 	= $this->ncm_model->countData($table, '2', $brand, NULL, NULL, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, '2', $brand, NULL, NULL, NULL, NULL);
					$data["links"] = $this->pagination->create_links();									
				}
				else
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] 		= $this->model_model->getModelByBrand($brand, NULL);			
			        $config["total_rows"] 	= $this->ncm_model->countData($table, '3', $brand, $model, NULL, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, '3', $brand, $model, NULL, NULL, NULL);
					$data["links"] = $this->pagination->create_links();	
				}
			}
			$data['dados'] = $this->others->formatarDados(1, $data['dados']);		
			$data['main_content'] = 'search/ncm_view';	
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
        $config["total_rows"] 	= $this->ncm_model->countData($table, '7', NULL, NULL, NULL, NULL, $mes);			        			      
        $config["per_page"] 	= 20;

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Carrega os dados somente com ano e ncm //
		$data['dados'] = $this->ncm_model->getData($config['per_page'], $page, $table, '7', NULL, NULL, NULL, NULL, $mes);
		$data['dados'] = $this->others->formatarDados(1, $data['dados']);
		$data["links"] = $this->pagination->create_links();			

		$data['main_content'] = 'search/ncmMonth_view.php';
		$this->parser->parse('template', $data);


	}



}

?>