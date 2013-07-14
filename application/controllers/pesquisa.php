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
	 * Apresenta a view com todos as opções para o usuário
	 */
	public function listAll()
	{

		// Verifica se existe dados de formulário //
		$ncm 	= $this->input->post('ncm');
		$ano 	= $this->input->post('ano');	
		$marca 	= $this->input->post('marca');

		// Carrega a view correspondende //
		$data['main_content'] = 'pesquisa/pesquisa_view';
		
		// Carrega os dados necessários da model //
		$data['ncms'] 	= $this->ncm_model->listar();
		$data['anos'] 	= $this->ncm_model->listarAno();					
		$data['marcas'] = $this->marca_model->listarAllMarca();			

		// Caso o usuário não tenha escolhido ncm e ano, recebe os dados da sessão //
		if (empty($ncm) && (empty($ano)))
		{
			$ncm = $this->session->userdata('ncm');
			$ano = $this->session->userdata('ano');				
		}

		// Montando o nome da tabela
		$table = $ncm . "_" . $ano;

		// verifica se a variável table só possui "_" //
		if (strlen($table) > 3)
		{

			// Salvando ncm e ano em sessão //
			$data['ncm'] = $ncm;
			$data['ano'] = $ano;
			$this->session->set_userdata($data);

			// Configurando paginação //
	        $config["base_url"] 	= base_url() . "index.php/pesquisa/listAll";

			if (!empty($marca) && (empty($modelo)))
			{
				// Carrega todos os modelos da marca selecionada //
				$data['modelos'] = $this->modelo_model->buscaModeloByMarca($marca);			

		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'2', $marca);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '2', $marca);
				$data["links"] = $this->pagination->create_links();				
			}
			elseif (empty($marca) && (empty($modelo)))
			{

		        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'1',NULL);
		        $config["per_page"] 	= 20;
		        
		        $this->pagination->initialize($config);
		        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

				// Carrega os dados somente com ano e ncm //
				$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '1', NULL);
				$data["links"] = $this->pagination->create_links();			
			}


		}

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}




}

?>