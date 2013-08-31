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
		// $categoria 	= $this->input->post('categoria');
		$categoria = 2;

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
				$data['main_content'] 	= 'analise/analise_view_empty';
			}
		}
		else
		{
			$data['main_content'] 	= 'analise/analise_view_empty';
		}
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
		}

		$data['categories'] 	= substr($data['categories'], 1);
		$data['dataUnidades'] 	= substr($data['dataUnidades'], 2);


		$data['categoria'] 		= $this->category_model->getCategory($categoria);
		$data['categoria']		= "'" . $data['categoria'][0]->CNome . "'";			

		foreach ($data['dados'] as $key => $value)
		{
			
			$data['dados'][$key]['unidades'] 	= number_format($data['dados'][$key]['unidades'],0,",",".");
			$data['dados'][$key]['volume'] 		= number_format($data['dados'][$key]['volume'],0,",",".");
		}
		
		return $data;
	}



}

