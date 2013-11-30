<?php 

class Brand extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}

	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}	
	
	// Apresenta a view com todos as marcas cadastrados no sistema //
	public function listAll()
	{

		// Recebe os dados do FORM //			
		$search		= $this->input->post('buscaMarca');

		if (empty($search))
		{
	        $config["base_url"] 	= base_url() . "index.php/brand/listAll";
	        $config["total_rows"] 	= $this->brand_model->countBrand();
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data['marcas'] 		= $this->brand_model->listBrand($config["per_page"], $page);	      
	        $data['links'] 			= $this->pagination->create_links();

		}
		else
		{
	        $config["base_url"] 	= base_url() . "index.php/brand/listAll";
	        $config["total_rows"] 	= $this->brand_model->countBrandSearch($search);
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

			$data["marcas"] 		= $this->brand_model->listBrandBySearch($search, $config["per_page"], $page);	
			$data["links"] 			= $this->pagination->create_links();			
		}

		$data['main_content'] 	= 'brand/brand_view';

		$this->parser->parse('template', $data);

	}				

	// View para adicionar marca //
	public function setBrandView()
	{
		$data['main_content'] = 'brand/brandAdd_view';
		$this->parser->parse('template', $data);
	}	
	
	// Adicionar uma nova marca //
	public function setBrand()
	{
		// Recebe os dados do FORM //			
		$data['MANome']		= $this->input->post('marcaNome');
		$data['MANome1']	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		if ($this->session->userdata('usuarioTipo') == 1)
			$this->brand_model->save($data);
		else
			$this->brand_model->saveRequest($data);

		redirect('brand/listAll');
	}

	// Edição da marca //
	public function editBrand($id)
	{

		$data['marcas'] = $this->brand_model->getBrand($id);

		$data['main_content'] = 'brand/brandEdit_view';
		$this->parser->parse('template', $data);

	}	

	// Atualiza a marca //
	public function updateBrand()
	{
		$data['MAID'] 		= $this->input->post('ID');
		$data['MANome'] 	= $this->input->post('marcaNome');
		$data['MANome1'] 	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		$this->brand_model->updateBrand($data);

		redirect('brand/listAll');
	
	}

}




?>