<?php 

class Administracao extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE));
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
	 * Apresenta a view com principal para análise 
	 */
	public function estatisticasListAll()
	{

		// Recebe os dados do formulário //
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');
		$data['ncm'] 				= $ncm;
		$data['ano']				= $ano;		

		if (!empty($ncm) && (!empty($ano)))
		{
			$table = $ncm . "_" . $ano;	
		}
		
		// Busca as informações para enviar para view //
		$data['ncms'] 	= $this->ncm_model->listar();
		$data['anos'] 	= $this->ncm_model->listarAno();

		if(!empty($table))
		{
			// Busca os detalhes da NCM desejada por Mês//
			for ($i=1; $i <= 12; $i++)
			{ 			
				$data['dados'][$i]['mes'] 				= $this->buscaMes($i);
				$data['dados'][$i]['total'] 			= $this->ncm_model->estatisticas(1, $table, $i);
				$data['dados'][$i]['marcaEncontrada'] 	= $this->ncm_model->estatisticas(2, $table, $i);
				$data['dados'][$i]['modeloEncontrado'] 	= $this->ncm_model->estatisticas(3, $table, $i);
				$data['dados'][$i]['marca_modelo'] 		= $this->ncm_model->estatisticas(4, $table, $i);
				$data['dados'][$i]['outros'] 			= $this->ncm_model->estatisticas(5, $table, $i);
				$categorias 							= $this->ncm_model->estatisticas(11, $table, $i);			
				$data['dados'][$i]['categorias']	 	= $this->formataCategorias($categorias);

			}

			// Busca as informações totais de cada NCM //
			$data['total'] 					= $this->ncm_model->estatisticas(6, $table, NULL);
			$data['marcaEncontrada'] 	= $this->ncm_model->estatisticas(7, $table, NULL);
			$data['modeloEncontrado'] 	= $this->ncm_model->estatisticas(8, $table, NULL);
			$data['marca_modelo'] 			= $this->ncm_model->estatisticas(9, $table, NULL);
			$data['outros'] 				= $this->ncm_model->estatisticas(10, $table, NULL); 

			$data['main_content'] = 'administracao/estatisticas_view';
		}
		else
		{
			$data['main_content'] = 'administracao/estatisticasEmpty_view';
		}
		
		$this->parser->parse('template', $data);		

	}

	/**
	 * Apresenta a view com principal para processamento 
	 */
	public function processamento()
	{
		
		// Recebe os dados do formulário //
		$ncm 			= $this->input->post('ncm');
		$ano 			= $this->input->post('ano');
		$data['ncm'] 	= $ncm;
		$data['ano']	= $ano;

		// Busca as informações para enviar para view //
		$data['ncms'] 	= $this->ncm_model->listar();
		$data['anos'] 	= $this->ncm_model->listarAno();


		if (!empty($ncm) && (!empty($ano)))
		{
			$table = $ncm . "_" . $ano;	
		}
		
		// Busca as informações para enviar para view //
		$data['ncms'] 	= $this->ncm_model->listar();
		$data['anos'] 	= $this->ncm_model->listarAno();

		if(!empty($table))
		{
			// Busca os detalhes da NCM desejada por Mês//
			for ($i=1; $i <= 12; $i++)
			{ 			
				$data['dados'][$i]['mesID'] 			= $i;
				$data['dados'][$i]['mes'] 				= $this->buscaMes($i);
				$data['dados'][$i]['total'] 			= $this->ncm_model->estatisticas(1, $table, $i);
				$data['dados'][$i]['marcaEncontrada'] 	= $this->ncm_model->estatisticas(2, $table, $i);
				$data['dados'][$i]['modeloEncontrado'] 	= $this->ncm_model->estatisticas(3, $table, $i);
				$data['dados'][$i]['marca_modelo'] 		= $this->ncm_model->estatisticas(4, $table, $i);
				$data['dados'][$i]['outros'] 			= $this->ncm_model->estatisticas(5, $table, $i);
				$categorias 							= $this->ncm_model->estatisticas(11, $table, $i);			
				$data['dados'][$i]['categorias']	 	= $this->formataCategorias($categorias);

			}

			// Busca as informações totais de cada NCM //
			$data['total'] 					= $this->ncm_model->estatisticas(6, $table, NULL);
			$data['marcaEncontrada'] 	= $this->ncm_model->estatisticas(7, $table, NULL);
			$data['modeloEncontrado'] 	= $this->ncm_model->estatisticas(8, $table, NULL);
			$data['marca_modelo'] 			= $this->ncm_model->estatisticas(9, $table, NULL);
			$data['outros'] 				= $this->ncm_model->estatisticas(10, $table, NULL); 

			$data['main_content'] = 'administracao/processamento_view';
		}
		else
		{
			$data['main_content'] = 'administracao/processamentoEmpty_view';
		}


		
		$this->parser->parse('template', $data);

	}

	/**
	 * Processa os dados de uma determinada NCM.
	 */
	public function cleanNcm()
	{
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');
		$mes = $this->input->post('mes');
		$table = $ncm . "_" . $ano;

		$this->ncm_model->clean($table, $mes);

		redirect('administracao/processamento','refresh');

	}

	/**
	 * Processa os dados de uma determinada NCM.
	 */
	public function processar()
	{
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');
		$mes = $this->input->post('mes');
		$table = $ncm . "_" . $ano;

		// Busca todos os modelos cadastrados no sistema //
		$modelos = $this->modelo_model->listarAllModelo();
		unset($modelos[0]);

		// Percorre o array de modelos buscando referencia em cada linha de importação //
		foreach ($modelos as $key => $value)
		{	
			$dados = array(
				'Modelo' 	=> $value->MOID,
				'Categoria' => $value->Categoria_CID,
				'Marca' 	=> $value->Marca_MAID
			);
			$this->ncm_model->processarModelos($table, $mes, $value->MNome, $value->MNome1, $value->MNome2, $value->MNome3, $value->MNome4, $dados);
		}

		// Busca todos as marcas cadastrados no sistema //
		$marcas = $this->marca_model->listarAllMarca();

		foreach ($marcas as $key => $value)
		{
			$dados = array(
				'Marca' 	=> $value->MAID
			);
			$this->ncm_model->processarMarcas($table, $mes, $value->MANome, $value->MANome1, $value->MANome2, $dados);
		}

		// redirect('administracao/processamento','refresh');

	}

	/**
	 * Visualizar NCM por Mês, para debug
	 */
	public function visualizar()
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
		$data['mes'] 	= $this->buscaMes($mes);

		$config["base_url"] 	= base_url() . "index.php/administracao/visualizar";
        $config["total_rows"] 	= $this->ncm_model->countBuscaDados($table,'7', $brand, $model, NULL, NULL, $mes);			        			      
        $config["per_page"] 	= 20;

        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		// Carrega os dados somente com ano e ncm //
		$data['dados'] = $this->ncm_model->buscaDados($config['per_page'], $page, $table, '7', $brand, $model, NULL, NULL, $mes);
		$data['dados'] = $this->formatarDados(1, $data['dados']);

		$data["links"] = $this->pagination->create_links();			

		// Carrega a view correspondende //
		$data['main_content'] = 'administracao/visualizar_view.php';

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);


	}

	/**
	 * Formata os dados unidades e o volume
	 */	
	function formatarDados($id, $dados)
	{
		
		if($id == 1)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]->QUANTIDADE_COMERCIALIZADA_PRODUTO = number_format($value->QUANTIDADE_COMERCIALIZADA_PRODUTO,0,",",".");
			}			
		}

		return $dados;
	}


	function formataCategorias($dados)
	{

		foreach ($dados as $key => $value)
		{
			$categorias = $categorias . " - " . $value->CNome;
		}

		$categorias = substr($categorias, 3);
		return $categorias;
	}


	function buscaMes($i)
	{

		switch ($i) {
			
			case 1:			
				return "Janeiro";
				break;
			case 2:			
				return "Fevereiro";
				break;
			case 3:			
				return "Março";
				break;
			case 4:			
				return "Abril";
				break;
			case 5:			
				return "Maio";
				break;
			case 6:			
				return "Junho";
				break;
			case 7:			
				return "Julho";
				break;
			case 8:			
				return "Agosto";
				break;																
			case 9:			
				return "Setembro";
				break;	
			case 10:			
				return "Outubro";
				break;	
			case 11:			
				return "Novembro";
				break;									
			case 12:			
				return "Dezembro";
				break;													




			default:
				# code...
				break;
		}
	}

}

?>