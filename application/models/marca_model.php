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





}
