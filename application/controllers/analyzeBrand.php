<?php 

class AnalyzeBrand extends CI_Controller
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

	// Apresenta a view com principal para análise por marca //
	public function listAll()
	{

		//Recebe as variáveis via POST //
		$marca = $this->input->post('marca');

		// Retorna as opções para aprsentar na view //
		$data['marcas'] = $this->brand_model->listAllBrand();

		if ((empty($marca)) OR ($marca == 1))
		{
			$data['main_content'] 	= 'analyzeBrand/brandListAll_view_empty';	
		}
		else
		{
			$data['marcaNome'] 	= $this->brand_model->getBrand($marca);
			$data['marcaNome']	= $data['marcaNome'][0]->MANome; 
			$data['main_content'] 	= 'analyzeBrand/brandListAll_view';		
		}
		
		$this->parser->parse('template', $data);
	}








}

?>
