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
		
		$data['postSubcategorias'] = json_encode($sc);
	
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
				
				$data['dados'] 			= $resultado;
				$data['categoriaID']	= $categoria;

				$data = $this->montarArrayJavascript($data, $categoria);

				if (empty($data['titulos']))
				{
					$data['main_content'] 	= 'analise/analise_view';
				}
				else
				{
					$data['main_content'] 	= 'analise/analiseSubcategoria_view';
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

	
	/**
	 * Montar array para ser exibido no gráfico em javascript
	 */	
	public function analiseAnoParticipacaoModelo()
	{

		// Recebendo dados via POST //
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		

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
				$aux[$key] 			= $this->getDadosModelo($table, $categoria, $sc, $marca);
			}

			$aux 	= $this->mergeTabela($aux);			
			$aux 	= $this->mergeModelo($aux);
			$aux 	= $this->ordena($aux, 'unidades');
		
			foreach ($aux as $key => $value)
			{
				$dados 	= $dados . "," . "['" . $value['modeloNome'] . "'," . $value['unidades'] . "]";
			}			

			$dados 			= substr($dados, 1);
			$data['dados'] 	= $dados;

		}

		$data['categoriaNome'] 		= $this->categoria_model->buscar($categoria);
		$data['categoriaNome'] 		= $data['categoriaNome'][0]->CNome;
		$data['ano'] 				= $ano;
		$data['categoria'] 			= $categoria;
		$data['marca'] 				= $marca;
		$data['marcaNome'] 			= $this->marca_model->buscaMarca($marca);
		$data['marcaNome'] 			= $data['marcaNome'][0]->MANome;


		$data['postSubcategorias'] 	= $sc1;

		$data['main_content'] 		= 'analise/analiseAnoParticipacaoModelo_view';
		$this->parser->parse('template', $data);
	}

	/**
	 * Montar array para ser exibido no gráfico em javascript
	 */	
	public function analiseAnoParticipacao()
	{
		
		// Recebendo dados via POST //
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		

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
				$aux[$key] 			= $this->getDadosAnoParticipacao($table, $categoria, $sc);
			}

			$aux 	= $this->mergeTabela($aux);
			$aux 	= $this->mergeMarca($aux);
			$aux 	= $this->ordena($aux, 'unidades');
		
			foreach ($aux as $key => $value)
			{
				$dados 	= $dados . "," . "['" . $value['marcaNome'] . "'," . $value['unidades'] . "]";
			}			

			if (substr($dados,0,1) == ",")
			{
				$dados = substr($dados, 1);
			}
			else
			{
				$dados = substr($dados, 1, -7);	
			}

			$data['dados'] 				= $dados;

		}

		$data['categoriaNome'] 		= $this->categoria_model->buscar($categoria);
		$data['categoriaNome'] 		= $data['categoriaNome'][0]->CNome;
		$data['ano'] 				= $ano;
		$data['categoria'] 			= $categoria;
		$data['postSubcategorias'] 	= $sc1;

		$data['main_content'] 		= 'analise/analiseAnoParticipacao_view';
		$this->parser->parse('template', $data);

	}

		/**
	 * Montar array para ser exibido no gráfico em javascript
	 */	
	public function analiseAno()
	{
		// Recebendo dados via POST //
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key] 			= $this->getDadosAno($table, $categoria, $sc);
				$outros['unidades'] += $aux[$key][0]['outros'][0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
				$outros['volume'] 	+= $aux[$key][0]['outros'][0]->VALOR_TOTAL_PRODUTO_DOLAR;
			}

			// Montando estrutura de array para parser com a view //
			$aux 				= $this->mergeTabela($aux);
			$data['dados'] 		= $this->mergeMarca($aux);
			$data['dados'] 		= $this->ordena($data['dados'], 'unidades');
			
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
			$data['dados'] 		= $this->getMarcas($data['dados']);
			$data['dados'] 		= $this->calcularFob($data['dados']);
			$data['total'][0] 	= $this->calcularTotal($data['dados']);		
			$data['dados'] 		= $this->calcularShare(1, $data['dados'], $data['total'][0]);			
			$data['outros'][0] 	= $outros;
			
			// Formatando os dados com as devidas casa decimais //
			$data['total'][0] 	= $this->formatarDados(1, $data['total'][0]);
			$data['dados'] 		= $this->formatarDados(2, $data['dados']);
			$data['outros'][0] 	= $this->formatarDados(3, $data['outros'][0]);

		}		
		$data['categoriaNome'] 		= $this->categoria_model->buscar($categoria);
		$data['categoriaNome'] 		= $data['categoriaNome'][0]->CNome;
		$data['ano'] 				= $ano;
		$data['categoria'] 			= $categoria;
		$data['postSubcategorias'] 	= json_encode($sc);

		$data['main_content'] 	= 'analise/analiseAno_view';
		$this->parser->parse('template', $data);

	}

	/**
	 * Análise de modelos
	 */	
	public function analiseModelo()
	{

		// Recebendo dados via POST //
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);
		
		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosModelo($table, $categoria, $sc, $marca);
			}
			
			$aux 					= $this->mergeTabela($aux);			
			$data['dados'] 			= $this->mergeModelo($aux);						
			$data['dados'] 			= $this->calcularFob($data['dados']);
			$data['total'][0] 		= $this->calcularTotal($data['dados']);		
			$data['dados'] 			= $this->calcularShare(1, $data['dados'], $data['total'][0]);						
			$data['dados'] 			= $this->ordena($data['dados'], 'unidades');

			// Formatando os dados com as devidas casa decimais //
			$data['total'][0] 		= $this->formatarDados(1, $data['total'][0]);
			$data['dados'] 			= $this->formatarDados(2, $data['dados']);

			$marca 					= $this->marca_model->buscaMarca($marca);
			$data['marca'] 			= $marca[0]->MANome;
			$data['marcaID'] 		= $marca[0]->MAID;
			$data['ano']			= $ano;
			$categoria 				= $this->categoria_model->buscar($categoria);
			$data['categoriaNome'] 	= $categoria[0]->CNome;
		}

		$data['categoria'] 			= $categoria[0]->CID;
		$data['ano'] 				= $ano;
		$data['postSubcategorias'] 	= json_encode($sc1);

		$data['main_content'] 	= 'analise/analiseModelo_view';
		$this->parser->parse('template', $data);

	}

	/**
	 * Lista detalhada de importações feitas em um período por um modelo
	 */		
	public function analiseModeloDetalhe()
	{

		// Recebendo dados via POST //
		$modelo 	= $this->input->post('modelo');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosModeloDetalhe($table, $modelo);
			}
			
			$aux = $this->mergeTabela($aux);
			$data['dados'] = $this->ordena($aux, 'unidades');
			$data['dados'] = $this->formatarDados(6, $data['dados']);

		}

		$data['modelo'] 	= $modelo;
		$data['modeloNome'] = $this->modelo_model->getModelo($modelo);
		$data['modeloNome'] = $data['modeloNome'][0]->MNome;
		$data['ano'] 		= $ano;
		$data['categoria']	= $categoria;
		$data['marca']		= $this->modelo_model->bucaMarcaByModelo($modelo);
		$data['marca'] 		= $data['marca'][0]->MAID;
	
		$data['postSubcategorias'] 	= $sc1;

		// // print_r($data['postSubcategorias']);
		$data['main_content'] 	= 'analise/analiseModeloDetalhe_view';
		$this->parser->parse('template', $data);		

	}

	/**
	 * Lista detalhada de importações feitas em um período por uma marca
	 */		
	public function analiseMarcaDetalhe()
	{
		
		// Recebendo dados via POST //
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosMarcaDetalhe($table, $categoria, $sc, $marca);
			}
			
			$aux = $this->mergeTabela($aux);
			$aux = $this->ordena($aux, 'unidades');
			$data['dados'] = $this->formatarDados(5, $aux);
			
		}
		
		$data['categoria'] 		= $categoria;	
		$categoria 				= $this->categoria_model->buscar($categoria);
		$data['categoriaNome'] 	= $categoria[0]->CNome;
		$data['ano'] 			= $ano;
		$data['marcaNome'] 		= $this->marca_model->buscaMarca($marca);
		$data['marcaNome'] 		= $data['marcaNome'][0]->MANome;
		$data['postSubcategorias'] 	= $sc1;

		$data['main_content'] 	= 'analise/analiseDetalhe_view';
		$this->parser->parse('template', $data);		
	}

	/**
	 * Lista de dados
	 */		
	public function analiseOutrosDetalhe()
	{
		
		// Recebendo dados via POST //
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosOutrosDetalhe($table, $categoria, $sc);
			}

			$data['dados'] 	= $this->mergeTabela($aux);
			$data['dados'] 	= $this->ordena($data['dados'], 'unidades');

			$data['dados'] 	= $this->formatarDados(6, $data['dados']);

		}
		$data['categoria'] 			= $categoria;
		$data['ano'] 				= $ano;		
		$data['postSubcategorias'] 	= $sc1;
		$data['main_content'] 	= 'analise/analiseOutrosDetalhe_view';
		$this->parser->parse('template', $data);				


	}

	/**
	 * Evolução de marcas
	 */		
	public function analiseMarcaEvolucao()
	{
		
		// Recebendo dados via POST //
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);

		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosMarcaDetalhe($table, $categoria, $sc, $marca);
			}
			
			$aux 	= $this->mergeTabela($aux);
			$aux	= $this->mergeMeses($aux);	

		}
		
		foreach ($aux as $key => $value)
		{
			$unidades 	= $unidades . ", " . $value['unidades'];
			$fob 		= $fob . ", " . $value['fob'];
		}

		
		$data['categoria']	= $categoria;
		$data['marca']		= $marca;
		$data['marcaNome']	= $this->marca_model->buscaMarca($marca);
		$data['marcaNome'] 	= $data['marcaNome'][0]->MANome;
		$data['ano']		= $ano;
		$data['sc']			= $sc1;
		$data['unidades'] 	= substr($unidades, 1);
		$data['fob'] 		= substr($fob, 1);

		$data['main_content'] 	= 'analise/analiseMarcaEvolucao_view';
		$this->parser->parse('template', $data);        
	
	}

	/**
	 * Edição de importação
	 */		
	public function analiseEdicao()
	{

		$idn 	= $this->input->post('idn'); 
		$ncm 	= $this->input->post('ncm');
		$ano 	= $this->input->post('ano');

		$data['main_content'] 	= 'analise/analiseEdicao_view';
		$this->parser->parse('template', $data); 


	}
	
	/**
	 * Evolução de marcas
	 */		
	public function analiseModeloEvolucao()
	{
		
		// Recebendo dados via POST //
		$modelo 	= $this->input->post('modelo');
		$categoria 	= $this->input->post('categoria');
		$ano 		= $this->input->post('ano');
		$sc1 		= $this->input->post('subcategorias');		
		$sc 		= explode(",", $sc1);


		// Lista todas as opções //
		$data['anos']			= $this->ncm_model->listarAno();
		$data['ncm']			= $this->checkNcmCategoria($categoria);		
		$data['titulos']		= $this->categoria_model->listarTitulos($categoria);

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
				$aux[$key]	= $this->getDadosModeloDetalhe($table, $modelo);
			}
			
			$aux 	= $this->mergeTabela($aux);
			$aux	= $this->mergeMeses($aux);	

		}
		

		foreach ($aux as $key => $value)
		{
			$unidades 	= $unidades . ", " . $value['unidades'];
			$fob 		= $fob . ", " . $value['fob'];
		}

		
		$data['categoria']	= $categoria;
		$data['modelo']		= $modelo;
		$data['modeloNome']	= $this->modelo_model->getModelo($modelo);
		$data['modeloNome'] = $data['modeloNome'][0]->MNome;
		$data['ano']		= $ano;
		$data['sc']			= $sc1;
		$marca 				= $this->modelo_model->bucaMarcaByModelo($modelo);
		$data['marca'] 		= $marca[0]->MAID;		
		$data['unidades'] 	= substr($unidades, 1);
		$data['fob'] 		= substr($fob, 1);

		$data['main_content'] 	= 'analise/analiseModeloEvolucao_view';
		$this->parser->parse('template', $data);        
	
	}

	/**
	 * Merge das meses iguais
	 */	
	function mergeMeses($result)
	{
		for ($i=0; $i < 12 ; $i++)
		{ 
			$array[$i]['mes'] 		= $i + 1;
			$array[$i]['unidades'] 	= 0;
			$array[$i]['fob'] 		= 0;
		}

		foreach ($result as $key => $value)
		{
			switch ($value['mes'])
			{
				case '1':
					$array[0]['unidades'] 	+= $value['unidades'];
					$array[0]['fob'] 		+= $value['fob'];
					break;			
				case '2':
					$array[1]['unidades'] 	+= $value['unidades'];
					$array[1]['fob'] 		+= $value['fob'];
					break;
				case '3':
					$array[2]['unidades'] 	+= $value['unidades'];
					$array[2]['fob'] 		+= $value['fob'];
					break;					
				case '4':
					$array[3]['unidades'] 	+= $value['unidades'];
					$array[3]['fob'] 		+= $value['fob'];
					break;	
				case '5':
					$array[4]['unidades'] 	+= $value['unidades'];
					$array[4]['fob'] 		+= $value['fob'];
					break;	
				case '6':
					$array[5]['unidades'] 	+= $value['unidades'];
					$array[5]['fob'] 		+= $value['fob'];
					break;	
				case '7':
					$array[6]['unidades'] 	+= $value['unidades'];
					$array[6]['fob'] 		+= $value['fob'];
					break;					
				case '8':
					$array[7]['unidades'] 	+= $value['unidades'];
					$array[7]['fob'] 		+= $value['fob'];
					break;	
				case '9':
					$array[8]['unidades'] 	+= $value['unidades'];
					$array[8]['fob'] 		+= $value['fob'];
					break;	
				case '10':
					$array[9]['unidades'] 	+= $value['unidades'];
					$array[9]['fob'] 		+= $value['fob'];
					break;
				case '11':
					$array[10]['unidades'] 	+= $value['unidades'];
					$array[10]['fob'] 		+= $value['fob'];
					break;
				case '12':
					$array[11]['unidades'] 	+= $value['unidades'];
					$array[11]['fob'] 		+= $value['fob'];
					break;
				default:
					# code...
					break;
			}
		}
		
		return $array;		
	}
	
	/**
	 * Merge de todas as NCMs em um único array
	 */	
	function mergeTabela($dados)
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

	/**
	 * Altera o código da marca pelo nome da marca
	 */	
	function getMarcas($dados)
	{

		foreach ($dados as $key => $value)
		{
			$aux = $this->marca_model->buscaMarca($value['marca']);
			$dados[$key]['nomeMarca'] = $aux[0]->MANome;
		}
			
		return $dados;
	}

	/**
	 * Formata os dados unidades e o volume
	 */	
	function formatarDados($id, $dados)
	{
		if ($id == 1)
		{
			$dados['totalunidades'] = number_format($dados['totalunidades'],0,",",".");
			$dados['totalvolume'] 	= number_format($dados['totalvolume'],0,",",".");			
		}
		elseif($id == 2)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");
				$dados[$key]['volume'] 			= number_format($value['volume'],0,",",".");
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['shareUnidades'] 	= number_format($value['shareUnidades'],2,",",".");
				$dados[$key]['shareVolume'] 	= number_format($value['shareVolume'],2,",",".");				
			}			
		}
		elseif ($id == 3)
		{
			$dados['unidades'] 	= number_format($dados['unidades'],0,",",".");
			$dados['volume'] 	= number_format($dados['volume'],2,",",".");			
		}	
		elseif ($id == 4)
		{
			$dados['fob'] 	= number_format($dados['fob'],2,",",".");
			$dados['unidades'] 	= number_format($dados['unidades'],0,",",".");			
		}
		elseif ($id == 5)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");
				$dados[$key]['volume'] 			= number_format($value['volume'],0,",",".");
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['descricao'] 		= wordwrap($value['descricao'], 15, "\n", true);
			}			
		}
		elseif ($id == 6)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['descricao'] 		= wordwrap($value['descricao'], 15, "\n", true);
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");				
			}			
		}


		return $dados;
	}

	/**
	 * Calcula o FOB
	 */	
	function calcularFob($dados)
	{
		foreach ($dados as $key => $value)
		{
			$dados[$key]['fob'] = ($value['volume'] / $value['unidades']);		
		}


		return $dados;
	}	

	/**
	 * Calcula o total da pesquisa
	 */	
	function calcularTotal($dados)
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

	/**
	 * Merge das marcas iguais
	 */	
	function mergeMarca($result)
	{

		for ($i=0; $i<sizeof($result); $i++)		// compara o primeira posição do vetor com todas as outras
		{
			for ($j=1; $j<sizeof($result); $j++)
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
	 * Merge dos modelos iguais
	 */	
	function mergeModelo($result)
	{

		for ($i=0; $i<sizeof($result); $i++)		// compara o primeira posição do vetor com todas as outras
		{
			for ($j=1; $j<sizeof($result); $j++)
			{	
				if ($result[$i]['modelo'] == $result[$j]['modelo'])
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

		// Exclui resultados em branco
		foreach ($result as $key => $value)
		{
			if($value['unidades'] < 1)
			{
				unset($result[$key]);
			}
		}
		return $result;		
	}	

	/**
	 * Ordenação do array
	 */
	function ordena($data, $op)
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
	 * Ordena a tabela pelo ano
	 */	
	function projecao($array)
	{		

		$lastYear 	= sizeof($array);
		$lastYear 	= $lastYear - 1;
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
	function checkNcmCategoria($categoria)
	{
		$varTable 		= "Tables_in_" . DATABASE;
		$aux 			= array();
		$ncms			= $this->categoria_model->getAllNcm();
		$ncmCategoria 	= $this->ncm_model->getNcmByCategoria($categoria);		
		
		foreach ($ncms as $key => $value)
		{			
			$ncm = explode('_', $value->$varTable);

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
	function getDados($table, $categoria, $sc)
	{

		$modelos	= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);

		if (!empty($modelo))
		{
			// Formata o query para a clausula IN //
			foreach ($modelo as $key => $value)
			{
				array_push($modelos, $value->MOID);	
			}			
		}

		// Calcula as unidades referente a uma NCM //
		$unidades 			= $this->analise_model->calcUnidadesByModelo($table, $modelos);
		$volume 			= $this->analise_model->calcVolumeByModelo($table, $modelos);
		$result['unidades'] = $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
		$result['volume']	= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
		$result['ano'] 		= $ano;	

		return $result;		
	}

	/**
	 * Realiza o calculo para um determinado ano
	 */	
	function getDadosAno($table, $categoria, $sc)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		// Listando as marcas que tem modelos com as categorias especificadas //
		$marca = $this->ncm_model->getDadosAnosByMarca($table, $modelos);
		
		foreach ($marca as $key => $value)
		{
			array_push($marcas, $value->Marca);	
		}		

		if (!empty($marcas))
		{
			foreach ($marcas as $key => $value)
			{
				$array[$key]['marca'] 		= $marca[$key]->Marca;
				$unidades 					= $this->analise_model->calcUnidadesAnoByMarca($table, $array[$key]['marca'], $categoria, $modelos);			
				$volume 					= $this->analise_model->calcVolumeAnoByMarca($table, $array[$key]['marca'], $categoria, $modelos);
				$array[$key]['unidades'] 	= $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
				$array[$key]['volume'] 		= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
			}			
		}
		$array[0]['outros']	= $this->analise_model->getOutrosByAno($table, $categoria, $sc);
		return $array;

	}

	/**
	 * 
	 */	
	function getDadosAnoParticipacaoModelo($table, $categoria, $sc, $marca)
	{

		$modelos	= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];		

		//  //
		$marca = $this->ncm_model->getDadosAnosByMarca($table, $modelos);
		
		if (!empty($marca))
		{
			foreach ($marca as $key => $value)
			{
				$array[$key]['marca'] 		= $marca[$key]->Marca;
				$array[$key]['marcaNome'] 	= $marca[$key]->MANome;
				$unidades					= $this->analise_model->calcUnidadesAnoByMarca($table, $array[$key]['marca'], $categoria, $modelos);			
				$array[$key]['unidades'] 	= $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
			}			
		}

		return $array;
	}	

	/**
	 * Realiza o calculo para um determinado ano
	 */	
	function getDadosAnoParticipacao($table, $categoria, $sc)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		// Listando as marcas que tem modelos com as categorias especificadas //
		$marca = $this->ncm_model->getDadosAnosByMarca($table, $modelos);
		
		if (!empty($marca))
		{
			foreach ($marca as $key => $value)
			{
				$array[$key]['marca'] 		= $marca[$key]->Marca;
				$array[$key]['marcaNome'] 	= $marca[$key]->MANome;
				$unidades 					= $this->analise_model->calcUnidadesAnoByMarca($table, $array[$key]['marca'], $categoria, $modelos);			
				$array[$key]['unidades'] 	= $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
			}			
		}

		return $array;
	}	

	/**
	 * Realiza o calculo para um determinado ano
	 */	
	function getDadosModelo($table, $categoria, $sc, $marca)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria e marca //
		$modelo 	= $this->modelo_model->listarAllModeloByMarca($categoria, $sc, $marca);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		if (!empty($modelos))
		{
			foreach ($modelos as $key => $value)
			{
				$dados 						= $this->analise_model->calcAnoByModelo($table, $value, $categoria);			
				$array[$key]['modelo'] 		= $value;
				$array[$key]['modeloNome'] 	= $this->modelo_model->getModelo($value);
				$array[$key]['modeloNome']	= $array[$key]['modeloNome'][0]->MNome;
				$array[$key]['unidades'] 	= $dados[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
				$array[$key]['volume'] 		= $dados[0]->VALOR_TOTAL_PRODUTO_DOLAR;
			}			
		}
		
		return $array;
	}

	/**
	 * Busca as informações detlahadas de cada NCM
	 */	
	function getDadosMarcaDetalhe($table, $categoria, $sc, $marca)
	{

		$modelos	= array();
		$marcas		= array();
		$ano 		= explode('_', $table);
		$ncm 		= $ano[0];
		$ano 		= $ano[1];		

		// Verifica os modelos da categoria //
		$modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);			
		
		// Formata o query para a clausula IN //
		foreach ($modelo as $key => $value)
		{
			array_push($modelos, $value->MOID);	
		}		

		// Listando as marcas que tem modelos com as categorias especificadas //
		if (empty($marca))
		{
			$dados = $this->ncm_model->getDadosMarcaDetalhe($table, $modelos, NULL, $categoria);	
		}
		else
		{
			$dados = $this->ncm_model->getDadosMarcaDetalhe($table, $modelos, $marca, $categoria);
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

	/**
	 * Busca as informações detlahadas de cada NCM
	 */	
	function getDadosModeloDetalhe($table, $modelo)
	{

		$ano 		= explode('_', $table);
		$ncm 		= $ano[0];
		$ano 		= $ano[1];

		// buscando as informações de importações de modelos //
		$dados = $this->ncm_model->getDadosModeloDetalhe($table, $modelo);
		
		foreach ($dados as $key => $value)
		{
			$data[$key]['ncm']	 		= $ncm;
			$data[$key]['ano']	 		= $ano;
			$data[$key]['idn']	 		= $value->IDN;
			$data[$key]['descricao']	= $value->DESCRICAO_DETALHADA_PRODUTO;
			$data[$key]['fob'] 			= $value->VALOR_UNIDADE_PRODUTO_DOLAR;
			$data[$key]['unidades'] 	= $value->QUANTIDADE_COMERCIALIZADA_PRODUTO;
			$data[$key]['marca'] 		= $value->MANome;
			$data[$key]['modelo'] 		= $value->MNome;
			$data[$key]['mes'] 			= $value->MES;
		}
		return $data;

	}	

	/**
	 * Busca as informações detlahadas de cada NCM
	 */	
	function getDadosOutrosDetalhe($table, $categoria, $sc)
	{

		$ano 		= explode('_', $table);
		$ncm 		= $ano[0];
		$ano 		= $ano[1];		

		// // Listando as marcas que tem modelos com as categorias especificadas //
		$dados = $this->ncm_model->getDadosOutrosDetalhe($table, $categoria, $sc);
		foreach ($dados as $key => $value)
		{
			$data[$key]['ncm'] 			= $ncm;
			$data[$key]['idn'] 			= $value->IDN;
			$data[$key]['descricao'] 	= $value->DESCRICAO_DETALHADA_PRODUTO;
			$data[$key]['fob'] 			= $value->VALOR_UNIDADE_PRODUTO_DOLAR;
			$data[$key]['unidades'] 	= $value->QUANTIDADE_COMERCIALIZADA_PRODUTO;
			$data[$key]['marca'] 		= $value->MANome;
			$data[$key]['modelo'] 		= $value->MNome;
			$data[$key]['mes'] 			= $value->MES;
		}

		return $data;
	}	



}


