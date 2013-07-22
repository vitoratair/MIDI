<?php


class Analise_model extends CI_Model {


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
	 * Calcula as unidades referente a uma NCM //
	 */
	function calcUnidadesByModelo($table, $modelo)
	{

		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->from($table);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();

		return $query->result();

	}

	/**
	 * Calcula o volume referente a uma NCM //
	 */
	function calcVolumeByModelo($table, $modelo)
	{

		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();

		return $query->result();

	}		


}

?>