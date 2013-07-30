<?php


class Requisicoes_model extends CI_Model {


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
	 * Busca todas as requisições
	 */
	function buscar()
	{

		$this->db->select('*');
		$this->db->from('Request');
		$this->db->order_by('RequestID');
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Atualiza um requisição
	 */
	function update($table, $idn, $categoria, $marca, $modelo)
	{

		$this->db->query("UPDATE $table SET Categoria = '$categoria', Marca = '$marca', Modelo = '$modelo' WHERE IDN = '$idn'");
	
	}

	/**
	 * Atualiza um requisição
	 */
	function delete($id)
	{

		$this->db->where('RequestID',$id);
		$this->db->delete('Request');
	
	}

}


?>