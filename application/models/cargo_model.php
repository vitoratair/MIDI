<?php

class Cargo_model extends CI_Model {
	
	
	/**
	 * Inicia construtor do model
	 */
	function __construct() 
	{
		parent::__construct();
	}


	/**
	  * Insere 
	  */ 
	function cadastrar($data) 
	{
		return $this->db->insert('Cargo', $data);
	}


	/**
	 * Lista dados
	 */
	function listar($opcao)
	{
		//lista somente os ativos
		if($opcao == 2)								
		{
			$this->db->select('*');
			$this->db->from('Cargo');
			$this->db->where('cargoAtivo', 'SIM');
			$query = $this->db->get();			
		}
		//lista somente os inativos
		elseif($opcao == 1)
		{
			$this->db->select('*');
			$this->db->from('Cargo');
			$this->db->where('cargoAtivo', 'NÃO');
			$query = $this->db->get();	
		}
		//lista todos (ativos + inativos)
		else 
		{
			$this->db->select('*');
			$this->db->from('Cargo');
			$query = $this->db->get();
		}
		return $query->result();
	}
	

	/**
	 * Busca um cargo
	 */
	function buscar($id)
	{
		$query = $this->db->query("SELECT cargoID, cargoNome, cargoAtivo FROM Cargo WHERE cargoID = '$id' LIMIT 1");
	
		return $query->result();
	
	}
	
	
	/**
	 * Edita
	 */
	function editar($data)
	{
		$id 			= $data['cargoID'];
	
		$nome 			= $data['cargoNome'];
		
		$ativo			= $data['cargoAtivo'];
	
		$query = $this->db->query("UPDATE Cargo SET cargoNome='$nome', cargoAtivo='$ativo' WHERE cargoID='$id'");
			
	}
	
	
	
	/**
	 * Procura e deleta na BD
	 */
    function deletar($id)
    {
	    //$this->db->where('cargoID', $id);
	    //$this->db->delete('Cargo');
    	$query = $this->db->query("UPDATE Cargo SET cargoAtivo='NÃO' WHERE cargoID='$id'");

	}
}

?>
