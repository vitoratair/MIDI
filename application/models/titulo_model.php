<?php


class Titulo_model extends CI_Model {


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
		return $this->db->insert('Categoria', $data);
	}


	/**
	 * Busca uma categoria
	 */
	function buscar($id)
	{
		$this->db->select('*');
		$this->db->from('Categoria');
		$this->db->where('CID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Update da categoria no banco
	 */
	public function updateCategoria($data)
	{
		$id 		= $data['CID'];
		$categoria 	= $data['CNome'];

		$this->db->query("UPDATE Categoria SET CNome = '$categoria' WHERE CID  = '$id'");
	}
	
	/**
	 * Lista dados
	 */
	function listar()
	{
		//lista somente os ativos

		$this->db->select('*');
		$this->db->from('Titulo');
		$query = $this->db->get();

		return $query->result();
	}


	function updateCategoriaForNcm($data,$id)
	{

		$this->db->query("UPDATE `$data` SET Categoria = 1, Marca = 1, Modelo = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria  = '$id'");
	}

	/**
	 * Deleta a referencia da categoria da tabela Modelo e NCM_has_categoria todas as NCMs do sistema
	 */	
	function updateCategoriaForDelete($id)
	{
		$this->db->query("UPDATE Modelo SET Categoria_CID = 1, Marca_MAID = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria_CID  = '$id'");


		$this->db->query("DELETE FROM NCM_has_Categoria WHERE Categoria_CID = '$id'");

	}

	/**
	 * Deletar a categoria do sistema
	 */
	function deleteCategoria($id)
	{
		$this->db->query("DELETE FROM Categoria WHERE CID = '$id'");
	}


	/**
	 * Deletar a associação da categoria com NCM
	 */
	function deleteAssociacaoCategoria($id)
	{
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE Categoria_CID = '$id'");
	}

	/**
	 * Criar a associação da categoria com NCM
	 */
	function criarAssociacaoCategoria($data,$id)
	{
		$query = mysql_query("INSERT INTO `NCM_has_Categoria` (`NCM_NID`, `Categoria_CID`) VALUES ('$data','$id')");
	}


	/**
	 * Retorna o nome da categoria pelo ID
	 */
	public function getCategoria($id)
	{
		
		$this->db->select('CNome');
		$this->db->from('Categoria');
		$this->db->where('CID',$id);
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Retorna todas as NCMs cadastradas no sistema
	 */
	public function getNcmCadastradas()
	{
		
		$this->db->select('*');
		$this->db->from('NCM');
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Retorna todas as NCMs do sistema
	 */
	public function getAllNcm()
	{
		$query = $this->db->query("SHOW OPEN TABLES FROM `marketips` WHERE `Table` REGEXP \"^.{8}_.{4}$\"");
		return $query->result();
	}

	/**
	 * Retorna todas as NCMs de uma categoria
	 */
	public function getNCM($id)
	{

		$query = $this->db->query("SELECT ncm.NID, Categoria_CID FROM `NCM_has_Categoria` AS `ncmCat` JOIN `NCM` AS `ncm` ON ncmCat.Categoria_CID = '$id' AND ncmCat.NCM_NID = ncm.NID");
		return $query->result();
	}



}
