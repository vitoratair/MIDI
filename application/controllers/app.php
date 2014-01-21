<?php

class App extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}

	// Verifica se o usuario está logado //
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Apresenta view principal do sistema //
	public function home()
	{
		$data['main_content'] = 'home/home_view';
		$this->load->view('template', $data);
	}

	// Apresenta view com a metodologia //
	public function methodology()
	{
		$data['main_content'] = 'home/methodology_view';
		$this->load->view('template', $data);
	}

	// Apresenta view com a tutorial para uma nova pesquisa //
	public function newSearch()
	{
		$data['main_content'] = 'home/newSearch_view';
		$this->load->view('template', $data);
	}

	// Apresenta view com a documentaç~ao //
	public function documentation()
	{
		$data['main_content'] = 'home/documentation_view';
		$this->load->view('template', $data);
	}	

}


/* End of file app.php */
/* Location: ./application/controllers/app.php */