<?php 

class Administration extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();	
		$this->logged();

	}

	// Verifica se o usuário está logado //
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Apresenta a view com a tela principal 	//
	// para realizar o processamento de dados 	//
	public function processing()
	{		

		// Recebe os dados do formulário //
		$ncm = $this->input->post('ncm');
		$ano = $this->input->post('ano');

		// Caso a variável ncm esteja vazia, recebe os dados que estão em sessão //
		if (empty($ncm))
		{
			if (!empty($this->session->userdata['ncm']))
			{
				$ncm 	= $this->session->userdata['ncm'];	
				$ano 	= $this->session->userdata['ano'];		
			}	
		}
		else
		{
			$session['ncm'] 	= $ncm;
			$session['ano'] 	= $ano;
			$this->session->set_userdata($session);
		}


		// Lista todas as NCMs e anos para enviar para view //
		$data['ncms'] 	= $this->ncm_model->listNcm();
		$data['anos'] 	= $this->ncm_model->listYear();		
		
		// Salva os dados para apresentar dentro do combobox //
		$data['ncm'] 	= $ncm;
		$data['ano']	= $ano;		

		if (!empty($ncm) && (!empty($ano)))
		{
			$table = $ncm . "_" . $ano;	
		}

		if(!empty($table))
		{
			if ($this->ncm_model->checkNcm($table))
			{
				// Busca os detalhes mensais da NCM desejada //
				for ($i=1; $i <= 12; $i++)
				{ 			
					$data['dados'][$i]['mesID'] 			= $i;
					$data['dados'][$i]['mes'] 				= $this->others->buscaMes($i);
					$data['dados'][$i]['total'] 			= $this->ncm_model->statistics(1, 	$table, $i);
					$data['dados'][$i]['marcaEncontrada'] 	= $this->ncm_model->statistics(2, 	$table, $i);
					$data['dados'][$i]['modeloEncontrado'] 	= $this->ncm_model->statistics(3, 	$table, $i);
					$data['dados'][$i]['marca_modelo'] 		= $this->ncm_model->statistics(4, 	$table, $i);
					$data['dados'][$i]['outros'] 			= $this->ncm_model->statistics(5, 	$table, $i);
				}

				$data['total'] 				= $this->ncm_model->statistics(6, 	$table, NULL);
				$data['marcaEncontrada'] 	= $this->ncm_model->statistics(7, 	$table, NULL);
				$data['modeloEncontrado'] 	= $this->ncm_model->statistics(8, 	$table, NULL);
				$data['marca_modelo'] 		= $this->ncm_model->statistics(9, 	$table, NULL);
				$data['outros'] 			= $this->ncm_model->statistics(10, 	$table, NULL); 
		
				$data['main_content'] = 'administration/processing_view';	
			}
			else
			{
				$data['main_content'] = 'administration/processingEmpty_view';	
			}			
		}
		else
		{
			$data['main_content'] = 'administration/processingEmpty_view';	
		}		

		$this->parser->parse('template', $data);
	 
	 } 

	// Apresenta a view com a tela principal 	//
	// para viaualizar as estatísticas de NCM	//
	public function statistic()
	{

		// Recebe os dados do formulário //
		$data['ncm'] 	= $this->input->post('ncm');
		$data['ano']	= $this->input->post('ano');	

		if (!empty($data['ncm']) && (!empty($data['ano'])))
		{
			$table = $data['ncm'] . "_" . $data['ano'];	
		}
		
		// Busca as informações para enviar para view //
		$data['ncms'] 	= $this->ncm_model->listNcm();
		$data['anos'] 	= $this->ncm_model->listYear();

		if(!empty($table))
		{
			// Busca os detalhes da NCM desejada por Mês//
			for ($i=1; $i <= 12; $i++)
			{ 			
				$data['dados'][$i]['mes'] 				= $this->others->buscaMes($i);
				$data['dados'][$i]['total'] 			= $this->ncm_model->statistics(1, 	$table, $i);
				$data['dados'][$i]['marcaEncontrada'] 	= $this->ncm_model->statistics(2, 	$table, $i);
				$data['dados'][$i]['modeloEncontrado'] 	= $this->ncm_model->statistics(3, 	$table, $i);
				$data['dados'][$i]['marca_modelo'] 		= $this->ncm_model->statistics(4, 	$table, $i);
				$data['dados'][$i]['outros'] 			= $this->ncm_model->statistics(5, 	$table, $i);
				$categorias 							= $this->ncm_model->statistics(11, 	$table, $i);			
				$data['dados'][$i]['categorias']	 	= $this->others->formataCategorias($categorias);

			}

			$data['total'] 				= $this->ncm_model->statistics(6, $table, NULL);
			$data['marcaEncontrada'] 	= $this->ncm_model->statistics(7, $table, NULL);
			$data['modeloEncontrado'] 	= $this->ncm_model->statistics(8, $table, NULL);
			$data['marca_modelo'] 		= $this->ncm_model->statistics(9, $table, NULL);
			$data['outros'] 			= $this->ncm_model->statistics(10, $table, NULL); 

			$data['main_content'] = 'administration/statistics_view';
		}
		else
		{
			$data['main_content'] = 'administration/statisticsEmpty_view';
		}
		
		$this->parser->parse('template', $data);		

	}


}

?>