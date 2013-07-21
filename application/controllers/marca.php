<?php 

class Marca extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
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
	 * Lista os modelos da marca
	 */
	public function modelos()
	{
		$marca 		= $this->input->post('marca');
		$categoria 	= $this->input->post('categoria');

		// Busca dados para pesquisa //
		$data['categorias'] = $this->categoria_model->listar();		

		if (empty($marca))
		{
			$marca = $this->session->userdata('marcaid');
		}
		else
		{			
			$data['marcaid'] = $marca;
			$this->session->set_userdata($data);
		}
		if (empty($categoria) && $categoria != -1)
		{
			if ($this->session->userdata('categoriaID'))
			{
				$categoria = $this->session->userdata('categoriaID');	
			}			
		}
		else
		{			
			$data['categoriaID'] = $categoria;
			$this->session->set_userdata($data);
		}		

		if (!empty($categoria) && ($categoria != -1))
		{
			// Carrega a view correspondende //
	        $config["base_url"] 	= base_url() . "index.php/marca/modelos";
	        $config["total_rows"] 	= $this->modelo_model->countModeloByMarcaCategoria($marca,$categoria);
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data["modelos"] = $this->modelo_model->listarModeloByMarcaCategoria($config["per_page"], $page, $marca, $categoria);
	        $data["links"] = $this->pagination->create_links();

			// pegar todas as tabelas de NCMs do sistema
			$ncms = $this->categoria_model->getAllNcm();


		}
		else
		{
			// Carrega a view correspondende //
	        $config["base_url"] 	= base_url() . "index.php/marca/modelos";
	        $config["total_rows"] 	= $this->modelo_model->countModeloByMarca($marca);
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data["modelos"] = $this->modelo_model->listarModeloByMarca($config["per_page"], $page, $marca);
	        $data["links"] = $this->pagination->create_links();

			// pegar todas as tabelas de NCMs do sistema
			$ncms = $this->categoria_model->getAllNcm();			
		}
		
		// Verfica se o modelo encontra-se em alguma NCM //
		foreach ($data['modelos'] as $key1 => $value1)
		{
			
			$check = FALSE;

			// Loop para percorrer as NCMs
			foreach ($ncms as $key => $value)
			{
				$countModelos = $this->modelo_model->verificarCadastro($value->Table,$value1->MOID);
				$countModelos = $countModelos[0]->IDN;

				if ($countModelos != 0)
				{
					$check = TRUE;
					break;
				}				
			}			

			if ($check == TRUE)
			{
				$value1->CHECK = 'icon-ok';
			}
			else
			{
				$value1->CHECK = 'icon-remove';	
			}
		}



		// Envia todas as informações para tela //
		$data['main_content'] 	= 'marca/modelo_view';
		$data['marca']			= $this->marca_model->buscaMarca($marca);
		$this->parser->parse('template', $data);
	}	

	
	/**
	 * Apresenta a view com todos as marcas cadastrados no sistema 
	 */
	public function listAll()
	{
		
		// Recebe os dados do FORM //			
		$search	= $this->input->post('buscaMarca');

		// Carrega a view correspondende //
		$data['main_content'] 	= 'marca/marca_view';

		if (empty($search))
		{

	        $config["base_url"] 	= base_url() . "index.php/marca/listAll";
	        $config["total_rows"] 	= $this->marca_model->countMarca();
		    $config["per_page"] 	= 20;

	        $this->pagination->initialize($config);
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	        
	        $data["marcas"] = $this->marca_model->listarMarca($config["per_page"], $page);
	        $data["links"] = $this->pagination->create_links();

		}
		else
		{
			$data["marcas"] = $this->marca_model->listarMarcaPesquisa($search);	
		}

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}			


	/**
	 * Edição da marca
	 */
	public function editMarca($id)
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'marca/marcaEdit_view';

		// Busca a marca com ID passado por parâmetro //
		$data['marcas'] = $this->marca_model->buscaMarca($id);

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * Adicionar marca
	 */
	public function addMarca()
	{

		// Carrega a view correspondende //
		$data['main_content'] = 'marca/marcaAdd_view';

		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}			


	/**
	 * setar nova marca no banco
	 */
	public function setMarca()
	{
		// Recebe os dados do FORM //			
		$data['MANome']		= $this->input->post('marcaNome');
		$data['MANome1']	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		// Chama o model responsável pela inserção no banco //
		$this->marca_model->cadastrar($data);

		redirect('marca/listAll');

	}

	/**
	 * Atualiza a marca
	 */
	public function updateMarca()
	{
		$data['MAID'] 		= $this->input->post('ID');
		$data['MANome'] 	= $this->input->post('marcaNome');
		$data['MANome1'] 	= $this->input->post('marcaNome1');
		$data['MANome2'] 	= $this->input->post('marcaNome2');

		$this->marca_model->updateMarca($data);

		redirect('marca/listAll');
	
	}


	/**
	 * Deleta a categoria e suas referencias em outras tabelas
	 */
	public function deleteMarca($id)
	{

		// pegar todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();

		// Loop para apagar a referencia da marca em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->marca_model->updateMarcaForNcm($value->Table,$id);
		}

		// Deleta a referencia da marca na tabela Modelo // 
		$this->marca_model->updateModelo($id);

		// Deleta a marca do banco de dados //
		$this->marca_model->deleteMarca($id);

		redirect('marca/listAll','refresh');
	}
	



	


}


