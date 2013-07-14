<?php

class Usuario_model extends CI_Model {
	
	
	/**
	 * Inicia construtor do model
	 */
	function __construct() 
	{
		parent::__construct();
	}


	function validar()
	{
		 $this->db->where('usuarioLogin', $this->input->post('login'));
		 $this->db->where('usuarioPassword',$this->input->post('password'));
		 $query = $this->db->get('Usuario');

		 if ($query->num_rows == 1)
		 {
		 	return $query->result();
		 }

	}


	/**
	  * Insere usuario no banco de dados
	  */ 
	function cadastrar($data) 
	{
		return $this->db->insert('Usuario', $data);
	}


	/**
	 * Lista usuarios do banco de dados
	 */
	function listar($opcao) 
	{
	//lista somente os ativos
		if($opcao == 2)								
		{
			$this->db->select('*');
			$this->db->from('Usuario');
			$this->db->order_by('usuarioNome', 'asc');				
			$this->db->where('usuarioAtivo', 'SIM');
			$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
			$this->db->join('Departamento', 'Usuario.departamentoID = Departamento.departamentoID');
			$this->db->join('Tipo', 'Usuario.tipoID = Tipo.tipoID');
			$this->db->join('Unidade', 'Departamento.unidadeID = Unidade.unidadeID');
			$query = $this->db->get();			
		}
		//lista somente os inativos
		elseif($opcao == 1)
		{
			$this->db->select('*');
			$this->db->from('Usuario');
			$this->db->order_by('usuarioNome', 'asc');
			$this->db->where('usuarioAtivo', 'NÃO');
			$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
			$this->db->join('Departamento', 'Usuario.departamentoID = Departamento.departamentoID');
			$this->db->join('Tipo', 'Usuario.tipoID = Tipo.tipoID');
			$this->db->join('Unidade', 'Departamento.unidadeID = Unidade.unidadeID');
			$query = $this->db->get();	
		}
		//lista todos (ativos + inativos)
		else 
		{
			$this->db->select('*');
			$this->db->from('Usuario');
			$this->db->order_by('usuarioNome', 'asc');
			$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
			$this->db->join('Departamento', 'Usuario.departamentoID = Departamento.departamentoID');
			$this->db->join('Tipo', 'Usuario.tipoID = Tipo.tipoID');
			$this->db->join('Unidade', 'Departamento.unidadeID = Unidade.unidadeID');
			$query = $this->db->get();
		}

		return $query->result();
	}


	/**
	 * Lista usuarios do banco de dados por tipo
	 */
	function listarPorTipo($id) 
	{
		$this->db->select('*');

		$this->db->from('Usuario');
		
		$this->db->order_by('usuarioNome', 'asc');
		
		$this->db->where('tipoID', $id);
	    
	    $this->db->where('usuarioAtivo', 'SIM'); //somente ativos
	    
		$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
		
		$this->db->join('Departamento', 'Usuario.departamentoID = Departamento.departamentoID');
		
		$this->db->join('Unidade', 'Departamento.unidadeID = Unidade.unidadeID');
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	 * Busca usuario
	 */
	function buscar($id)
	{
		$query = $this->db->query("SELECT usuarioID, usuarioNome, usuarioMatricula, usuarioLogin, usuarioPassword, 
				usuarioEmail, tipoID, departamentoID, usuarioAtivo FROM Usuario WHERE usuarioID = '$id' LIMIT 1");
		
		//$query = $this->db->tipo_model->buscar('tipoID');
	
		return $query->result();
	}
	
	/**
	 * Busca unidade
	 */
	function buscarByLogin($login)
	{
		
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where('usuarioLogin',$login);
		$this->db->join('Tipo','Tipo.tipoID = Usuario.tipoID');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Busca por Email
	 */
	function buscarByEmail($email)
	{
		$this->db->select('*');
		
		$this->db->from('Usuario');

		$this->db->where('usuarioEmail', $email);

		$query = $this->db->get();

		 if ($query->num_rows == 1)
		 {
		 	return $query->result();
		 }
	}


	/**
	 * Busca por departamento
	 */
	function buscarByUsuarioID($departamentoID , $tipoID)
	{
		$this->db->select('usuarioID, usuarioEmail');
		
		$this->db->from('Usuario');

		$this->db->where('departamentoID', $departamentoID);

		$this->db->where('tipoID', $tipoID);

		$query = $this->db->get();

		return $query->result();

	}
	
	
	/**
	 * Edita
	 */
	function atualizaSenha($senha)
	{
		$id 			= $data['usuarioID'];
	
		$query = $this->db->query("UPDATE Usuario SET usuarioPassword='$senha' WHERE unidadeID='$id'");
			
	}
	
	/**
	 * Procura e deleta usuario do BD 
	 */
    function deletar($id)
    {
	    $this->db->where('usuarioID', $id);
	    $this->db->delete('Usuario');

	}

	function getUsuario($id)
	{
		
		$this->db->select('*');

		$this->db->from('Usuario');
		
	    $this->db->where('usuarioID', $id);
		
		$query = $this->db->get();
		
		return $query->result();

	}

	function getPass($id,$password)
	{
			
		$query = $this->db->query("SELECT * FROM Usuario U where U.usuarioID = '$id' AND U.usuarioPassword = BINARY '$password' ");
		
		if ($query->num_rows == 1)
		 {
		 	return TRUE;
		 }
		 return FALSE;

	}


/**
	* Atualiza status da auditoria
	*/ 
	function atualizaUsuario($id, $data) 
	{
		
		return $this->db->update('Usuario', $data, "usuarioID = $id");
	}
	
}