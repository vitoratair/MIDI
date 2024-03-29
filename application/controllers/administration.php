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
		$data['ncm'] 		= $this->input->post('ncm');
		$data['ano']		= $this->input->post('ano');
		$categoria			= $this->input->post('categoria');
		
		if (!empty($categoria))
		{	
			$data['categoria']	= $this->category_model->getCategory($categoria);
			$data['categoria']	= $data['categoria'][0]->CNome;
		}

		// Busca as informações para enviar para view //	
		$data['ncms']		= $this->ncm_model->listNcm();
		$data['anos']		= $this->ncm_model->listYear();
		$data['categorias']	= $this->category_model->listCategory();

		// monta a tabela de NCM
		if (!empty($data['ncm']) && (!empty($data['ano'])))
		{
			$table = $data['ncm'] . "_" . $data['ano'];	
		}
		else
		{
			$table = NULL;
		}

		if ((empty($categoria)) AND (!empty($table)))
		{
			// verifica se a NCM existe na base de dados 
			if ($this->ncm_model->checkNcm($table))
			{
				// Busca os detalhes da NCM desejada por Mês //
				for ($i=1; $i <= 12; $i++)
				{ 			
					$data['dados'][$i]['mesID'] 			= $i;
					$data['dados'][$i]['mes'] 				= $this->others->buscaMes($i);
					$data['dados'][$i]['total'] 			= $this->ncm_model->statistics(1, 	$table, $i);
					$data['dados'][$i]['marcaEncontrada'] 	= $this->ncm_model->statistics(2, 	$table, $i);
					$data['dados'][$i]['modeloEncontrado'] 	= $this->ncm_model->statistics(3, 	$table, $i);
					$data['dados'][$i]['marca_modelo'] 		= $this->ncm_model->statistics(4, 	$table, $i);
					$data['dados'][$i]['outros'] 			= $this->ncm_model->statistics(5, 	$table, $i);
					$categorias 							= $this->ncm_model->statistics(11, 	$table, $i);			
					$data['dados'][$i]['categorias']	 	= $this->others->formataCategorias($categorias);

					// pesquisa o último mês contendo dados para processar //
					$lastUpdate 							= $this->ncm_model->getLastData($table);
					$data['dados'][$i]['lastUpdate'] 		= $this->others->buscaMes($lastUpdate[0]->MES);

					// pesquisa o último mês processado //
					$lastProcessing 						= $this->ncm_model->getLastProcessing($table);
					$data['dados'][$i]['lastProcessing'] 	= $this->others->buscaMes($lastProcessing[0]->MES);

				}
				// Busca os dados referente a NCM completa //
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
		}
		elseif (!empty($categoria))
		{
			$j = 0;
			$table 	= TABLE;
			// $data['ncms'] = NULL;
			$data['ncm'] = $this->ncm_model->listAllNcm();

			if (!empty($data['ncm']))
			{
				for ($i=0; $i < sizeof($data['ncm']); $i++)
				{
					$tables = $data['ncm'][$i]->$table;
					$count 	= $this->ncm_model->checkCategoryOnNCM($tables, $categoria);
					if ($count > 0)
					{
						$data['dados'][$j]['ncms'] 		= explode("_", $tables)[0];
						$data['dados'][$j]['anos'] 		= explode("_", $tables)[1];
						$data['dados'][$j]['qtd'] 		= $count;
						
						// Verifica se categoria esta associada a NCM
						if ($this->ncm_model->checkLinkCategory($categoria, $data['dados'][$j]['ncms']) > 0)
						{
							$data['dados'][$j]['cadastrada'] = "Sim"; 	
						}
						else
						{
							$data['dados'][$j]['cadastrada'] = "Não";
						}
						

						$j += 1; 					
					}
				}
			}
			
			if (empty($data['dados']))
			{
				$data['main_content'] = 'administration/statisticsCategoryEmpty_view';
			}
			else
			{
				$data['main_content'] = 'administration/statisticsCategory_view';	
			}
		}
		elseif ((empty($categoria)) AND (empty($table)))
		{
			$data['main_content'] = 'administration/statisticsFullEmpty_view';
		}
		
		$this->parser->parse('template', $data);		

	}

	// Estatísticas de uma categoria //
	function statisticCategory()
	{
		$categoria = $this->input->post('categoria');

		// Busca todas as informações para view //
		$data['categorias']	= $this->category_model->listCategory();

		if (!empty($categoria))
		{
			// Recebe toas as NCMs da categoria //
			$data['ncm'] = $this->listNcmYearByCategory($categoria);
			
			if (!empty($data['ncm']))
			{
				for ($i=0; $i < sizeof($data['ncm']); $i++)
				{
					$table = $data['ncm'][$i][0] . "_" . $data['ncm'][$i][1];
					
					// pesquisa o último mês contendo dados para processar //
					$lastUpdate 							= $this->ncm_model->getLastData($table);
					$data['dados'][$i]['lastUpdate'] 		= $this->others->buscaMes($lastUpdate[0]->MES);

					// pesquisa o último mês processado //
					$lastProcessing 						= $this->ncm_model->getLastProcessing($table);
					$data['dados'][$i]['lastProcessing'] 	= $this->others->buscaMes($lastProcessing[0]->MES);
					
					// Busca a NCM e o ano //
					$data['dados'][$i]['ncm'] 		= $data['ncm'][$i][0];
					$data['dados'][$i]['anos'] 		= $data['ncm'][$i][1];
				}
				$data['main_content'] = 'administration/statisticsCategory_view';
			}
			else
			{
				$data['main_content'] = 'administration/statisticsCategoryEmpty_view';				
			}

		}
		else
		{
			$data['main_content'] = 'administration/statisticsCategoryEmpty_view';	
		}

		$this->parser->parse('template', $data);

	}

	// Verifica quais as NCMs / anos pertencente a uma categoria //
	// código duplicado //
	function listNcmYearByCategory($categoria)
	{
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;

		$aux 			= array();
		$ncms			= $this->ncm_model->listAllNcm();
		$ncmCategoria 	= $this->ncm_model->listNcmByCategory($categoria);		
		
		foreach ($ncms as $key => $value)
		{			
			$ncm = explode('_', $value->$table);
			foreach ($ncmCategoria as $key1 => $value1)
			{	
				if (in_array($value1->NNome, $ncm))
				{ 							
					array_push($aux, $ncm);

				}				
			}
		}

		if (!empty($aux))
		{
			foreach ($aux as $key => $value)
			{
				$result[$key] = $value;
			}			
			return $result;		
		}

		return FALSE;		
	}

	// Exibe último mês atualizado em cada NCM de uma categoria //
	function date()
	{	
		$categoria = $this->input->post('categoria');

		$data['categorias']	= $this->category_model->listCategory();
		
		if (empty($categoria) or $categoria == 1)
		{	
			$data['dados'][0]['ncm'] = NULL;
			$data['dados'][0]['ano'] = NULL;
			$data['dados'][0]['mes'] = NULL;
			$data['categoria']		= "-";
		}
		else
		{
			$data['categoria']	= $this->category_model->getCategory($categoria);
			$data['categoria']	= $data['categoria'][0]->CNome;

			$categorias = $this->listNcmYearByCategory($categoria);

			$i = 0;
			foreach ($categorias as $key => $value)
			{
				$table = $value[0] . "_" . $value[1];
					
				if ($this->ncm_model->checkNcm($table))
				{		

					$data['dados'][$i]['ncm'] = $value[0];
					$data['dados'][$i]['ano'] = $value[1];
					$data['dados'][$i]['mes'] = $this->others->buscaMes($this->ncm_model->getLastData($table)[0]->MES);
					$i = $i + 1;
				}
			}
		}

		$data['main_content'] = 'administration/date_view';	
		$this->parser->parse('template', $data);	
	}

}

?>