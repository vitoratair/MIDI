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

		$this->db->select('*');
		$this->db->from('NCM');
		$this->db->order_by('NNome');
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista anos
	 */
	function listarAno()
	{

		$this->db->select('*');
		$this->db->from('Ano');
		$this->db->order_by('AAno');
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

	/**
	 * Busca dados somente com NCM e ano
	 */
	function buscaDados($limit, $start, $table, $id, $marca)
	{
		
		if ($id == 1)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();			
		}
		elseif($id == 2)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->where('Marca',$marca);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}

	}

	/**
	 * COUNT dos dados
	 */
	function countBuscaDados($table,$id,$marca)
	{
		if($id == 1)
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();			
		}
		elseif ($id == 2) // marca
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->where('Marca',$marca);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();			
		}

	}	



}
