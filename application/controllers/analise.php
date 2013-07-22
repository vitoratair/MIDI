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

		// Busca informações vinda do POST //
		$categoria 	= $this->input->post('categoria');
		
		// Variaveis utilizadas //
		$unidades 	= NULL;
		$volume 	= NULL;


		// Lista todas as opções //
		$data['categorias'] = $this->categoria_model->listar();
		$data['anos']		= $this->ncm_model->listarAno();
		$data['ncm']		= $this->checkNcmCategoria($categoria);

		if (!empty($data['ncm']))
		{
			foreach ($data['ncm'] as $key => $value)
			{
				$ncms[$key] = $value[0] . "_" . $value[1];
			}

			// Laço para receber os dadados de cada NCM //
			$i= 0;
			foreach ($ncms as $key => $table)
			{
				$aux = $this->getDados($table, $categoria);
				if ($aux['unidades'] > 0)
				{
					$dados[$i] = $aux;
					$i++;
				}
				
			}			

			// print_r($dados);
			// Somar os array com aos iguais //
			$resultado = $this->somarByAno($dados);
			$resultado = $this->ordenaTabelaAno($resultado);

			$data['dados'] = $resultado;

		}
		else
		{


		}

		$data['main_content'] = 'analise/analise_view';
		
		$this->parser->parse('template', $data);

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
	public function getDados($table, $categoria)
	{

		$modelos	= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria);

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


