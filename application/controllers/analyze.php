<?php 

class Analyze extends CI_Controller
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

	// Apresenta a view com principal para análise //
	public function listAll()
	{

		// Variáveis utilizadas //
		$unidades 	= NULL;
		$volume 	= NULL;

		// Busca informações vinda do POST //
		$categoria 	= $this->input->post('categoria');

		for ($i=1; $i <= 8; $i++)
		{ 
			$varPost 	= "SubCategoria" . $i;
			$sc[$i-1] 	= $this->input->post($varPost);
		}
		
		$data['postSubcategorias'] = json_encode($sc);
	
		// Lista todas as opções //
		$data['categorias'] 	= $this->category_model->listCategory();
		$data['anos']			= $this->ncm_model->listYear();
		$data['ncm']			= $this->listNcmYearByCategory($categoria);		
		$data['titulos']		= $this->category_model->listTitle($categoria);

		
		if (!empty($data['ncm']))
		{		
			foreach ($data['ncm'] as $key => $value)
			{
				$ncms[$key] = $value[0] . "_" . $value[1];
			}

			// Verficar os valores de unidades e volumes de cada NCM //
			$i= 0;
			foreach ($ncms as $key => $table)
			{
				
				$aux = $this->getDataFirstShare($table, $categoria, $sc);				
				if ($aux['unidades'] > 0)
				{
					$dados[$i] = $aux;
					$i++;
				}				
			}			
		
			if (!empty($dados))
			{
				// Somar os array com aos iguais //
				$resultado = $this->sumSameYear($dados);
				$resultado = $this->orderTableByYear($resultado);
				
				$data['dados'] 			= $resultado;
				$data['categoriaID']	= $categoria;

				$data = $this->mountArrayJavascript($data, $categoria);				
				if (empty($data['titulos']))
				{
					$data['main_content'] 	= 'analyze/analise_view';						
				}
				else
				{
					$data['main_content'] 	= 'analyze/analyzeSubcategory_view';					
				}				

			}
			else
			{
				$data['main_content'] 	= 'analyze/analise_view_empty';
			}
		}
		else
		{
			$data['main_content'] 	= 'analyze/analise_view_empty';
		}
		$this->parser->parse('template', $data);
	}	

	// Análise de um ano //
	public function yearAnalyze()
	{
		// Recebendo dados via POST //
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');
		$sc 		= explode(",", $sc1);

		// Zerando contadores
		$outros['unidades'] = 0;
		$outros['volume'] = 0;

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listYear();
		$data['ncm']			= $this->listNcmYearByCategory($categoria);		
		$data['titulos']		= $this->category_model->listTitle($categoria);

		if (!empty($data['ncm']))
		{
			$i = 0;
			foreach ($data['ncm'] as $key => $value)
			{
				if ($value[1] == $ano)
				{
					$ncms[$i] = $value[0] . "_" . $value[1];	
					$i++;
				}			
			}		

			// Verficar os valores de unidades e volumes de cada NCM //
			$i= 0;
			foreach ($ncms as $key => $table)
			{				
				$aux[$key] 			= $this->getDataByYear($table, $categoria, $sc);
				$outros['unidades'] += $aux[$key][0]['outros'][0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
				$outros['volume'] 	+= $aux[$key][0]['outros'][0]->VALOR_TOTAL_PRODUTO_DOLAR;
			}

			// Montando estrutura de array para parser com a view //
			$aux 				= $this->mergeTable($aux);
			$data['dados'] 		= $this->mergebrand($aux);
			$data['dados'] 		= $this->orderTable($data['dados'], 'unidades');
			
			// Verficando e deletando o último elemento caso seja 0 //			
			$ultimo = sizeof($data['dados']) - 1;
			
			foreach ($data['dados'] as $key => $value)
			{
				if (($value['volume']) == 0)
				{
					unset($data['dados'][$key]);	
				}
			}
			
			// unset($data['dados'][sizeof($data['dados']) - 1]);
			$data['dados'] 		= $this->changeBrandIdToName($data['dados']);			
			$data['dados'] 		= $this->calcFob($data['dados']);			
			$data['total'][0] 	= $this->calcTotal($data['dados']);					
			$data['dados'] 		= $this->calcularShare(1, $data['dados'], $data['total'][0]);			
			$data['outros'][0] 	= $outros;
			
			// Formatando os dados com as devidas casa decimais //
			$data['total'][0] 	= $this->others->formatarDados(7, $data['total'][0]);
			$data['dados'] 		= $this->others->formatarDados(2, $data['dados']);
			$data['outros'][0] 	= $this->others->formatarDados(3, $data['outros'][0]);

		}		
		$data['categoriaNome'] 		= $this->category_model->getCategory($categoria);
		$data['categoriaNome'] 		= $data['categoriaNome'][0]->CNome;
		$data['ano'] 				= $ano;
		$data['categoria'] 			= $categoria;
		$data['postSubcategorias'] 	= json_encode($sc);

		$data['main_content'] 	= 'analyze/analyzeYear_view';
		$this->parser->parse('template', $data);

	}

	// Verifica quais as NCMs / anos pertencente a uma categoria //
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

	// Lista detalhada de importações feitas em um período por uma marca //	
	public function analizeBrandDetails()
	{		
		// Recebendo dados via POST //
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listYear();
		$data['ncm']			= $this->listNcmYearByCategory($categoria);		
		$data['titulos']		= $this->category_model->listTitle($categoria);

		if (!empty($data['ncm']))
		{
			$i = 0;
			foreach ($data['ncm'] as $key => $value)
			{
				if ($value[1] == $ano)
				{
					$ncms[$i] = $value[0] . "_" . $value[1];	
					$i++;
				}			
			}		

			// Recebe as opções de detalhes de NCM //
			$i= 0;
			foreach ($ncms as $key => $table)
			{
				$aux[$key]	= $this->brandDetailsByYear($table, $categoria, $sc, $marca);
			}
			
			$aux 			= $this->mergeTable($aux);
			$aux 			= $this->orderTable($aux, 'unidades');
			$data['dados'] 	= $this->others->formatarDados(6, $aux);
			
		}
		
		$data['categoria'] 		= $categoria;	
		$categoria 				= $this->category_model->getCategory($categoria);
		$data['categoriaNome'] 	= $categoria[0]->CNome;
		$data['ano'] 			= $ano;
		$data['marcaNome'] 		= $this->brand_model->getBrand($marca);
		$data['marcaNome'] 		= $data['marcaNome'][0]->MANome;
		$data['postSubcategorias'] 	= $sc1;

		$data['main_content'] 	= 'analyze/brandDetails_view';
		$this->parser->parse('template', $data);		
	}


	// Realiza o calculo para o share inicial de cada NCM -->
	function getDataFirstShare($table, $categoria, $sc)
	{
		$modelos	= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];

		// Verifica os modelos da categoria //
		$modelo 	= $this->model_model->listAllModelByCategory($categoria, $sc);

		if (!empty($modelo))
		{
			// Formata o query para a clausula IN //
			foreach ($modelo as $key => $value)
			{
				array_push($modelos, $value->MOID);	
			}			
		}

		// Calcula as unidades referente a uma NCM //
		$unidades 			= $this->model_model->calcPartsByModel($table, $modelos);
		$volume 			= $this->model_model->calcCashByModel($table, $modelos);
		$result['unidades'] = $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
		$result['volume']	= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
		$result['ano'] 		= $ano;	

		return $result;		
	}

	// Soma os arrays com os anos repetidos //
	public function sumSameYear($array)
	{
		
		$tamanho = sizeof($array);
		
		for ($i=0; $i < $tamanho; $i++)
		{ 		
			for ($j=1; $j < $tamanho; $j++)
			{ 
				if ($array[$i]['ano'] == $array[$j]['ano'])
				{											
					if ($i != $j)
					{				
						$array[$i]['unidades'] 	+=  $array[$j]['unidades'];
						$array[$i]['volume'] 	+=  $array[$j]['volume'];
						unset($array[$j]);	
					}					
				}			
			}
		}

		return $array;
	}

	// Ordena a tabela pelo ano //
	function orderTableByYear($array)
	{
		
		foreach ($array as $key => $value)
		{
			// Verifica se existe alguma entrada com unidades igual a 0 //
			if ($value['unidades'] > 0)
			{
				$filtro[$key] = $value['ano'];	
			}
			else
			{
				unset($array[$key]);
			}		   
		}
		array_multisort($filtro, SORT_ASC, $array);

		return $array;
	}

	/**
	 * Montar array para ser exibido no gráfico em javascript
	 */	
	function mountArrayJavascript($data, $categoria)
	{
		$data['categories'] 	= NULL;
		$data['categories']		= NULL;
		$data['dataUnidades'] 	= 0;
		$data['dataCash'] 		= 0;

		for ($i=0; $i < sizeof($data['titulos']); $i++)
		{ 
			$j = $i + 1;
			$aux = "SubCategoria" . $j;
			$data[$aux]	= $this->category_model->listElement($aux, $categoria);
			$data['subcategorias'][$i]['titulo'] = $data['titulos'][$i]->TNome;
			$data['subcategorias'][$i]['subc'] 	= $data[$aux];
			$data['subcategorias'][$i]['name'] 	= $aux;
		}


		// Montando array com os anos para javascript de gráfico //
		foreach ($data['dados'] as $key => $value)
		{
			$data['categories'] 	= $data['categories'] 	. "," . "'" . $value['ano'] . "'";
			$data['dataUnidades']	= $data['dataUnidades'] . "," . $value['unidades'];
			$data['dataCash']		= $data['dataCash'] . "," . 	$value['volume'];
		}

		$data['categories'] 	= substr($data['categories'], 1);
		$data['dataUnidades'] 	= substr($data['dataUnidades'], 2);
		$data['dataCash'] 		= substr($data['dataCash'], 2);

		$data['categoria'] 		= $this->category_model->getCategory($categoria);
		$data['categoria']		= "'" . $data['categoria'][0]->CNome . "'";			

		foreach ($data['dados'] as $key => $value)
		{
			$data['dados'][$key]['unidades'] 	= number_format($data['dados'][$key]['unidades'],0,",",".");
			$data['dados'][$key]['volume'] 		= number_format($data['dados'][$key]['volume'],0,",",".");
		}

		return $data;
	}

	// Busca as informações de unidades e $$ por ano //
	function getDataByYear($table, $categoria, $sc)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria //
		$modelo 	= $this->model_model->listAllModelByCategory($categoria, $sc);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		// Listando as marcas que tem modelos com as categorias especificadas //
		$marca = $this->brand_model->listBrandByArrayModel($table, $modelos);
				
		foreach ($marca as $key => $value)
		{
			array_push($marcas, $value->Marca);	
		}		

		if (!empty($marcas))
		{
			foreach ($marcas as $key => $value)
			{
				$array[$key]['marca'] 		= $marca[$key]->Marca;
				$unidades 					= $this->brand_model->sumPartsYearByBrand($table, $array[$key]['marca'], $categoria, $modelos);		
				$volume 					= $this->brand_model->sumCashYearByBrand($table, $array[$key]['marca'], $categoria, $modelos);
				$array[$key]['unidades'] 	= $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
				$array[$key]['volume'] 		= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
			}			
		}
		$array[0]['outros']	= $this->ncm_model->sumOthersByYear($table, $categoria, $sc);
		return $array;

	}

	// Merge de todas as NCMs em um único array //
	function mergeTable($dados)
	{
		$result = array();

		for ($i=0; $i < sizeof($dados); $i++)
		{ 
			if (!empty($dados[$i]))
			{
				$result = array_merge($result, $dados[$i]);	
			}
		}
			
		return $result;
	}

	// Merge das marcas iguais //
	function mergeBrand($result)
	{
		$count = sizeof($result);
		for ($i=0; $i < $count; $i++)		// compara o primeira posição do vetor com todas as outras
		{		
			for ($j=1; $j < $count; $j++)
			{					
				if ($result[$i]['marca'] == $result[$j]['marca'])
				{					
					if ($i != $j)
					{				
						$result[$i]['unidades'] = $result[$i]['unidades'] + $result[$j]['unidades'];
						$result[$i]['volume'] 	= $result[$i]['volume'] + $result[$j]['volume'];
						unset($result[$j]);
					}
				}					
				
			} 				
		}

		return $result;		
	}

	/**
	 * Ordenação do array
	 */
	function orderTable($data, $op)
	{	
		
		if (sizeof($data) > 1)
		{
			foreach ($data as $key => $row)
			{
			   $filtro[$key] = $row[$op];
			}
			array_multisort($filtro, SORT_DESC, $data);			
		}
		return $data;
	}

	// Altera o código da marca pelo nome da marca //
	function changeBrandIdToName($dados)
	{
		foreach ($dados as $key => $value)
		{
			$aux = $this->brand_model->getBrand($value['marca']);
			$dados[$key]['nomeMarca'] = $aux[0]->MANome;
		}
			
		return $dados;
	}


	// Calcula o FOB	//
	function calcFob($dados)
	{
		foreach ($dados as $key => $value)
		{
			$dados[$key]['fob'] = ($value['volume'] / $value['unidades']);		
		}

		return $dados;
	}

	// Calcula o total da pesquisa //
	function calcTotal($dados)
	{
		$total['totalunidades'] = 0;
		$total['totalvolume'] = 0;

		foreach ($dados as $key => $value)
		{
			$total['totalunidades']	+= $value['unidades'];
			$total['totalvolume'] 	+= $value['volume'];
		}
		return $total;
	}		

	/**
	 * Calcula o share
	 */	
	function calcularShare($id, $dados, $total)
	{
		// Calcula share de marca
		if ($id == 1)
		{
			$totalUnidades 	= $total['totalunidades'];
			$totalVolume 	= $total['totalvolume'];
			
			foreach ($dados as $key => $value)
			{
				$dados[$key]['shareUnidades'] 	= (($value['unidades'] / $totalUnidades) * 100);
				$dados[$key]['shareVolume'] 	= (($value['volume'] / $totalVolume) * 100);
			
			}
		}

		return $dados;
	}

	// Busca as informações detalhadas de cada NCM //
	function brandDetailsByYear($table, $categoria, $sc, $marca)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ncm 		= $ano[0];
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria //
		$modelo 	= $this->model_model->listAllModelByCategory($categoria, $sc);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		// Listando as marcas que tem modelos com as categorias especificadas //

		if (empty($marca))
		{
			$dados = $this->ncm_model->getDataDetails($table, $modelos, NULL, $categoria);	
		}
		else
		{
			$dados = $this->ncm_model->getDataDetails($table, $modelos, $marca, $categoria);
		}
		
		foreach ($dados as $key => $value)
		{
			$data[$key]['idn']	 		= $value->IDN;
			$data[$key]['ncm']	 		= $ncm;
			$data[$key]['ano']	 		= $ano;			
			$data[$key]['descricao']	= $value->DESCRICAO_DETALHADA_PRODUTO;
			$data[$key]['fob'] 			= $value->VALOR_UNIDADE_PRODUTO_DOLAR;
			$data[$key]['unidades'] 	= $value->QUANTIDADE_COMERCIALIZADA_PRODUTO;
			$data[$key]['marca'] 		= $value->MANome;
			$data[$key]['modelo'] 		= $value->MNome;
			$data[$key]['mes'] 			= $value->MES;
		}

		return $data;
	}

}

