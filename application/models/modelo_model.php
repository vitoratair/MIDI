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
	 * Count modelo
	 */

	function countModelo()
	{
		return $this->db->count_all('Modelo');
	}	

	/**
	 * Lista de modelos
	 */
	function listarModelo($limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista de modelos pesquisa
	 */
	function listarModeloPesquisa($search)
	{
		$this->db->select('*');
		$this->db->from('Modelo');		
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$this->db->like('MNome',$search);

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista de modelos na categoria selecionada
	 */
	function listarModeloByCategoria($limit,$start,$id)
	{

		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$id);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista os modelos da marca e categoria
	 */
	function buscaModeloByMarca($id, $categoria)
	{

		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$id);
		$this->db->where('Categoria_CID',$categoria);
		$query = $this->db->get();

		return $query->result();
	}	

	/**
	 * count de modelos na categoria selecionada
	 */
	function countModeloByCategoria($id)
	{
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$id);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		return $this->db->count_all_results();
	}	


	/**
	 * Verficar se um modelo foi encontrado no sistema ou não
	 */
	function verificarCadastro($table,$modelo)
	{

		$this->db->select('COUNT(`IDN`) AS IDN');
		$this->db->FROM($table);
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
	  * Insere modelo 
	  */ 
	function cadastrar($data) 
	{		
		return $this->db->insert('Modelo', $data);
	}	

}
