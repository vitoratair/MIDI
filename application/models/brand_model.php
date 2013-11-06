<?php


class Brand_model extends CI_Model
{

	// Inicia construtor do model //
	function __construct()
	{
		parent::__construct();
	}

	// Lista de todas as marcas //
	function listAllBrand()
	{
		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->order_by('MANome');
		$query = $this->db->get();

		return $query->result();
	}

	// Conta o número de marcas cadastradas //
	function countBrand()
	{
		return $this->db->count_all('Marca');
	}

	// Retorna a lista de marcas com limit para paginação //
	function listBrand($limit,$start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->where('MAID != 1');
		$query = $this->db->get();

		return $query->result();
	}	

	// Retorna uma lista de marca com like em uma string //
	function listBrandBySearch($search, $limit, $start)
	{		
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->like('MANome',$search);
		$query = $this->db->get();

		return $query->result();
	}

	// Count marcas com like em uma string //
	function countBrandSearch($search)
	{				
		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->like('MANome',$search);

		return $this->db->count_all_results();
	}		

	// Insere marca no banco //
	function save($data) 
	{		
		return $this->db->insert('Marca', $data);
	}		

	// Deleta a referência da marca da tabela Modelo //
	function deleteBrandModel($id)
	{
		$this->db->query("UPDATE `Modelo` SET Marca_MAID = 1 WHERE Marca_MAID  = '$id'");
	}	
	
	// Deleta a referência da marca das tabelas NCMs //
	function deleteBrandNcm($data,$id)
	{
		$this->db->query("UPDATE `$data` SET Marca = 1, Modelo = 1 WHERE Marca  = '$id'");
	}

	// Deleta a marca //
	function deleteBrand($id)
	{
		$this->db->query("DELETE FROM `Marca` WHERE MAID = '$id'");
	}
	
	// Retorna informações de uma marca //
	function getBrand($id)
	{
		$this->db->select('*');
		$this->db->from('Marca');
		$this->db->where('MAID',$id);
		$query = $this->db->get();

		return $query->result();
	}

	// update de uma marca //
	function updateBrand($data) 
	{		
		$id = $data['MAID'];
		$this->db->where('MAID', $id);
		$this->db->update('Marca', $data);
	}	

	// Retorna a marca de um modelo //
	function getBrandByModel($id)
	{
		$this->db->select('MAID, MANome');
		$this->db->FROM('Marca');
		$this->db->join('Modelo','MAID = Marca_MAID');
		$this->db->where('MOID',$id);
		$query = $this->db->get();

		return $query->result();		
	}	

	// Retorna todas as marcas com um array de modelos //
	function listBrandByArrayModel($table, $modelos)
	{
		$this->db->select('DISTINCT(`Marca`)');
		$this->db->select('MANome');
		$this->db->from($table);
		$this->db->join('Marca','Marca = MAID');
		$this->db->where_in('Modelo', $modelos);
		$query = $this->db->get();
		
		return $query->result();
	}

	// Retorna todas as marcas com uma NCM //
	function listBrandByNcm($table)
	{
		$this->db->select('DISTINCT(`Marca`)');
		$this->db->select('MANome');
		$this->db->from($table);
		$this->db->join('Marca','Marca = MAID');
		$this->db->where('MAID != 1');
		$query = $this->db->get();
		
		return $query->result();
	}

	// Retorna as peças importadas de uma marca //
	function sumPartsYearByBrand($table, $marca, $categoria, $dataInicial, $dataFinal)
	{
		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->from($table);		
		$this->db->where('Categoria', $categoria);	
		$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");		
		$this->db->where_in('Marca',$marca);
		$query = $this->db->get();

		return $query->result();

	}

	// Retorna o volu financeiro $$$ de importações feita por uma marca //
	function sumCashYearByBrand($table, $marca, $categoria, $dataInicial, $dataFinal)
	{
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);		
		$this->db->where('Categoria',$categoria);
		$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");
		$this->db->where_in('Marca',$marca);
		$query = $this->db->get();

		return $query->result();
	}

}

?>