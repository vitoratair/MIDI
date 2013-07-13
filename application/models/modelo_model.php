<?php


class Modelo_model extends CI_Model {


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
	 * Lista de modelos
	 */

	function listarModelo()
	{

		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista de modelos na categoria selecionada
	 */

	function listarModeloByCategoria($id)
	{


		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$id);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		$query = $this->db->get();

		return $query->result();
	}


	/**
	 * Verficar se um modelo foi encontrado no sistema ou não
	 */
	function verificarCadastro($id,$table,$modelo)
	{

		$this->db->select('COUNT(`IDN`) AS IDN');
		$this->db->FROM($table);
		$this->db->where('Categoria',$id);
		$this->db->where('Modelo',$modelo);

		$query = $this->db->get();

		return $query->result();

	}

	/**
	 * Busca de todas as NCMs cadastradas no sistema
	 */
	function buscaNcm()
	{
		$query = $this->db->query("SHOW OPEN TABLES FROM `marketips` WHERE `Table` REGEXP \"^.{8}_.{4}$\"");
		return $query->result();
	}	
	
	/**
	 * Busca informações sobre um determinado modelo
	 */
	function bucaModelo($id)
	{

		$this->db->select('*');
		$this->db->FROM('Modelo');
		$this->db->where('MOID',$id);
	
		$this->db->join('Marca','MAID = Marca_MAID');

		$query = $this->db->get();

		return $query->result();		

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


}
