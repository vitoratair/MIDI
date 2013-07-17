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

		// Envia os dados para a view //
		$data['ncm'] 	= $ncm; 
		$data['year'] 	= $year;

		$data['main_content'] = 'pesquisa/editPesquisa_view';	

		// busca as informações da ncm
		$data['dados'] = $this->ncm_model->listarNcm($table, $id);
		
		$this->parser->parse('template',$data);		
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
		$unsearch 		= $this->input->post('unsearch');
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
			$brand = $this->session->userdata['brand'];
		}
		else
		{
			$session['brand'] = $brand;
			$this->session->set_userdata($session);	
		}		
		if (empty($model) && (empty($control)))
		{
			if (!empty($this->session->userdata['model']))
			$model = $this->session->userdata['model'];
		}
		else
		{
			$session['model'] = $model;
			$this->session->set_userdata($session);	
		}
		if (empty($search) && ($control == 2))
		{
			if (!empty($this->session->userdata['search']))
			$search = $this->session->userdata['search'];
		}
		else
		{
			$session['search'] = $search;
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

			if (!empty($search))
			{

				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'4',NULL, NULL, $search);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '4', NULL, NULL, $search);
				$data["links"] 	= $this->pagination->create_links();

			}
			elseif (empty($brand))
			{
				
				// Configurando paginação //
		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'1',NULL, NULL, NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] 	= $this->ncm_model->buscaDados($config['per_page'], $page, $table, '1', NULL, NULL, NULL);
				$data["links"] 	= $this->pagination->create_links();				

			}
			else
			{				
				if (empty($model))
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] = $this->modelo_model->buscaModeloByMarca($brand);			

			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'2', $brand, NULL, NULL);
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '2', $brand, NULL, NULL);
					$data["links"] = $this->pagination->create_links();									
				}
				else
				{
					// Carrega todos os modelos da marca selecionada //
					$data['modelos'] = $this->modelo_model->buscaModeloByMarca($brand);			

			        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'3', $brand, $model, NULL);			        			      
			        $config["per_page"] 	= 20;
			        
			        $this->pagination->initialize($config);
			        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

					// Carrega os dados somente com ano e ncm //
					$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '3', $brand, $model, NULL);
					$data["links"] = $this->pagination->create_links();	
				}
			}
		}
		else
		{
			// Exibe somente uma tela em branco para o usuário

		}

		// Carrega a view correspondende //
		$data['main_content'] = 'pesquisa/pesquisa_view';

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}
}

?>