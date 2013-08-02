<?php 

class Requisicoes extends CI_Controller {


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
	 * Apresenta a view para listar as requisições
	 */
	public function listAll()
	{

		// Lista todas as requisições //
		$dados = $this->requisicoes_model->buscar();
		$data['dadosRequisicao'] = $this->buscaDados(1, $dados);

		// Busca as informações da NCM //
		$data['dados'] 	= $this->buscaDados(2, $dados);
		$data['dados']	= $this->mergeTabela($data['dados']);

		// // Juntando os arrays //
		$data['dados'] = $this->joinArray($data['dados'], $data['dadosRequisicao']);					


		$data['main_content'] = 'requisicoes/requisicoes_view';
		$this->parser->parse('template',$data);	

	}

	/**
	 * Atualiza um requisição do usuário
	 */
	public function updateRequest()
	{

		$id 		= $this->input->post('idRe');
		$table 		= $this->input->post('table');
		$idn 		= $this->input->post('idn');

		$categoria 	= $this->input->post('categoria');
		$marca 		= $this->input->post('marca');
		$modelo 	= $this->input->post('modelo');

		$this->requisicoes_model->update($table, $idn, $categoria, $marca, $modelo);
		// $this->requisicoes_model->delete($id);
		
		redirect('requisicoes/listAll','refresh');

	}

	/**
	 * Deleta uma requisição
	 */
	public function delete()
	{

		$id 	= $this->input->post('idRe');
		
		$this->requisicoes_model->delete($id);
			
		redirect('requisicoes/listAll','refresh');
	}


	/**
	 * Busca as informações de NCM e monta em um único array
	 */
	function joinArray($dados, $dadosRequisicao)
	{

		$array = array();

		foreach ($dados as $key => $value)
		{
			
			$array[$key]['table'] 			= $dadosRequisicao[$key]['table'];
			$array[$key]['idn'] 			= $value->IDN;
			$array[$key]['idRe'] 			= $dadosRequisicao[$key]['idRe'];

			$array[$key]['descricao']		= $value->DESCRICAO_DETALHADA_PRODUTO;
			$array[$key]['categoria'] 		= $value->CNome;
			$array[$key]['modelo'] 			= $value->MNome;
			$array[$key]['marca'] 			= $value->MANome;
			
			$categoria 						= $this->categoria_model->getCategoria($dadosRequisicao[$key]['categoria']);
			
			if (!empty($categoria[0]->CNome))
			{
				$array[$key]['categoriaRe'] 	= $categoria[0]->CNome;
				$array[$key]['categoriaReID'] 	= $dadosRequisicao[$key]['categoria'];				
			}
			else
			{
				$array[$key]['categoriaRe'] 	= ' - ';
			}

			$marca 							= $this->marca_model->buscaMarca($dadosRequisicao[$key]['marca']);
			if (!empty($marca[0]->MANome))
			{
				$array[$key]['marcaRe'] 		= $marca[0]->MANome;
				$array[$key]['marcaReID'] 		= $dadosRequisicao[$key]['marca'];				
			}
			else
			{
				$array[$key]['marcaRe'] 	= ' - ';
			}

			$modelo 						= $this->modelo_model->getModelo($dadosRequisicao[$key]['modelo']);
			if (!empty($modelo[0]->MNome))
			{
				$array[$key]['modeloRe'] 		= $modelo[0]->MNome;
				$array[$key]['modeloReID'] 		= $dadosRequisicao[$key]['modelo'];							
			}
			else
			{
				$array[$key]['modeloRe'] 	= ' - ';
			}



		}

		return $array;

	}

	/**
	 * Busca as informações de NCM e monta em um único array
	 */
	function buscaDados($id, $data)
	{
		if ($id == 1)
		{
			foreach ($data as $key => $value)
			{
				$dados[$key]['idRe']		= $value->RequestID;	
				$dados[$key]['table'] 		= $value->RequestNcm . "_" . $value->RequestAno;
				
				if (!empty($value->RequestCategoria))
				{
					$dados[$key]['categoria'] 	= $value->RequestCategoria;	
				}
				if (!empty($value->RequestMarca))
				{
					$dados[$key]['marca'] 		= $value->RequestMarca;	
				}
				if (!empty($value->RequestModelo))
				{
					$dados[$key]['modelo'] 		= $value->RequestModelo;	
				}
				
				
			}		

		}
		elseif ($id == 2)
		{
			foreach ($data as $key => $value)
			{
				$table 				= $value->RequestNcm . "_" . $value->RequestAno;
				$idn 				= $value->RequestIDN;
				$dados[$key]		= $this->ncm_model->listarNCM($table, $idn);	
			}		

		}

		return $dados;
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
}


?>