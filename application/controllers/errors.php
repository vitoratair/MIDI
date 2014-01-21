<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

	}
	
	// Exibe a view para error 404 //
	public function error_404()	
	{
		$this->load->view('errors/404_view');
	}	

}

/* End of file errors.php */
/* Location: ./application/controllers/errors.php */