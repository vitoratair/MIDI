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
		if (!empty($modelo))
		{
			$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			$this->db->from($table);
			$this->db->where_in('Modelo',$modelo);
			$query = $this->db->get();			
			return $query->result();
		}
		
	}

	/**
	 * Calcula o volume referente a uma NCM //
	 */
	function calcVolumeByModelo($table, $modelo)
	{

		if (!empty($modelo))
		{		
			$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
			$this->db->from($table);
			$this->db->where_in('Modelo',$modelo);
			$query = $this->db->get();
			return $query->result();
		}
		
	}	

	/**
	 * Calcula o peças referente a uma NCM e um modelo //
	 */
	function calcAnoByModelo($table, $modelo, $categoria)
	{

		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->select_sum('VALOR_UNIDADE_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where('Modelo',$modelo);
		$this->db->where('Categoria', $categoria);
		$query = $this->db->get();

		return $query->result();

	}

	/**
	 * Calcula o peças referente a uma NCM //
	 */
	function calcUnidadesAnoByMarca($table, $marca, $categoria, $modelo)
	{

		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->from($table);
		$this->db->where('Marca',$marca);
		$this->db->where('Categoria', $categoria);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();

		return $query->result();

	}

	/**
	 * Calcula o volume referente a uma NCM //
	 */
	function calcVolumeAnoByMarca($table, $marca, $categoria, $modelo)
	{

		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where('Marca',$marca);
		$this->db->where('Categoria',$categoria);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();

		return $query->result();
	}				

	/**
	 * Busca as informações de outros 
	 */
	function getOutrosByMarca($table, $categoria, $subcategoria, $marca)
	{
		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where('Categoria',$categoria);
		$this->db->where('Marca',$marca);
		$this->db->where('Modelo','1');
		$this->db->where('Marca','1');
		
		foreach ($subcategoria as $key => $value)
		{
			$coluna = "SubCategoria". ($key + 1) ."_SCID";
			if (!empty($value) && ($value != 'false'))
			{
				$this->db->where($coluna,$value);
			}
		}
				
		$query = $this->db->get();

	
		return $query->result();
	}

	/**
	 * Busca as informações de outros 
	 */
	function getOutrosByAno($table, $categoria, $subcategoria)
	{
		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where('Categoria',$categoria);
		$this->db->where('Modelo','1');
		$this->db->where('Marca','1');
		
		foreach ($subcategoria as $key => $value)
		{
			$coluna = "SubCategoria". ($key + 1) ."_SCID";
			if (!empty($value) && ($value != 'false'))
			{
				$this->db->where($coluna,$value);
			}
		}
				
		$query = $this->db->get();

	
		return $query->result();
	}	



}

?>