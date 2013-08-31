<?php

class Category_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	// // Lista todas as categorias cadastradas //
	function listCategory()
	{
		$this->db->select('*');
		$this->db->from('Categoria');
		$query = $this->db->get();

		return $query->result();
	}	

	// Insere uma categoria no banco //
	function save($data) 
	{		
		return $this->db->insert('Categoria', $data);
	}

	// Busca uma categoria no banco //
	function getCategory($id)
	{
		$this->db->select('*');
		$this->db->from('Categoria');
		$this->db->where('CID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	// Atualiza uma categoria no banco //
	public function updateCategory($data)
	{
		$this->db->where('CID', $data['CID']);
		$this->db->update('Categoria', $data);
	}

	// Deleta a referência da categoria nas tabelas modelo, ncm_has_categoria, titulo e subcategorias //
	function deleteReference($id)
	{
		// deletando referencia a categoria da tabela modelo
		$this->db->query("UPDATE Modelo SET Categoria_CID = 1, Marca_MAID = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria_CID  = '$id'");

		// Deletando referência da categoria da tabela NCM_has_Categoria
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE Categoria_CID = '$id'");

		// Deletando referência da categoria da tabela título //
		$this->db->query("DELETE FROM Titulo WHERE Categoria_CID = '$id'");				
	}

	// Deleta a categoria do sistema //
	function deleteCategory($id)
	{
		$this->db->query("DELETE FROM Categoria WHERE CID = '$id'");
	}

	// Lista todas as NCMs de uma categoria //
	function listNcmByCategory($id)
	{
		$query = $this->db->query("SELECT ncm.NID, Categoria_CID FROM `NCM_has_Categoria` AS `ncmCat` JOIN `NCM` AS `ncm` ON ncmCat.Categoria_CID = '$id' AND ncmCat.NCM_NID = ncm.NID");
		return $query->result();
	}	

	// Deleta a assosiação de uma categoria com uma NCM //
	function deleteConnectionNcmCategory($id)
	{
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE Categoria_CID = '$id'");
	}

	// Cria a associação de uma categoria com NCMs //
	function createConnectionNcmCategory($data, $id)
	{
		$query = mysql_query("INSERT INTO `NCM_has_Categoria` (`NCM_NID`, `Categoria_CID`) VALUES ('$data','$id')");
	}	

	// Lista as subcategorias de uma categoria //
	function listTitle($id)
	{
		$this->db->select('TID,TNome,TColuna,Categoria_CID');
		$this->db->from('Titulo');
		$this->db->where('Categoria_CID',$id);
		$this->db->order_by("TColuna", "asc");
		$query = $this->db->get();

		return $query->result();
	}	

	// Busca uma subcategoria //
	function getTitle($id)
	{
		$this->db->select('TID, TNome, Categoria_CID, TColuna');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	// Update da subcategoria no banco //
	public function updateTitle($data, $id)
	{
		$this->db->where('TID', $id);
		$this->db->update('Titulo', $data); 
	}

	// Verifica se existe um índice para a categoria selecionada //
	function checkID($data)
	{
		$indice 	= $data['TColuna'];
		$categoria 	= $data['Categoria_CID'];

		$this->db->select('TID');
		$this->db->from('Titulo');
		$this->db->where("TColuna = '$indice' AND Categoria_CID = '$categoria'");
		$query = $this->db->get();
		
		return $query->result();	
	}

	// Insere um nova subcategoria no banco //
	function setTitle($data) 
	{
		return $this->db->insert('Titulo', $data);
	}

	// Pegar o índice da coluna desejada //
	function getIndice($id)
	{
		$this->db->select('TColuna');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna o nome da categoria pelo ID //
	public function getCategoryByTitle($id)
	{		
		$this->db->select('Categoria_CID');
		$this->db->from('Titulo');
		$this->db->where('TID',$id);
		$query = $this->db->get();

		return $query->result();
	}	

	// Deleta a referência da categoria nas tabelas de subcategorias //
	function deletesubcategoryByCategory($id)
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

	// Deleta a referência da subcategoria da tabela Titulo //
	function deleteTitle($id)
	{
		$this->db->where('TID', $id);
		$this->db->delete('Titulo');
	}

	// Lista itens da subcategoria //
	function listElement($table, $categoria)
	{		
		$this->db->select('SCID,SCNome');
		$this->db->from($table);
		$this->db->where('Categoria_CID',$categoria);
		$query = $this->db->get();

		return $query->result();
	}		

	// Retorna o categoria de um modelo //
	public function getCategoryModel($id)
	{		
		$this->db->select('CNome, CID');
		$this->db->from('Categoria');
		$this->db->join('Modelo', 'Categoria_CID = CID');
		$this->db->where('MOID',$id);
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna as subcategorias de um modelo //
	function listTitleByModel($modelo, $id)
	{		
		$coluna = "SubCategoria".$id."_SCID";

		$this->db->select($coluna);
		$this->db->from('Modelo');
		$this->db->where('MOID',$modelo);
		$query = $this->db->get();
		$query = $query->result();

		return $query[0]->$coluna;
	}

	// Retorna os itens de subcategoria de um modelo //
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


}

?>