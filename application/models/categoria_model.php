<?php


class Categoria_model extends CI_Model {


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
	  * Insere o item da subcategoria 
	  */ 
	function cadastrarItem($table,$data) 
	{		
		return $this->db->insert($table, $data);
	}
	
	/**
	  * update de um item
	  */ 
	function updateItem($table,$data) 
	{		
		$id = $data['SCID'];
		$this->db->where('SCID', $id);
		$this->db->update($table, $data);
	}	

	/**
	  * Insere subcategoria 
	  */ 
	function cadastrarSubcategoria($data) 
	{
		return $this->db->insert('Titulo', $data);
	}	

	/**
	 * Update da subcategoria no banco
	 */
	public function cadastrarSubcategoriaUpdate($data,$id)
	{
		$this->db->where('TID', $id);
		$this->db->update('Titulo', $data); 
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
	 * Busca uma subcategoria
	 */
	function buscaSubcategoria($id)
	{
		$this->db->select('TID,TNome,Categoria_CID,TColuna');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Busca um item
	 */
	function buscaItem($table,$id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('SCID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Verifica se existe uma índice para um categoria selecionada
	 */
	function verficarIndice($data)
	{
		$indice 	= $data['TColuna'];
		$categoria 	= $data['Categoria_CID'];

		$this->db->select('TID');
		$this->db->from('Titulo');
		$this->db->where("TColuna = '$indice' AND Categoria_CID = '$categoria'");

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
	 * Lista categorias
	 */
	function listar()
	{

		$this->db->select('*');
		$this->db->from('Categoria');
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Lista itens da subcategoria
	 */
	function listaItens($table,$categoria)
	{
		
		$this->db->select('SCID,SCNome');
		$this->db->from($table);
		$this->db->where('Categoria_CID',$categoria);

		$query = $this->db->get();

		return $query->result();
	}	

	/**
	 * busca itens de um modelo
	 */
	function getItensByID($coluna, $id)
	{
		$table = "SubCategoria".$coluna."";
		$this->db->select('SCNome');
		$this->db->from($table);
		$this->db->where('SCID', $id);
		$this->db->limit('1');
		
		$query = $this->db->get();
		$query = $query->result();

		return $query[0]->SCNome;

	}		

	/**
	 * Lista itens das subcategoria de uma modelo
	 */
	function listarSubcategoriasModelo($modelo,$id)
	{
		
		$coluna = "SubCategoria".$id."_SCID";

		$this->db->select($coluna);
		$this->db->from('Modelo');
		$this->db->where('MOID',$modelo);
		$query = $this->db->get();

		$query = $query->result();
		return $query[0]->$coluna;
		// return $query->result();
	}

	/**
	 * Lista itens das subcategoria sem modelo
	 */
	function listarSubcategoriasNcm($table, $id, $idn)
	{
		
		$coluna = "SubCategoria".$id."_SCID";
		$this->db->select($coluna);
		$this->db->from($table);
		$this->db->where('IDN',$idn);
		$query = $this->db->get();
		$query = $query->result();
		
		return $query[0]->$coluna;
	}	

	/**
	 * Lista subcategorias
	 */
	function listarTitulos($id)
	{
		$this->db->select('TID,TNome,TColuna,Categoria_CID');
		$this->db->from('Titulo');
		$this->db->where('Categoria_CID',$id);
		$this->db->order_by("TColuna", "asc");
		$query = $this->db->get();

		return $query->result();
	}	

	/**
	 * Pegar o indice de coluna desejado
	 */
	function getIndice($id)
	{
		$this->db->select('TColuna');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();

		return $query->result();
	}	

	/**
	 * Deleta a referencia da categoria das tabelas NCMs
	 */
	function updateCategoriaForNcm($data,$id)
	{

		$this->db->query("UPDATE `$data` SET Categoria = 1, Marca = 1, Modelo = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria  = '$id'");
	}

	/**
	 * Deleta a referencia da categoria das tabelas NCMs
	 */
	function updateItemForNcm($data,$id,$table,$categoria)
	{
		$this->db->query("UPDATE `$data` SET `$table` = 1 WHERE Categoria  = '$categoria' AND `$table` = $id");
	}


	/**
	 * Deleta a referencia do item da tabela modelo
	 */
	function updateItemForModelo($id,$categoria,$table)
	{
		$this->db->query("UPDATE `Modelo` SET `$table` = 1 WHERE Categoria_CID  = '$categoria' AND `$table` = $id");
	}

	/**
	 * Deleta o item
	 */
	function deleteItem($id,$table)
	{
		$this->db->where('SCID',$id);
		$this->db->delete($table);
	}
	
	/**
	 * Deleta a referencia da categoria das tabelas NCMs
	 */
	function updateSubcategoriaForNcm($data,$colunaID,$id)
	{
		$colunaNome = "SubCategoria".$colunaID."_SCID";
		
		$this->db->query("UPDATE `$data` SET  `$colunaNome` = 1 WHERE `$colunaNome`  = '$id' AND Categoria = 3");
	}

	/**
	 * Deleta a referencia da categoria da tabela Modelo e NCM_has_categoria todas as NCMs do sistema
	 */	
	function updateCategoriaForDelete($id)
	{
		// deletando referencia a categoria da tabela modelo
		$this->db->query("UPDATE Modelo SET Categoria_CID = 1, Marca_MAID = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria_CID  = '$id'");

		// deletando referencia da categoria da tabela NCM_has_Categoria
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE Categoria_CID = '$id'");

		// deletando referencia da categoria da título NCM_has_Categoria
		$this->db->query("DELETE FROM Titulo WHERE Categoria_CID = '$id'");		

	}

	/**
	 * Deleta a referencia da categoria das tabelas subcategorias
	 */	
	function deleteSubcategoriaByCategoria($id)
	{
		// deletando referencia da categoria das tabelas SubCategorias NCM_has_Categoria
		$this->db->query("DELETE FROM SubCategoria1 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria2 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria3 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria4 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria5 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria6 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria7 WHERE Categoria_CID = '$id'");
		$this->db->query("DELETE FROM SubCategoria8 WHERE Categoria_CID = '$id'");		

	}

	/**
	 * Deleta a referencia da subcategoria da tabela Titulo
	 */	
	function deleteSubcategoria($id)
	{
		$this->db->where('TID', $id);
		$this->db->delete('Titulo');
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
	 * Retorna o nome da categoria pelo ID
	 */
	public function getCategoriaByTitulo($id)
	{
		
		$this->db->select('Categoria_CID');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Retorna o categoria da idn 
	 */
	public function getCategoriaNcm($table, $idn)
	{
		
		$this->db->select('Categoria');
		$this->db->from($table);
		$this->db->where('IDN',$idn);
		$this->db->limit(1);
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
