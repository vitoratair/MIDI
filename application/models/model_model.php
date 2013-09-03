<?php


class Model_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	// Lista os modelos da marca e categoria //
	function getModelByBrand($marca, $categoria)
	{		
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID', $marca);

		if (!empty($categoria))
		{
			$this->db->where('Categoria_CID',$categoria);			
		}
		
		$query = $this->db->get();		
		return $query->result();
	}	

	// Retorna itens das subcategoria de uma modelo
	function listSubcategoryModel($modelo,$id)
	{
		
		$coluna = "SubCategoria".$id."_SCID";
		$this->db->select($coluna);
		$this->db->from('Modelo');
		$this->db->where('MOID',$modelo);
		$query = $this->db->get();

		$query = $query->result();
		return $query[0]->$coluna;
	}

	// Retorna o número de modelos cadastrados //
	function countModel()
	{
		return $this->db->count_all('Modelo');
	}

	// Lista os modelos cadastrados utilizando paginação //
	function listModel($limit, $start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna uma lista de modelos referente a uma pesquisa //
	function listModelSearch($search)
	{
		$this->db->select('*');
		$this->db->from('Modelo');		
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$this->db->like('MNome',$search);
		$query = $this->db->get();

		return $query->result();
	}	

	// Verficar se um modelo foi encontrado no sistema //
	function findModel($table, $modelo)
	{
		$this->db->select('COUNT(`IDN`) AS IDN');
		$this->db->FROM($table);
		$this->db->where('Modelo',$modelo);
		$query = $this->db->get();

		return $query->result();
	}	

	// Retorna o número de modelos de uma determinada categoria //
	function countModelByCategory($categoria)
	{
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$categoria);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		return $this->db->count_all_results();
	}	

	// Retorna a lista de modelos de uma determinada categoria //
	function listModelByCategory($limit, $start, $categoria)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->where('Categoria_CID', $categoria);
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna o número de modelos de uma determinada marca e categoria //
	function countModelByBrandAndCategory($marca, $categoria)
	{
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$marca);
		$this->db->where('Categoria_CID',$categoria);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		return $this->db->count_all_results();
	}

	// Retorna a lista de modelos de uma determinada marca e categoria //
	function listModelByBrandAndCategory($limit, $start, $marca, $categoria)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->where('Marca_MAID', $marca);
		$this->db->where('Categoria_CID', $categoria);
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		$query = $this->db->get();

		return $query->result();
	}

	// Retorna o número de modelos de uma determinada marca //
	function countModelByBrand($id)
	{
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$id);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		return $this->db->count_all_results();
	}

	// Retorna a lista de modelos de uma determinada marca //
	function listModelByBrand($limit, $start, $marca)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->where('Marca_MAID', $marca);
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna todas as informações de um modelo //
	function getModel($id)
	{
		$this->db->select('*');
		$this->db->FROM('Modelo');
		$this->db->where('MOID',$id);
		$this->db->join('Marca','MAID = Marca_MAID');
		$query = $this->db->get();

		return $query->result();
	}	

	// Update de um modelo //
	function updateModel($data) 
	{				
		$id = $data['MOID'];
		$this->db->where('MOID', $id);
		$this->db->update('Modelo', $data);
	}

	// Deleta o modelo //
	function delete($id)
	{
		$this->db->where('MOID',$id);
		$this->db->delete('Modelo');
	}	

	// Retorna  o próximo ID da tabela modelo //
	function getNextID()
	{		
		$query = $this->db->query("SHOW TABLE STATUS LIKE 'Modelo'");
		
		return $query->result();	
	}
	
	// Insere o modelo no banco //
	function save($data) 
	{		
		return $this->db->insert('Modelo', $data);
	}	

	// Lista todos os modelos //
	function listAllModel()
	{	
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');
		$this->db->where('MOID !=', '1');
		$query = $this->db->get();

		return $query->result();	
	}

	// Retorna a lista de modelos de uma categoria e subcategorias //
	function listAllModelByCategory($categoria, $subcategoria)
	{
		$this->db->select('DISTINCT(`MOID`)');
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$categoria);
		
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

	// Retorna a soma de todas as importações de um modelos dentro de uma NCM //
	function calcPartsByModel($table, $modelo)
	{
		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->from($table);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();			
	
		return $query->result();
	}

	// Calcula o volume referente a uma NCM //
	function calcCashByModel($table, $modelo)
	{	
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where_in('Modelo',$modelo);
		$query = $this->db->get();
		
		return $query->result();
	}		


	// Retorna a lista de todos modelos de uma determinada marca //
	function listAllModelByBrand($categoria, $subcategoria, $marca)
	{
		$this->db->select('DISTINCT(`MOID`)');
		$this->db->from('Modelo');
		$this->db->where('Categoria_CID',$categoria);
		$this->db->where('Marca_MAID',$marca);
		
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