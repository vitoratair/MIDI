<?php 

class Categoria extends CI_Controller {


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
	 * Apresenta a view com todos as categorias cadastrados no sistema 
	 */
	public function listAll()
	{

		// Lista todos as categorias //
		$data['categorias'] = $this->categoria_model->listar();

		// Carrega a view correspondende //
		$data['main_content'] = 'categoria/categoria_view';
		
		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}

	/**
	 * Apresenta a view para associar NCMs a uma categoria
	 */
	public function associarCategoria($id)
	{

		$data['main_content'] = 'categoria/associar_view';

		$data['ncm'] = $this->categoria_model->getNcmCadastradas();

		$categoria = $this->categoria_model->getNCM($id);

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
		$data['categoriaNome']	= $this->categoria_model->getCategoria($id);


		// Envia todas as informações para tela //
		$this->parser->parse('template', $data);

	}		

	/**
	 * Apresenta view de cadastro de novas categorias
	 */
	public function addCategoria()
	{
		// Carrega a view correspondende //
		$data['main_content'] = 'categoria/addCategoria_view';

		// Envia todas as informações para tela //			
		$this->parser->parse('template', $data);		
	}


	/**
	 * Cadastrar a categoria NCMs
	 */
	public function updateAssociarCategoria()
	{
		// Recebe os dados do FORM //			
		$data['id'] 	= $this->input->post('idCategoria');
		$data['ncms'] 	= $this->input->post('categoriancmNCMs');

		// Deletar qualquer NCM associada com a categoria $categoriaNome
		$this->categoria_model->deleteAssociacaoCategoria($data['id']);		

		if ($data['ncms'])
		{
			foreach ($data['ncms'] as $key => $value)
			{
				$this->categoria_model->criarAssociacaoCategoria($value,$data['id']);
			}			
		}


		redirect('categoria/listAll');

	}


	/**
	 * setar nova categoria no banco
	 */
	public function setCategoria()
	{
		// Recebe os dados do FORM //			
		$data['CNome'] = $this->input->post('categoriaNome');

		// Chama o model responsável pela inserção no banco //
		$this->categoria_model->cadastrar($data);

		redirect('categoria/listAll');

	}

	
	/**
	 * Recupera as informações do cadastro e grava no banco de dados
	 */
	public function editCategoria($id)
	{
		$data['main_content'] = 'categoria/editCategoria_view';	

		// busca as informações da categoria
		$data['categoriaNome'] = $this->categoria_model->buscar($id);
		
		$this->parser->parse('template',$data);
	
	}
	
	/**
	 * Recupera as informações da subcategoria e grava no banco de dados
	 */
	public function editSubcategoria($id)
	{
		$data['main_content'] = 'categoria/editSubcategoria_view';	

		// busca as informações da subcategoria
		$data['subcategoria'] = $this->categoria_model->buscaSubcategoria($id);
	
		$this->parser->parse('template',$data);
	
	}

	/**
	 * Recupera as informações de itens 
	 */
	public function editItem($id,$coluna,$subcategoria)
	{
		$table 					= "SubCategoria".$coluna;
		$data['main_content'] 	= 'categoria/editItem_view';	

		// busca as informações da subcategoria
		$data['itens'] 			= $this->categoria_model->buscaItem($table,$id); 
		$data['coluna'] 		= $coluna;
		$data['subcategoria'] 	= $subcategoria;

		$this->parser->parse('template',$data);
	
	}

	/**
	 * update item no banco
	 */
	public function updateItem()
	{
		// Recebe os dados do FORM //			
		$data['SCID'] 				= $this->input->post('id');
		$data['SCNome'] 			= $this->input->post('subcategoriaitem');
		$data['Categoria_CID'] 		= $this->input->post('idCategoria');
		$subCategoria 				= $this->input->post('subcategoria');

		$categoria 					= $data['Categoria_CID'];

		$coluna 					= $this->input->post('coluna');
		$table 						= "SubCategoria".$coluna; 

		$this->categoria_model->updateItem($table,$data);				
		
		redirect("categoria/addItem/$subCategoria/$categoria/$coluna");

	}


	/**
	 * Atualiza a categoria
	 */
	public function updateCategoria()
	{
		$data['CID'] = $this->input->post('ID');
		$data['CNome'] = $this->input->post('categoriaNome');

		$this->categoria_model->updateCategoria($data);

		redirect('categoria/listAll');
	
	}

	/**
	 * Atualiza a subcategoria
	 */
	public function updateSubcategoria()
	{
		// Recebe os dados do FORM //			
		$id 					= $this->input->post('id');
		$data['TNome'] 			= $this->input->post('subcategoria');
		$data['TColuna'] 		= $this->input->post('indice');
		$data['Categoria_CID'] 	= $this->input->post('idCategoria');
		
		$categoria 				= $data['Categoria_CID']; 

		$this->categoria_model->cadastrarSubcategoriaUpdate($data,$id);

		redirect("categoria/tituloCategoria/$categoria");
	
	}

	

	/**
	 * Deleta a categoria e suas referencias em outras tabelas
	 */
	public function deleteCategoria($id)
	{

		$varTable = "Tables_in_" . DATABASE;

		// pegar todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();

		// Loop para apagar a referencia da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->categoria_model->updateCategoriaForNcm($value->$varTable,$id);
		}

		// Deleta a referencia da categoria na tebela Titulo Modelo e NCM-has-Categoria// 
		$this->categoria_model->updateCategoriaForDelete($id);

		// Deleta a referencia da categoria nas tabelas de subcategorias // 
		$this->categoria_model->deleteSubcategoriaByCategoria($id);		

		
		// deleta a categoria do banco de dados //
		$this->categoria_model->deleteCategoria($id);

		redirect('categoria/listAll','refresh');
	}
	

	/**
	 * Deleta a subcategoria e suas referencias em outras tabelas
	 */
	public function deleteSubcategoria($id)
	{


		// Recebe todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();

		// Recebe o indice do ID selecinado da tabela Titulo
		$indice = $this->categoria_model->getIndice($id); 
		$indice = $indice[0]->TColuna;


		// Recebe o ID da categoria
		$categoria = $this->categoria_model->getCategoriaByTitulo($id);
		$categoria = $categoria[0]->Categoria_CID;

		// Deleta a referencia da categoria na tabela Titulo // 
		$this->categoria_model->deleteSubcategoria($id);	

		
		// Loop para apagar a referencia da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $varTable = "Tables_in_" . DATABASE;
			 $this->categoria_model->updateSubcategoriaForNcm($value->$varTable, $indice,$id);
		}
		
		// Deleta a referencia da categoria nas tabelas de subcategorias // 
		$this->categoria_model->deleteSubcategoriaByCategoria($categoria);	

		// deleta a categoria do banco de dados //
		$this->categoria_model->deleteCategoria($id);

		redirect("categoria/tituloCategoria/$categoria",'refresh');
	}

	/**
	 * Deleta itens e suas referencias em outras tabelas
	 */
	public function deleteItem($id,$coluna,$categoria,$subcategoria)
	{

		$varTable = "Tables_in_" . DATABASE;

		$table  = "SubCategoria".$coluna."_SCID";
		$table1 = "SubCategoria".$coluna ;

		// pegar todas as tabelas de NCMs do sistema
		$data = $this->categoria_model->getAllNcm();


		// Loop para apagar a referencia da categoria em todas as NCMs
		foreach ($data as $key => $value)
		{
			 $this->categoria_model->updateItemForNcm($value->$varTable, $id, $table, $categoria);
		}

		// Deleta a referencia do item na tabela Modelo //
		$this->categoria_model->updateItemForModelo($id,$categoria,$table);

		// Deleta o item
		$this->categoria_model->deleteItem($id,$table1);			
		
		redirect("categoria/addItem/$subcategoria/$categoria/$coluna");

	}		



	/**
	 * Apresenta a view para adicionar um item na subcategoria
	 */
	public function addItem($idSubcategoria,$idCategoria,$coluna)
	{		
		$table = "SubCategoria".$coluna;
		$data['main_content'] 	= 'categoria/item_view';

		$data['idCategoria']	= $idCategoria;
		$data['idSubcategoria']	= $idSubcategoria;
		$data['coluna']			= $coluna;		
		$data['itens']			= $this->categoria_model->listaItens($table,$idCategoria);

		$this->parser->parse('template', $data);

	}


	/**
	 * Apresenta a view para associar NCMs a uma categoria
	 */
	public function tituloCategoria($id)
	{

		$data['main_content'] = 'categoria/titulo_view';

		$data['titulos'] = $this->categoria_model->listarTitulos($id);

		$data['idCategoria'] = $id;

		// Busca o nome da categoria pelo ID
		$data['categoriaNome']	= $this->categoria_model->getCategoria($id);

		$this->parser->parse('template', $data);

	}


	/**
	 * setar nova subcategoria no banco
	 */
	public function setSubcategoria()
	{
		// Recebe os dados do FORM //			
		$data['TNome'] 			= $this->input->post('subcategoria');
		$data['TColuna'] 		= $this->input->post('indice');
		$data['Categoria_CID'] 	= $this->input->post('idCategoria');
		
		$categoria 				= $data['Categoria_CID']; 

		// Verificar se já existe um índice para a categoria selecionada
		$indice['check'] = $this->categoria_model->verficarIndice($data);

		if (empty($indice['check'][0]->TID))
		{			
			// Chama o model responsável pela inserção no banco //
			$this->categoria_model->cadastrarSubcategoria($data);
		}
		else
		{
			// Chama o model responsável pelo update no banco //
			$this->categoria_model->cadastrarSubcategoriaUpdate($data, $indice['check'][0]->TID);					
		}


		redirect("categoria/tituloCategoria/$categoria");

	}

	/**
	 * setar nova subcategoria no banco
	 */
	public function setItem()
	{
		// Recebe os dados do FORM //			
		$data['SCNome'] 			= $this->input->post('subcategoriaitem');
		$data['Categoria_CID'] 		= $this->input->post('idCategoria');
		$subCategoria 				= $this->input->post('idSubcategoria');

		$coluna 					= $this->input->post('coluna');

		$table 						= "SubCategoria".$coluna; 
		$categoria 					= $data['Categoria_CID'];
		
		$this->categoria_model->cadastrarItem($table,$data);					
		
		redirect("categoria/addItem/$subCategoria/$categoria/$coluna");

	}	


}


