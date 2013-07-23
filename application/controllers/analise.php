<?php 

class Analise extends CI_Controller {


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
	public function listAll()
	{

		// Variaveis utilizadas //
		$unidades 	= NULL;
		$volume 	= NULL;

		// Busca informações vinda do POST //
		$categoria 	= $this->input->post('categoria');
		for ($i=1; $i <= 8; $i++)
		{ 
			$varPost 	= "SubCategoria" . $i;
			$sc[$i-1] 	= $this->input->post($varPost);
		}
	
		// Lista todas as opções //
		$data['categorias'] 	= $this->categoria_model->listar();
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);
		
	

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
				$aux = $this->getDados($table, $categoria, $sc);
				if ($aux['unidades'] > 0)
				{
					$dados[$i] = $aux;
					$i++;
				}				
			}			

			if (!empty($dados))
			{
				// Somar os array com aos iguais //
				$resultado = $this->somarByAno($dados);
				$resultado = $this->ordenaTabelaAno($resultado);

				// Projeção de dados com dois anos a frente //
				$resultado = $this->projecao($resultado);
				
				$data['dados'] 			= $resultado;
				$data['categoriaID']	= $categoria;

				$data = $this->montarArrayJavascript($data, $categoria);
				$data['main_content'] 	= 'analise/analise_view';

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
	
	/**
	 * Montar array para ser exibido no gráfico em javascript
	 */	
	function montarArrayJavascript($data,$categoria)
	{
		$data['categories'] = NULL;
		

		for ($i=0; $i < sizeof($data['titulos']); $i++)
		{ 
			$j = $i + 1;
			$aux = "SubCategoria" . $j;
			$data[$aux]	= $this->categoria_model->listaItens($aux, $categoria);
			$data['subcategorias'][$i]['titulo'] = $data['titulos'][$i]->TNome;
			$data['subcategorias'][$i]['subc'] 	= $data[$aux];
			$data['subcategorias'][$i]['name'] 	= $aux;
		}


		// Montando array com os anos para javascript de gráfico //
		foreach ($data['dados'] as $key => $value)
		{
			$data['categories'] 	= $data['categories'] . "," . "'" . $value['ano'] . "'";
			$data['dataUnidades']	= $data['dataUnidades'] . "," . $value['unidades'];
		}
		$data['categories'] 	= substr($data['categories'], 1);
		$data['dataUnidades'] 	= substr($data['dataUnidades'], 1);
		$data['categoria'] 		= $this->categoria_model->getCategoria($categoria);
		$data['categoria']		= "'" . $data['categoria'][0]->CNome . "'";			

		

		foreach ($data['dados'] as $key => $value)
		{
			
			$data['dados'][$key]['unidades'] 	= number_format($data['dados'][$key]['unidades'],0,",",".");
			$data['dados'][$key]['volume'] 		= number_format($data['dados'][$key]['volume'],0,",",".");
		}



		return $data;
	}

	/**
	 * Ordena a tabela pelo ano
	 */	
	function ordenaTabelaAno($array)
	{
		
		foreach ($array as $key => $row)
		{
		   $filtro[$key] = $row['ano'];
		}
		array_multisort($filtro, SORT_ASC, $array);
		unset($array[0]);	

		return $array;
	}

	/**
	 * Ordena a tabela pelo ano
	 */	
	function projecao($array)
	{		

		$lastYear 	= sizeof($array);
		$next		= $lastYear + 1;
		// Novos anos //
		$array[$next]['ano'] 		= ($array[$lastYear]['ano'] + 1);
		$array[$next + 1]['ano'] 	= ($array[$lastYear]['ano'] + 2);
		
		// Novos volumes //
		$array[$next]['volume'] 	= (($array[$lastYear]['volume'] / 100)) + $array[$lastYear]['volume'];
		$array[$next+1]['volume'] 	= (($array[$next]['volume'] / 100)) + $array[$next]['volume'];


		// Novos Quantidades //
		$array[$next]['unidades'] 	= (($array[$lastYear]['unidades']/100)) + $array[$lastYear]['unidades'];		
	
		$array[$next+1]['unidades'] = (($array[$next]['unidades']/100)) + $array[$lastYear]['unidades'];

		


		return $array;
	}

	/**
	 * Soma os arrays com os anos repetidos
	 */
	public function somarByAno($array)
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

	/**
	 * Verifica quais as NCMs / anos pertencente a uma NCM
	 */
	public function checkNcmCategoria($categoria)
	{
		$ncms				= $this->categoria_model->getAllNcm();
		$ncmCategoria 		= $this->ncm_model->getNcmByCategoria($categoria);

		$aux 		= array();

		foreach ($ncms as $key => $value)
		{			
			$ncm = explode('_', $value->Table);			

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
				$table[$key] = $value;
			}			

			return $table;		
		}

		return FALSE;		
	}

	/**
	 * Realiza o calculo para o share inicial de cada NCM
	 */
	public function getDados($table, $categoria, $sc)
	{

		$modelos	= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);

		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}

		// Calcula as unidades referente a uma NCM //
		$unidades 			= $this->analise_model->calcUnidadesByModelo($table, $modelos);
		$volume 			= $this->analise_model->calcVolumeByModelo($table, $modelos);
		$result['unidades'] = $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
		$result['volume']	= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
		$result['ano'] 		= $ano;	

		return $result;		
	}


}


