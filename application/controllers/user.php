<?php

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}

	// Verifica se o usuário esta logado //
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Apresenta a view de perfil do usuário //
	public function perfil($login)
	{		
		$data['usuario'] 	= $this->user_model->getUserByLogin($login);		
		$data['tipo'] 		= $data['usuario'][0]->tipoNome;

		// Carrega a view correspondende  e envia para tela //
		$data['main_content'] = 'user/perfil_view';
		$this->parser->parse('template', $data);
	}
	
	// Lista todos os usuários cadastrados no sistema //
	public function listAll()
	{
		// Lista todos os usuarios //
		$data['usuarios'] = $this->user_model->listUser();

		$data['main_content'] = 'user/listUser_view';	
		$this->parser->parse('template', $data);

	} 

	// Remove o usuário do sistema //
	public function deleteUser($id)
	{		
		$this->user_model->delete($id);
		
		redirect('user/listAll');
	}	

	// Apresenta a view para novo usuário no sistema //
	public function newUser()
	{

		$data['cargos'] = $this->user_model->listProfession();
		$data['unidades'] = $this->user_model->listDepartment();
		$data['tipos'] = $this->user_model->listTypeUser();

		$data['main_content'] = 'user/newUser_view';
		$this->parser->parse('template', $data);
		
	}	

	// Cadastra um novo usuário no sistema //

	public function setUser() 
	{
	
		// Recupera dos dados a serem cadastrados //
		$data['usuarioNome']     	= $this->input->post('NomeUsuario');
		$data['usuarioMatricula']	= $this->input->post('Matricula');
		$data['usuarioLogin']    	= $this->input->post('Login');
		$data['usuarioPassword'] 	= $this->input->post('password');
		$data['usuarioEmail']    	= $this->input->post('Email');
		$data['cargoID']    		= $this->input->post('Cargo');
		$data['unidadeID']			= $this->input->post('Unidade');
		$data['tipoID']   		    = $this->input->post('Tipo');
 
		// Insere os dados do novo usuario no bd //
		$this->user_model->save($data);

		redirect('user/listAll');

	}

	// Apresenta a view para edição de usuário //
	public function editUser($id)
	{

		$usuario 					= $this->user_model->getUserById($id);		
	
		$data['usuarioID'] 			= $usuario[0]->usuarioID;			
		
		$data['usuarioNome'] 		= $usuario[0]->usuarioNome;		
		$data['usuarioLogin'] 		= $usuario[0]->usuarioLogin;		
		$data['usuarioEmail'] 		= $usuario[0]->usuarioEmail;
		
		$data['cargoNomeUser']		= $usuario[0]->cargoNome;
		$data['cargoIDUser']		= $usuario[0]->cargoID;

		$data['unidadeNomeUser']	= $usuario[0]->unidadeNome;
		$data['unidadeIDUser']		= $usuario[0]->unidadeID;

		$data['tipoNomeUser']		= $usuario[0]->tipoNome;
		$data['tipoIDUser']			= $usuario[0]->tipoID;

		$data['cargos']				= $this->user_model->listProfession();		
		$data['unidades']			= $this->user_model->listDepartment();
		$data['tipos']				= $this->user_model->listTypeUser();
		
		$data['main_content']		= 'user/editUser_view';	
		$this->parser->parse('template', $data);
	}

	// Recupera as informacoes da view newUser, e carrega o model para gravar no banco //
	public function updateUser()
	{		

		// Recupera dos dados a serem cadastrados //
		$id							= $this->input->post('ID');
		$data['usuarioNome']     	= $this->input->post('Nome');
		$data['usuarioLogin']     	= $this->input->post('Login');
		$data['usuarioEmail']    	= $this->input->post('Email');
		$data['cargoID']    		= $this->input->post('Cargo');
		$data['unidadeID']			= $this->input->post('Unidade');
		$data['tipoID']   		    = $this->input->post('Tipo');

		$this->user_model->updateUser($id, $data);

		redirect('user/listAll');	
	}


	// recupera o id do usuario que está logado //
	function getUserID()
	{
		return $this->session->userdata('usuarioID');
	}

	// Verifica se a senha do usuário esta correta //
	function getPassword($password)
	{
		
		$id = $this->getUserID();

		$retorno = $this->user_model->checkPassword($id, $password);

		echo json_encode($retorno);
		return;
	}

	// Atualiza a senha do usuário //
	function setPassword($password)
	{
		// recupera o id do usuario está que está logado //
		$id = $this->getUserID();

		$data['usuarioPassword']	= $password;

		$retorno = $this->user_model->updateUser($id, $data);

		echo json_encode($retorno);
		return;

	}
	

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
