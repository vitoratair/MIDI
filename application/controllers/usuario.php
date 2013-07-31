<?php

/**
 * Classe para controlar as funcoes relacionadas ao Usuario 
 */
class Usuario extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->logged();

	}


	/**
	 * Verifica se o usuario esta logado
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
	 * Chama a view para listar usuarios e socita ao model todos os usuarios cadastrados do bd
	 */
	public function listAll()
	{

		// Lista todos os usuarios //
		$data['usuarios'] = $this->usuario_model->listar(0);

		// // Carrega a view correspondende //
		$data['main_content'] = 'usuario/listUser_view';
		
		// // Envia todas as informacoes para tela //
		$this->parser->parse('template', $data);

	} 


	/**
	 *
	 * Apresenta view de cadastro de novo usuario
	 *
	 */
	public function newUser()
	{
		// Lista todos os cargos Ativos no sistema//
		$data['cargos'] = $this->cargo_model->listar(2);

		// Lista todos os departamentos //
		// $data['departamentos'] = $this->departamento_model->listar(0);

		// Lista todas as unidades de negocio //
		$data['unidades'] = $this->unidade_model->listar(0);

		// Lista todos os tipos de usuario //
		$data['tipos'] = $this->tipo_model->listar();

		// Carrega a view correspondende //
		$data['main_content'] = 'usuario/newUser_view';

		// Envia todas as informacoes para tela //		
		$this->parser->parse('template', $data);
		
	}


	/**
	 * Recupera as informacoes da view newUser, e carrega o model para gravar no banco os dados
	 */
	public function cadastrarUser() 
	{
	
		// Recupera dos dados a serem cadastrados //
		$data['usuarioNome']     	= $this->input->post('Nome');
		$data['usuarioMatricula']	= $this->input->post('Matricula');
		$data['usuarioLogin']    	= create_username($this->input->post('Nome'), $this->input->post('Matricula'));
		$data['usuarioPassword'] 	= create_username($this->input->post('Nome'), $this->input->post('Matricula')); 
		$data['usuarioEmail']    	= $this->input->post('Email');
		$data['cargoID']    		= $this->input->post('Cargo');
		$data['unidadeID']			= $this->input->post('Unidade');
		$data['tipoID']   		    = $this->input->post('Tipo');

		 
		// Insere os dados do novo usuario no bd //
		$this->usuario_model->cadastrar($data);
		redirect('usuario/listAll');

	}


	/**
	 *
	 * Apresenta view de edicao de um usuario
	 *
	 */
	public function editUser($id)
	{
		$data2['main_content']	= 'usuario/editUser_view';	

		$data['usuario'] 		= $this->usuario_model->buscar($id);		
		$data2['usuarioID'] 	= $data['usuario'][0]->usuarioID;		
		$data2['usuarioNome'] 	= $data['usuario'][0]->usuarioNome;		
		$data2['usuarioEmail'] 	= $data['usuario'][0]->usuarioEmail;
		
		$data2['cargos']		= $this->cargo_model->listar(2);
		
		$data2['unidades']		= $this->unidade_model->listar(2);
		
		
		$data2['tipos']			= $this->tipo_model->listar(2);
		
		$this->parser->parse('template', $data2);
	}


	/**
	 * Recupera as informacoes da view newUser, e carrega o model para gravar no banco os dados
	 */
	public function editUsuario()
	{
	
		// Recupera dos dados a serem cadastrados //
		$id							= $this->input->post('ID');
		$data['usuarioNome']     	= $this->input->post('Nome');
		$data['usuarioEmail']    	= $this->input->post('Email');
		$data['cargoID']    		= $this->input->post('Cargo');
		$data['unidadeID']			= $this->input->post('Unidade');
		$data['tipoID']   		    = $this->input->post('Tipo');
	
		// Insere os dados do novo usuario no bd //
		$this->usuario_model->atualizaUsuario($id, $data);
	
		redirect('usuario/listAll');
	
	}
		
	
	/**
	 * Chama o model para deletar o usuario selecionado, apos essa operacao retorna a view de listagem de usuarios
	 */
	public function deleteUser($id)
	{
		
		$this->usuario_model->deletar($id);
		
		redirect('usuario/listAll','refresh');
	}	

	/**
	 * Apresenta a view de informacoes do usuario
	 */
	public function pageUser($login)
	{
			
		// Carrega a view correspondende //
		$data['main_content'] = 'usuario/pageUser_view';
		
		//print_r($data);
				
		$data['usuario'] = $this->usuario_model->buscarByLogin($login);
		
		$tipo = $data['usuario'][0]->tipoID;
		
		$data['tipo'] = $this->tipo_model->buscar($tipo);
		
		// Envia todas as informacoes para tela //			
		$this->parser->parse('template', $data);
	}

	/**
	 * Verific se a senha do usuario
	 */
	public function getPass($password)
	{
		// recupera o id do usuario está que está logado //
		$id = $this->getUserID();

		$retorno = $this->usuario_model->getPass($id, $password);

		echo json_encode($retorno);
		return;
	}

	/**
	 * Atualiza Senha do usuario 
	 */
	public function setPass($password)
	{
		// recupera o id do usuario está que está logado //
		$id = $this->getUserID();

		$data['usuarioPassword']	= $password;

		$retorno = $this->usuario_model->atualizaUsuario($id, $data);

		echo json_encode($retorno);
		return;

	}
	
}


/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */
