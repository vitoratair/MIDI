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
			$data['total'] 				= $this->ncm_model->estatisticas(6, $table, NULL);
			$data['marcaEncontrada'] 	= $this->ncm_model->estatisticas(7, $table, NULL);
			$data['modeloEncontrado'] 	= $this->ncm_model->estatisticas(8, $table, NULL);
			$data['marca_modelo'] 		= $this->ncm_model->estatisticas(9, $table, NULL);
			$data['outros'] 			= $this->ncm_model->estatisticas(10, $table, NULL); 

			$data['main_content'] = 'administracao/estatisticas_view';
		}
		else
		{
			$data['main_content'] = 'administracao/estatisticasEmpty_view';
		}
		



		$this->parser->parse('template', $data);		


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