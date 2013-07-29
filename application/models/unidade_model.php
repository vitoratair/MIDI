<?php

class Unidade_model extends CI_Model {


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
	 * Insere
	 */
	function cadastrar($data)
	{
		return $this->db->insert('Unidade', $data);
	}


	/**
	 * Lista dados
	 */
	function listar($opcao)
	{
		//lista somente os ativos
		if($opcao == 2)
		{
			$this->db->select('*');
			$this->db->from('Unidade');
			$this->db->where('unidadeAtivo', 'SIM');
			$query = $this->db->get();
		}
		//lista somente os inativos
		elseif($opcao == 1)
		{
			$this->db->select('*');
			$this->db->from('Unidade');
			$this->db->where('unidadeAtivo', 'NÃO');
			$query = $this->db->get();
		}
		//lista todos (ativos + inativos)
		else
		{
			$this->db->select('*');
			$this->db->from('Unidade');
			$query = $this->db->get();
		}
		return $query->result();
	}


	/**
	 * Busca unidade
	 */
	function buscar($id)
	{
		$query = $this->db->query("SELECT unidadeID, unidadeNome, unidadeAtivo FROM Unidade WHERE unidadeID = '$id' LIMIT 1");

		return $query->result();
	}


	/**
	 * Edita
	 */
	function editar($data)
	{
	 $id 		= $data['unidadeID'];

	 $nome 		= $data['unidadeNome'];
	 
	 $ativo		= $data['unidadeAtivo'];

	 $query = $this->db->query("UPDATE Unidade SET UnidadeNome='$nome', unidadeAtivo='$ativo' 
	 		WHERE unidadeID='$id'");
	 	
	}

	/**
	 * Procura e deleta na BD
	 */
	function deletar($id)
	{
		$ativo		= 'NÃO';

		$query = $this->db->query("UPDATE Unidade SET unidadeAtivo='$ativo' WHERE unidadeID='$id'");
	
	}
}
