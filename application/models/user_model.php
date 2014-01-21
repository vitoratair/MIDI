<?php

class User_model extends CI_Model
{
	
	function __construct() 
	{
		parent::__construct();
	}

	// Valida o usuário //
	function validate()
	{
	
		 $this->db->where('usuarioLogin', $this->input->post('login'));
		 $this->db->where('usuarioPassword',$this->input->post('password'));
		 $query = $this->db->get('Usuario');

		 if ($query->num_rows == 1)
		 {
		 	return $query->result();
		 }
	}	

	// Busca todas as informações do usuário pelo seu login //
	function getUserByLogin($login)
	{
		
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where('usuarioLogin',$login);
		$this->db->join('Tipo','Tipo.tipoID = Usuario.tipoID');
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna a lista de usuários cadastrados no sistema //
	function listUser() 
	{	
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->order_by('usuarioNome', 'asc');
		$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
		$this->db->join('Tipo', 'Usuario.tipoID = Tipo.tipoID');
		$this->db->join('Unidade', 'Usuario.unidadeID = Unidade.unidadeID');
		$query = $this->db->get();

		return $query->result();
	}

	// Exclui usuário do sistema //
    function delete($id)
    {
	    $this->db->where('usuarioID', $id);
	    $this->db->delete('Usuario');
	}	

	// Lista as profissiões cadastradas //
	function listProfession()
	{
		$this->db->select('*');
		$this->db->from('Cargo');
		$this->db->order_by('cargoNome');
		$query = $this->db->get();

		return $query->result();	
	}

	// Lista os setores //
	function listDepartment()
	{
		$this->db->select('*');
		$this->db->from('Unidade');
		$this->db->order_by('unidadeNome');
		$query = $this->db->get();

		return $query->result();		
	}

	// Lista os tipos de usuários possíveis para acessar o sistema //
	function listTypeUser()
	{
		$this->db->select('*');
		$this->db->from('Tipo');
		$this->db->order_by('tipoNome');
		$query = $this->db->get();
		
		return $query->result();		
	}

	// Insere usuário no banco de dados //
	function save($data) 
	{
		return $this->db->insert('Usuario', $data);
	}

	// Busca informações de usuários pelo seu ID //
	function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from('Usuario');
		$this->db->where('usuarioID', $id);
		$this->db->join('Cargo', 'Usuario.cargoID = Cargo.cargoID');
		$this->db->join('Tipo', 'Usuario.tipoID = Tipo.tipoID');
		$this->db->join('Unidade', 'Usuario.unidadeID = Unidade.unidadeID');

		$this->db->limit(1);
		$query = $this->db->get();
	
		return $query->result();
	}

	// Update de usuário //
	function updateUser($id, $data) 
	{		
		return $this->db->update('Usuario', $data, "usuarioID = $id");
	}	
	
	// Verifica se a senha do usuário foi digitada corretamente //
	function checkPassword($id, $password)
	{
			
		$this->db->select('usuarioID');
		$this->db->from('Usuario');
		$this->db->where('usuarioID', $id);
		$this->db->where('usuarioPassword', $password);
		$query = $this->db->get();
		
		// $query = $this->db->query("SELECT * FROM Usuario U where U.usuarioID = '$id' AND U.usuarioPassword = BINARY '$password' ");
		
		if ($query->num_rows == 1)
		{
		 	return TRUE;
		}
		return FALSE;
	}


}

?>