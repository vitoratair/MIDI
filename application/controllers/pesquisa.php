<?php 

class Pesquisa extends CI_Controller {


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
	 * Apresenta a view para ediid, $ncm, $anor a ncm
	 */
	public function edit($id, $ncm, $year)
	{
		// Monta o noma da tabela para pesquisa //
		$table = $ncm . "_" . $year;

		// Busca as informações para os modais //
		$data['categorias'] = $this->categoria_model->listar();
		$data['marcas'] 	= $this->marca_model->listarAllMarca();						
		
		// verifica os dados atuais da NCM //
		$marca 		= $this->ncm_model->buscarMarca($table, $id);
		$categoria 	= $this->categoria_model->getCategoriaNcm($table, $id);
		$modelo 	= $this->ncm_model->buscarModelo($table, $id);
		
		
		// Verifica se existe marca //
		if (!empty($marca))
		{
			$data['modelos'] 	= $this->modelo_model->buscaModeloByMarca($marca[0]->Marca);	
		}

		// Verficar se existe subcategoria //
		if (!empty($categoria))
		{
			$data['titulos']	= $this->categoria_model->listarTitulos($categoria[0]->Categoria);			
		}

		$var 	= array();

		// Loop para verficar as subcategorias do modelo //
		foreach ($data['titulos'] as $key => $value)
		{
			$data['titulos'][$key]->SubCategoriaID 	= $this->categoria_model->listarSubcategoriasModelo($modelo[0]->Modelo, $value->TColuna);
			$data['titulos'][$key]->SubCategoria 	= $this->categoria_model->getItensByID($value->TColuna, $data['titulos'][$key]->SubCategoriaID);
		}
		

		$data['dados']	 	= $this->ncm_model->listarNcm($table, $id);
		
		// Envia os dados para a view //
		$data['ncm'] 	= $ncm; 
		$data['year'] 	= $year;
		$data['main_content'] = 'pesquisa/editPesquisa_view';	
		$this->parser->parse('template',$data);		
	}

	/**
	 * Apresenta a view para ediid, $ncm, $anor a ncm
	 */
	public function update($id)
	{		
		$ncm 	= $this->input->post('ncm');
		$year 	= $this->input->post('year');		
		$idn 	= $this->input->post('idn');

		$table 	=  $ncm . "_" . $year;

		switch ($id)
		{
			case 'Categoria':
				$categoria = $this->input->post('categoria');
				$this->ncm_model->update(1, $table, $id, $idn, $categoria);

				break;

			case 'Marca':
				$marca = $this->input->post('marca');
				$this->ncm_model->update(2, $table, $id, $idn, $marca);

				break;	

			case 'Modelo':
				$modelo = $this->input->post('modelo');
				$this->ncm_model->update(1, $table, $id, $idn, $modelo);				

				break;							
			
			default:
				# code...
				break;
		}	

		redirect("pesquisa/edit/$idn/$ncm/$year");
	}	

	/**
	 * Apresenta a view com todos as opções para o usuário
	 */
	public function listAll()
	{
		// Verifica se existe dados de formulário //
		$ncm 			= $this->input->post('ncm');
		$year 			= $this->input->post('ano');	
		$brand 			= $this->input->post('marca');
		$model 			= $this->input->post('modelo');
		$search 		= $this->input->post('search');
		$unSearch 		= $this->input->post('unSearch');
		$control 		= $this->input->post('controle');

		// Carrega os dados necessários da model //
		$data['ncms'] 	= $this->ncm_model->listar();
		$data['anos'] 	= $this->ncm_model->listarAno();					
		$data['marcas'] = $this->marca_model->listarAllMarca();	

		// Caso a variável ncm esteja vazia, recebe os dados que estão em sessão //
		if (empty($ncm))
		{
			if (!empty($this->session->userdata['ncm']))
			{
				$ncm 	= $this->session->userdata['ncm'];	
				$year 	= $this->session->userdata['year'];			
			}	
		}
		else
		{
			$session['ncm'] = $ncm;
			$session['year'] = $year;
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
		if (strlen($table) == 13)
		{
			
	        // Configurando a url base para paginação //
	        $config["base_url"] 	= base_url() . "index.php/pesquisa/listAll";
			
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
			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'5',NULL, NULL, $search, $unSearch);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '5', NULL, NULL, $search, $unSearch);
					$data["links"] 	= $this->pagination->create_links();
				}
				// Pesquisando por uma palavra chave
				else
				{
					// Configurando paginação //
			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'4',NULL, NULL, $search, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '4', NULL, NULL, $search, NULL);
					$data["links"] 	= $this->pagination->create_links();
				}
			}
			// Retirando uma palavra chave
			elseif (!empty($unSearch))
			{
				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'6',NULL, NULL, NULL, $unSearch);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '6', NULL, NULL, NULL, $unSearch);
				$data["links"] 	= $this->pagination->create_links();								

			}
			// Pesquisando por marca
			elseif (empty($brand))
			{
				
				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'1',NULL, NULL, NULL, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '1', NULL, NULL, NULL, NULL);
				$data["links"] 	= $this->pagination->create_links();				

			}
			else
			{				
				if (empty($model))
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] = $this->modelo_model->buscaModeloByMarca($brand);			

			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'2', $brand, NULL, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '2', $brand, NULL, NULL, NULL);
					$data["links"] = $this->pagination->create_links();									
				}
				else
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] = $this->modelo_model->buscaModeloByMarca($brand);			

			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'3', $brand, $model, NULL, NULL);			        			      
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '3', $brand, $model, NULL, NULL);
					$data["links"] = $this->pagination->create_links();	
				}
			}
		}

		// Carrega a view correspondende //
		$data['main_content'] = 'pesquisa/pesquisa_view';

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}
}

?>