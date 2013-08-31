<?php 

class Category extends CI_Controller
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

	// View principal para categoria //
	public function listAll()
	{

		// Lista todos as categorias //
		$data['categorias'] = $this->category_model->listCategory();
		// Deleta a primeira posição do array contendo a categoria "-" //
		unset($data['categorias'][0]);

		$data['main_content'] = 'category/category_view';	
		$this->parser->parse('template', $data);

	}	

	// Apresenta a view para cadastro de nova categoria //
	public function newCategory()
	{
		$data['main_content'] = 'category/newCategory_view';
		$this->parser->parse('template', $data);		
	}

	// Adiciona uma categoria no banco de dados //
	public function setCategory()
	{
		// Recebe os dados vindo do form //
		$data['CNome'] = $this->input->post('categoriaNome');

		$this->category_model->save($data);
		redirect('category/listAll');
	}

	// Recupera as informações do cadastro e grava no banco de dados //
	public function editCategory($id)
	{		
		$data['categoriaNome'] = $this->category_model->getCategory($id);

		$data['main_content'] = 'category/editCategory_view';	
		$this->parser->parse('template',$data);	
	}	

	// Update de uma categoria no banco //
	public function updateCategory()
	{
		$data['CID'] 	= $this->input->post('ID');
		$data['CNome'] 	= $this->input->post('categoriaNome');
		$this->category_model->updateCategory($data);
		redirect('category/listAll');
	}


	// Deleta a categoria e suas referências em outras tabelas //
	public function deleteCategory($id)
	{
		
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;
		
		// Lista todas as tabelas de NCMs do sistema
		$data = $this->ncm_model->listAllNcm();

		// Loop para apagar a referência da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			$this->ncm_model->updateCategoryNcm($value->$table, $id);
		}

		// Deleta a referência da categoria na tabela Titulo Modelo e NCM-has-Categoria// 
		$this->category_model->deleteReference($id);

		// Deleta a referencia da categoria nas tabelas de subcategorias // 
		$this->category_model->deletesubcategoryByCategory($id);	
		
		// deleta a categoria do banco de dados //
		$this->category_model->deleteCategory($id);

		redirect('category/listAll','refresh');
	}
	
	// Associar NCMs a categoria desejada //
	public function ncmConnect($id)
	{

		$data['ncm'] 	= $this->ncm_model->listNcm();
		$categoria 		= $this->category_model->listNcmByCategory($id);

		// passando o objeto ncmCategoria para um array		
		foreach ($categoria as $key => $value)
		{			
			$arrayCategoria[$key] = $value->NID;
		}

		// Caso não exista nenhuma categoria associada, seta um número inválido no array
		if (empty($arrayCategoria))
		{
			$arrayCategoria[0] = "-1";
		}
			
		$data['id'] 		= $id;
		$data['categoria']	= $arrayCategoria;

		// Busca o nome da categoria pelo ID
		$data['categoriaNome']	= $this->category_model->getCategory($id);

		$data['main_content'] = 'category/ncmConnect_view';
		$this->parser->parse('template', $data);

	}	

	// Associação de NCMs a uma categoria //
	public function connectNcmCategoria()
	{
		// Recebe os dados do FORM //			
		$data['id'] 	= $this->input->post('idCategoria');
		$data['ncms'] 	= $this->input->post('categoriancmNCMs');

		// Deletar qualquer NCM associada com a categoria $categoriaNome
		$this->category_model->deleteConnectionNcmCategory($data['id']);		

		if ($data['ncms'])
		{
			foreach ($data['ncms'] as $key => $value)
			{
				$this->category_model->createConnectionNcmCategory($value, $data['id']);
			}			
		}
		redirect('category/listAll');
	}

	// View com as subcategorias da categoria escolhida //
	public function titleCategory($id)
	{

		$data['idCategoria'] 	= $id;
		$data['titulos'] 		= $this->category_model->listTitle($id);		
		$data['categoriaNome']	= $this->category_model->getCategory($id);
		$data['main_content'] 	= 'category/title_view';
		$this->parser->parse('template', $data);

	}

	// View para edição de subcategoria //
	public function editTitle($id)
	{		
		$data['subcategoria'] = $this->category_model->getTitle($id);
		$data['main_content'] = 'category/editTitle_view';	
		$this->parser->parse('template',$data);	
	}

	// Atualiza uma subcategoria //
	public function updateTitle()
	{
		// Recebe os dados do FORM //			
		$id 					= $this->input->post('id');
		$data['TNome'] 			= $this->input->post('subcategoria');
		$data['TColuna'] 		= $this->input->post('indice');
		$data['Categoria_CID'] 	= $this->input->post('idCategoria');		
		$categoria 				= $data['Categoria_CID']; 
		$this->category_model->updateTitle($data,$id);

		redirect("category/titleCategory/$categoria");	
	}	

	// Adiciona uma nova subcategoria //
	public function setTitle()
	{
		// Recebe os dados do FORM //			
		$data['TNome'] 			= $this->input->post('subcategoria');
		$data['TColuna'] 		= $this->input->post('indice');
		$data['Categoria_CID'] 	= $this->input->post('idCategoria');
		$categoria 				= $data['Categoria_CID']; 

		// Verificar se já existe um índice para a categoria selecionada
		$indice['check'] 		= $this->category_model->checkID($data);

		if (empty($indice['check'][0]->TID))
		{			
			// Chama o model responsável pela inserção no banco //
			$this->category_model->setTitle($data);
		}
		else
		{
			// Chama o model responsável pelo update no banco //
			$this->category_model->updateTitle($data, $indice['check'][0]->TID);					
		}

		redirect("category/titleCategory/$categoria");
	}	

	// Deleta a subcategoria e suas referências em outras tabelas //
	public function deleteTitle($id)
	{
		// Constante contendo a string "Tables_in + DATABASE" //
		$table = TABLE;

		// Recebe todas as tabelas de NCMs do sistema
		$data 	= $this->ncm_model->listAllNcm();

		// Recebe o indice do ID selecinado da tabela Titulo
		$indice = $this->category_model->getIndice($id); 
		$indice = $indice[0]->TColuna;

		// Recebe o ID da categoria
		$categoria = $this->category_model->getCategoryByTitle($id);
		$categoria = $categoria[0]->Categoria_CID;

		// Deleta a referência da categoria na tabela Titulo // 
		$this->category_model->deleteTitle($id);	

		// Loop para apagar a referência da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->ncm_model->updateCategoryNcmByIndice($value->$table, $indice, $id);
		}		
		
		// Deleta a referencia da categoria nas tabelas de subcategorias // 
		$this->category_model->deletesubcategoryByCategory($categoria);	
	
		redirect("category/titleCategory/$categoria");
	}



	
}

?>