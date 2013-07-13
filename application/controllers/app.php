<?php

class App extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}

	/**
	 * 
	 * Apresenta view principal do sistema
	 *
	 */
	public function home()
	{
		$data['main_content'] = 'home/home_view';
		$this->load->view('template',$data);
	}
	
	
	/**
	 *
	 * Apresenta view do SQAP do sistema
	 *
	 */
	public function SQAP()
	{
		$data['main_content'] = 'SQAP/SQAP_view';
		$this->load->view('template',$data);
	}

	
	/**
	 *
	 * Apresenta view do SQAP do sistema
	 *
	 */
	public function Workflow()
	{
		$data['main_content'] = 'Workflow/Workflow_view';
		$this->load->view('template',$data);
	}
	
	/**
	 *
	 * Apresenta view do SQAP do sistema
	 *
	 */
	public function DOCS()
	{
		$data['main_content'] = 'DOCS/DOCS_view';
		$this->load->view('template',$data);
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


}


/* End of file app.php */
/* Location: ./application/controllers/app.php */