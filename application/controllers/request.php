<?php 

class Request extends CI_Controller
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

	// Apresenta a view para lista de requisições //
	public function listAll()
	{

		$categoria = $this->input->post('categoria');

		if (empty($categoria) OR $categoria == 1)
		{
			// Configura paginação //
	        $config["base_url"] 	= base_url() . "index.php/request/listAll";
			$config["total_rows"] 	= $this->request_model->countRequest();

			if ($config["total_rows"] > 0)
			{
				$config["per_page"] 	= 20;

		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$data['dados'] 	= $this->request_model->getRequest($config["per_page"], $page);	
				$data["links"] 	= $this->pagination->create_links();

				$data['dadosRequisicao'] 	= $this->parserInData(1, $data['dados']);

				// Busca as informações da NCM //
				$data['dados'] 	= $this->parserInData(2, $data['dados']);
				$data['dados']	= $this->others->mergeTableNcm($data['dados']);

				// Juntando os arrays //
				$data['dados'] 	= $this->joinArray($data['dados'], $data['dadosRequisicao']);					

				$data['categorias'] = $this->category_model->listCategory();

				$data['main_content'] = 'request/request_view';
				$this->parser->parse('template',$data);														
			}
			else
			{
				$data['categorias'] = $this->category_model->listCategory();
				
				$data['main_content'] = 'request/requestEmpty_view';
				$this->parser->parse('template',$data);									
			}
		}
		else
		{
			
			// Configura paginação //
	        $config["base_url"] 	= base_url() . "index.php/request/listAll";
			$config["total_rows"] 	= $this->request_model->countRequestByCategory($categoria);
			$config["per_page"] 	= 20;

			if ($config['total_rows'] > 0)
			{
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				$data['dados'] 	= $this->request_model->getRequestByCategory($config["per_page"], $page, $categoria);	
				$data["links"] 	= $this->pagination->create_links();										

				$data['dadosRequisicao'] 	= $this->parserInData(1, $data['dados']);

				// Busca as informações da NCM //
				$data['dados'] 	= $this->parserInData(2, $data['dados']);
				$data['dados']	= $this->others->mergeTableNcm($data['dados']);

				// // Juntando os arrays //
				$data['dados'] 	= $this->joinArray($data['dados'], $data['dadosRequisicao']);					

				$data['categorias'] = $this->category_model->listCategory();

				$data['main_content'] = 'request/request_view';
				$this->parser->parse('template',$data);					
			}
			else
			{
				$data['categorias'] = $this->category_model->listCategory();
				
				$data['main_content'] = 'request/requestEmpty_view';
				$this->parser->parse('template',$data);					
			}

		}

	}

	// Busca as informações de NCM e monta em um único array //
	function parserInData($id, $data)
	{
		if ( $id == 1 )
		{
			foreach ($data as $key => $value)
			{
				$dados[$key]['idRe']		= $value->RequestID;	
				$dados[$key]['table'] 		= $value->RequestNcm . "_" . $value->RequestAno;
				
				if (!empty($value->RequestCategoria))
				{
					$dados[$key]['categoria'] 	= $value->RequestCategoria;	
				}
				if (!empty($value->RequestMarca))
				{
					$dados[$key]['marca'] 		= $value->RequestMarca;	
				}
				if (!empty($value->RequestModelo))
				{
					$dados[$key]['modelo'] 		= $value->RequestModelo;	
				}
				if (!empty($value->RequestUser))
				{
					$dados[$key]['user'] 		= $value->RequestUser;	
				}				
				if (!empty($value->usuarioLogin))
				{
					$dados[$key]['login'] 	= $value->usuarioLogin;	
				}												
			}		
		}
		elseif ($id == 2)
		{
			foreach ($data as $key => $value)
			{
				$table 					= $value->RequestNcm . "_" . $value->RequestAno;
				$idn 					= $value->RequestIDN;
				$dados[$key]			= $this->ncm_model->listDataNcm($table, $idn);
			}		
		}

		return $dados;
	}

	// Busca as informações de NCM e monta em um único array //
	function joinArray($dados, $dadosRequisicao)
	{

		$array = array();

		foreach ($dados as $key => $value)
		{
			$array[$key]['table'] 				= $dadosRequisicao[$key]['table'];
			$array[$key]['idn'] 				= $value->IDN;
			$array[$key]['idRe'] 				= $dadosRequisicao[$key]['idRe'];

			$array[$key]['descricao']			= $value->DESCRICAO_DETALHADA_PRODUTO;
			$array[$key]['categoria'] 			= $value->CNome;
			$array[$key]['modelo'] 				= $value->MNome;
			$array[$key]['marca'] 				= $value->MANome;
			
			
			// $array[$key]['requestID'] 	= $dadosRequisicao[$key]['idRe'];
			if (isset($dadosRequisicao[$key]['categoria']))
			{
				$categoria = $this->category_model->getCategory($dadosRequisicao[$key]['categoria']);	
			
				if (!empty($categoria[0]->CNome))
				{
					$array[$key]['categoriaRe'] 	= $categoria[0]->CNome;
					$array[$key]['categoriaReID'] 	= $dadosRequisicao[$key]['categoria'];				
				}
			}
			else
			{
				$array[$key]['categoriaRe'] 	= ' - ';
			}			
				
			if (isset($dadosRequisicao[$key]['marca']))
			{
				$marca 	= $this->brand_model->getBrand($dadosRequisicao[$key]['marca']);	
				
				if (!empty($marca[0]->MANome))
				{
					$array[$key]['marcaRe'] 		= $marca[0]->MANome;
					$array[$key]['marcaReID'] 		= $dadosRequisicao[$key]['marca'];				
				}			
			}		
			else
			{
				$array[$key]['marcaRe'] 		= ' - ';
			}

			if (isset($dadosRequisicao[$key]['modelo']))
			{
				$modelo 							= $this->model_model->getModel($dadosRequisicao[$key]['modelo']);
				if (!empty($modelo[0]->MNome))
				{
					$array[$key]['modeloRe'] 		= $modelo[0]->MNome;
					$array[$key]['modeloReID'] 		= $dadosRequisicao[$key]['modelo'];							
				}				
			}
			else
			{
				$array[$key]['modeloRe'] 		= ' - ';
			}

		}
	
		return $array;
	}

	// Exclusão de requisição //
	public function deleteRequest($id)
	{
		
		$this->request_model->deleteRequest($id);
			
		redirect('request/listAll');
	}	


	/**
	 * Atualiza um requisição do usuário
	 */
	public function updateRequest($id, $table, $idn, $categoria, $marca, $modelo)
	{

		if (is_numeric($categoria))
		{
			$this->request_model->updateRequest(1, $table, $idn, $categoria);
		}

		if (is_numeric($marca))
		{
			$this->request_model->updateRequest(2, $table, $idn, $marca);
		}

		if (is_numeric($modelo))
		{
			$this->request_model->updateRequest(3, $table, $idn, $modelo);
		}				


		$this->request_model->deleteRequest($id);
		
		redirect('request/listAll');

	}	



}
?>