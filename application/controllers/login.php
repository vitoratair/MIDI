<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

	}
	
	// Exibe a View de login para o usuário //
	public function index()	
	{
		$this->load->view('login/login_view');
	}	


	// Validando Usuário //
	public function loginValidate()
	{
	
		$query = $this->user_model->validate();

		if ($query)
		{
			$data = array(

				'usuarioLogin' 	=> $this->input->post('login'),
				'usuarioTipo' 	=> $query[0]->tipoID,
				'usuarioID' 	=> $query[0]->usuarioID,
				'usuarioNome' 	=> $query[0]->usuarioNome,
				'usuarioEmail' 	=> $query[0]->usuarioEmail,   
				'logged' 		=> true
			);

			$this->session->set_userdata($data);
			redirect('app/home');

		}
		else
		{
			$this->session->set_userdata('msg', 'Nome de usuário ou senha estão inseridos de forma incorreta.');
			redirect('login');
		}
	}

	/**
	 * Logout do sistema
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */