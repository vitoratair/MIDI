<?php

class Tipo_model extends CI_Model {
	
	
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
		return $this->db->insert('Tipo', $data);
	}


	/**
	 * Lista dados
	 */
	function listar() 
	{
		$this->db->select('*');
		$this->db->from('Tipo');
		$query = $this->db->get();
		
		return $query->result();
	}

	
	/**
	 * Busca permissao
	 */
	function buscar($id2)
	{
		$query = $this->db->query("SELECT tipoNome FROM Tipo WHERE tipoID = '$id2' LIMIT 1");
	
		//print_($query);
		
		return $query->result();
	}
	

	/**
	 * Procura e deleta na BD
	 */
    function deletar($id)
    {
	    $this->db->where('tipoID', $id);
	    $this->db->delete('Tipo');

	}
}

?>
