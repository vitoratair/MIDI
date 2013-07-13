<?php


class ncm_model extends CI_Model {


	/**
	 * Inicia construtor do model
	 */
	function __construct()
	{
		parent::__construct();
	}


	/**
	 * valida usuario
	 */
	function validar()
	{
		$this->db->where('usuarioLogin', $this->input->post('login'));
		$this->db->where('usuarioPassword',$this->input->post('password'));
		$query = $this->db->get('Usuario');

		if ($query->num_rows == 1)
		{
			return true;
		}

	}


	/**
	  * Insere categoria 
	  */ 
	function cadastrar($data) 
	{
		return $this->db->insert('NCM', $data);
	}


	/**
	 * Busca uma categoria
	 */
	function buscar($id)
	{
		$this->db->select('*');
		$this->db->from('NCM');
		$this->db->where('NID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Update da categoria no banco
	 */
	public function updateNCM($data)
	{
		$id 		= $data['NID'];
		$ncm 		= $data['NNome'];
		$descricao 	= $data['NDescricao'];

		$this->db->query("UPDATE NCM SET NNome = '$ncm', NDescricao = '$descricao' WHERE NID  = '$id'");
	}
	
	/**
	 * Lista dados
	 */
	function listar()
	{
		//lista somente os ativos

		$this->db->select('*');
		$this->db->from('NCM');
		$query = $this->db->get();

		return $query->result();
	}


	/**
	 * Deleta a referencia da categoria da tabela Modelo e NCM_has_categoria todas as NCMs do sistema
	 */	
	function updateNCMForDelete($id)
	{
		
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE NCM_NID = '$id'");
		$this->db->query("DELETE FROM NCM WHERE NID = '$id'");
	}



}
