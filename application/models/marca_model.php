<?php


class Marca_model extends CI_Model {


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
	 * Lista de marcas
	 */

	function listarMarca()
	{

		$this->db->select('*');
		$this->db->from('Marca');
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista uma marca
	 */

	function buscaMarca($id)
	{

		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->where('MAID',$id);
		$query = $this->db->get();

		return $query->result();
	}	


	/**
	  * Insere marca 
	  */ 
	function cadastrar($data) 
	{		
		return $this->db->insert('Marca', $data);
	}	

	/**
	  * update de uma marca
	  */ 
	function updateMarca($data) 
	{		
		$id = $data['MAID'];

		$this->db->where('MAID', $id);
		$this->db->update('Marca', $data);
	}	

	/**
	 * Deleta a referencia da marca das tabelas NCMs
	 */
	function updateMarcaForNcm($data,$id)
	{
		$this->db->query("UPDATE `$data` SET Marca = 1, Modelo = 1 WHERE Marca  = '$id'");
	}

	/**
	 * Deleta a referencia da marca da tabela Modelo
	 */
	function updateModelo($id)
	{
		$this->db->query("UPDATE `Modelo` SET Marca_MAID = 1 WHERE Marca_MAID  = '$id'");
	}	
	
	/**
	 * Deleta a marca
	 */
	function deleteMarca($id)
	{
		$this->db->query("DELETE FROM `Marca` WHERE MAID = '$id'");
	}	





}
