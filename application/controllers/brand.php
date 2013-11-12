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

		if ($this->session->userdata('usuarioTipo') == 2)
		{
			$data['main_content'] 	= 'brand/brandUser_view';
		}
		else
		{
			$data['main_content'] 	= 'brand/brand_view';
		}

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
		$this->brand_model->save($data);

		redirect('brand/listAll');
	}

	// Deleta a marca e suas referencias em outras tabelas //
	public function deleteBrand($id)
	{
		
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;

		// Recebe todas as tabelas de NCMs do sistema //
		$data = $this->ncm_model->listAllNcm();

		// Loop para apagar a referência da marca em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->brand_model->deleteBrandNcm($value->$table, $id);
		}

		// Deleta a referência da marca na tabela Modelo // 
		$this->brand_model->deleteBrandModel($id);

		// Deleta a marca do banco de dados //
		$this->brand_model->deleteBrand($id);
		
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