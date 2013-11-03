<?php


class ncm_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	// Lista todas as NCMs cadastradas no sistema //
	public function listNcm()
	{
		$this->db->select('*');
		$this->db->from('NCM');
		$this->db->order_by('NNome');
		$query = $this->db->get();

		return $query->result();
	}

 	// Lista todos os anos cadastrados no sistema //
	public function listYear()
	{
		$this->db->select('*');
		$this->db->from('Ano');
		$this->db->order_by('AAno');
		$query = $this->db->get();

		return $query->result();
	}

	// Lista os detalhes de importações //
	public function statistics($id, $table, $mes)
	{
		// Retorna o número total de importações
		if ($id == 1)
		{			
			$this->db->where('MES', $mes);
			$this->db->from($table);			
			return $this->db->count_all_results();
		}
		elseif ($id == 2)
		{
			$this->db->where('MES', $mes);			
			$this->db->where('Marca !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}
		elseif ($id == 3)
		{
			$this->db->where('MES', $mes);			
			$this->db->where('Modelo !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}	
		elseif ($id == 4)
		{
			$this->db->where('MES', $mes);			
			$this->db->where('Marca !=', 1);
			$this->db->where('Modelo !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}				
		elseif ($id == 5)
		{
			$this->db->where('MES', $mes);
			$this->db->where('Marca =', 1);
			$this->db->where('Modelo =', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}
		elseif ($id == 6)
		{			
			return $this->db->count_all($table);
		}
		elseif ($id == 7)
		{
			$this->db->where('Marca !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}
		elseif ($id == 8)
		{
			$this->db->where('Modelo !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}	
		elseif ($id == 9)
		{
			$this->db->where('Marca !=', 1);
			$this->db->where('Modelo !=', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}				
		elseif ($id == 10)
		{
			$this->db->where('Marca =', 1);
			$this->db->where('Modelo =', 1);
			$this->db->from($table);			
			return $this->db->count_all_results();			
		}		
		elseif ($id == 11)
		{
			$this->db->select('DISTINCT(`CNome`)');
			$this->db->from($table);
			$this->db->where('CID !=', 1);
			$this->db->join('Categoria', 'Categoria = CID');
			$query = $this->db->get();
			return $query->result();	
		}	
	}	

	// Retorna todas as NCMs do sistema //
	public function listAllNcm()
	{
		$base 	= DATABASE;
		$table 	= TABLE;

		$query = $this->db->query("SHOW TABLES FROM  `$base` WHERE  `$table` REGEXP  \"^.{8}_.{4}$\"");
		return $query->result();
	}	

	// Deleta a referencia da categoria das tabelas NCMs //
	function updateCategoryNcm($data,$id)
	{
		$this->db->query("UPDATE `$data` SET Categoria = 1, Marca = 1, Modelo = 1, SubCategoria1_SCID = 1, 
			SubCategoria2_SCID = 1, SubCategoria3_SCID = 1, SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, 
			SubCategoria6_SCID = 1, SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE Categoria  = '$id'");
	}
	
	// Deleta a referencia da categoria das tabelas de NCMs //
	function updateCategoryNcmByIndice($data, $colunaID, $id)
	{
		$colunaNome = "SubCategoria".$colunaID."_SCID";		
		$this->db->query("UPDATE `$data` SET  `$colunaNome` = 1 WHERE `$colunaNome`  = '$id' AND Categoria = 3");
	}

	// Busca uma ncm //
	function getNcm($id)
	{
		$this->db->select('*');
		$this->db->from('NCM');
		$this->db->where('NID',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}	

	// Atualiza a NCM //
	public function updateNcm($data)
	{
		$id 		= $data['NID'];
		$ncm 		= $data['NNome'];
		$descricao 	= $data['NDescricao'];

		$this->db->query("UPDATE NCM SET NNome = '$ncm', NDescricao = '$descricao' WHERE NID  = '$id'");		
	}	

	// Insere a NCM no banco //
	function save($data) 
	{
		return $this->db->insert('NCM', $data);
	}	
	
	// Deleta a referência da categoria da tabela Modelo e NCM_has_categoria todas as NCMs do sistema //
	function updateNCMForDelete($id)
	{		
		$this->db->query("DELETE FROM NCM_has_Categoria WHERE NCM_NID = '$id'");
		$this->db->query("DELETE FROM NCM WHERE NID = '$id'");
	}

	// COUNT dos dados para paginação //
	function countData($table, $id, $brand, $model, $search, $unSearch, $mes)
	{
		// count total
		if($id == 1) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();			
		}
		// Count com filtro em marcas
		elseif ($id == 2) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->where('Marca',$brand);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();			
		}
		// count por modelos
		elseif ($id == 3) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->where('Marca',$brand);
			$this->db->where('Modelo',$model);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();					
		}
		// count por palavra pesquisada
		elseif ($id == 4) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->like('DESCRICAO_DETALHADA_PRODUTO',$search);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO');
			
			return $this->db->count_all_results();					
		}
		// count por palavra pesquisada  e palavra retirada
		elseif ($id == 5) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->like('DESCRICAO_DETALHADA_PRODUTO', $search);			
			$this->db->not_like('DESCRICAO_DETALHADA_PRODUTO', $unSearch);			
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			
			return $this->db->count_all_results();					
		}
		// count por palavra retirada
		elseif ($id == 6) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->not_like('DESCRICAO_DETALHADA_PRODUTO', $unSearch);			
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			
			return $this->db->count_all_results();					
		}	
		// count por mês
		elseif ($id == 7) 
		{
			$this->db->select('COUNT(`IDN`)');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->where('MES', $mes);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			
			return $this->db->count_all_results();					
		}	
	}

	// Busca os dados de improtações de acordo com os filtros do usuário //
	function getData($limit, $start, $table, $id, $brand, $model, $search, $unSearch, $mes)
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
		// Busca de dados por marcas
		elseif($id == 2)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->where('Marca', $brand);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}
		// Busca de dados por modelos
		elseif($id == 3)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->where('Marca', $brand);
			$this->db->where('Modelo', $model);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}
		elseif ($id == 4)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->like('DESCRICAO_DETALHADA_PRODUTO', $search);			
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();						
		}		
		elseif ($id == 5)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->like('DESCRICAO_DETALHADA_PRODUTO', $search);			
			$this->db->not_like('DESCRICAO_DETALHADA_PRODUTO', $unSearch);			
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}	
		elseif ($id == 6)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->not_like('DESCRICAO_DETALHADA_PRODUTO', $unSearch);			
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}
		elseif ($id == 7)
		{
			$this->db->limit($limit, $start);
			$this->db->select('*');
			$this->db->from($table);
			$this->db->join('Categoria','Categoria.CID = Categoria');
			$this->db->join('Marca','Marca.MAID = Marca');
			$this->db->join('Modelo','Modelo.MOID = Modelo');
			$this->db->where('MES', $mes);
			$this->db->order_by('QUANTIDADE_COMERCIALIZADA_PRODUTO','DESC');
			$query = $this->db->get();

			return $query->result();
		}
	}	

	// Verifica se a NCM existe //
	function checkNcm($table) 
	{
		if ($this->db->table_exists($table))
		{		
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}	

	// Retorna o categoria de uma importação //
	public function getCategoryByNcm($table, $idn)
	{		
		$this->db->select('Categoria');
		$this->db->from($table);
		$this->db->where('IDN',$idn);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna a marca de uma importação //
	function getBrandByNcm($table, $id)
	{
		$this->db->select('Marca');
		$this->db->from($table);
		$this->db->where('IDN',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	// Retorna o modelo de uma importação //
	function getModelByNcm($table, $id)
	{
		$this->db->select('Modelo');
		$this->db->from($table);
		$this->db->where('IDN',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}		

	/**
	 * Retorna itens das subcategoria sem modelo
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

	// Retorna itens "subcategorias" //
	function getElementByID($coluna, $id)
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
	
	// Retorna uma linha da tabela de NCM //
	function listDataNcm($table, $id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('Categoria','Categoria.CID = Categoria');
		$this->db->join('Marca','Marca.MAID = Marca');
		$this->db->join('Modelo','Modelo.MOID = Modelo');
		$this->db->where('IDN',$id);
		$this->db->limit('1');
		$query = $this->db->get();

		return $query->result();		
	}	

	// Atualiza uma importação //
	function update($id, $table, $colun, $idn, $item)
	{
		if ($id == 1)
		{
			$this->db->query("UPDATE $table SET $colun = $item WHERE IDN  = '$idn'");	
		}
		elseif ($id == 2)
		{
			$this->db->query("UPDATE $table SET $colun = $item, Modelo = 1 WHERE IDN 	= '$idn'");	
		}
		elseif ($id == 3)
		{		
			$this->db->query("UPDATE $table SET $colun = $item WHERE IDN = $idn");	
		}
		elseif ($id == 4)
		{					
			$this->db->query("UPDATE $table SET Categoria = $item , Modelo = 1, Marca = 1 WHERE IDN IN ($idn)");	
		}		
		elseif ($id == 5)
		{					
			$this->db->query("UPDATE $table SET Marca = $item , Modelo = 1 WHERE IDN IN ($idn)");	
		}				
		elseif ($id == 6)
		{					
			$this->db->query("UPDATE $table SET Modelo = $item WHERE IDN IN ($idn)");
		}			
	}	

	// Update da NCM com modelo = 1 //
	function emptyModel($table, $id) 
	{				
		$this->db->query("UPDATE $table SET Modelo = 1 WHERE Modelo  = '$id'");
	}

	// Trunc ncm //
	function ncmEmpty($table, $mes)
	{
		$this->db->query("UPDATE $table SET Modelo = '1', Marca = 1, Categoria = 1,
			SubCategoria1_SCID = 1, SubCategoria2_SCID = 1, SubCategoria3_SCID = 1,
			SubCategoria4_SCID = 1, SubCategoria5_SCID = 1, SubCategoria6_SCID = 1,
			SubCategoria7_SCID = 1, SubCategoria8_SCID = 1 WHERE MES = $mes");
	}

	// Parser da tabela de NCM com a tabela de modelos //
	function modelProcess($table, $dados, $mes, $modelo, $modelo1, $modelo2, $modelo3, $modelo4)
	{			
		
		$this->db->where('MES', $mes);
		$this->db->where('Modelo', 1);		

		if (!empty($modelo))
		{		
			$this->db->where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$modelo%'");
		}
		if (!empty($modelo1))
		{		
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$modelo1%'");
			$this->db->where('MES', $mes);
			$this->db->where('Modelo', 1);			
		}
		if (!empty($modelo2))
		{			
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$modelo2%'");
			$this->db->where('MES', $mes);
			$this->db->where('Modelo', 1);						
		}
		if (!empty($modelo3))
		{	
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$modelo3%'");
			$this->db->where('MES', $mes);
			$this->db->where('Modelo', 1);						
		}
		if (!empty($modelo4))
		{			
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$modelo4%'");
			$this->db->where('MES', $mes);
			$this->db->where('Modelo', 1);						
		}				

		$this->db->update($table, $dados);
	}

	// Parser da tabela de NCM com a tabela de marcas //
	function brandProcess($table, $mes, $marca, $marca1, $marca2, $dados)
	{			
		
		$this->db->where('MES', $mes);
		$this->db->where('Marca', 1);

		if (!empty($marca))
		{
			$this->db->where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$marca%'");
		}		
		if (!empty($marca1))
		{
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$marca1%'");
			$this->db->where('MES', $mes);
			$this->db->where('Marca', 1);			
		}
		if (!empty($marca2))
		{
			$this->db->or_where("DESCRICAO_DETALHADA_PRODUTO LIKE '%$marca2%'");
			$this->db->where('MES', $mes);
			$this->db->where('Marca', 1);			
		}			
		
		$this->db->update($table, $dados);
	}

	// Retorna todas as NCMs de uma categoria //
	public function listNcmByCategory($id)
	{
		$this->db->select('NNome');
		$this->db->from('NCM_has_Categoria');
		$this->db->where('Categoria_CID', $id);
		$this->db->join('NCM','NCM_NID = NID');
		$query = $this->db->get();
		
		return $query->result();
	}

	// Retorna os dados de importações do tipo outras //
	function sumOthersByYear($table, $categoria, $subcategoria, $dataInicial, $dataFinal)
	{
		$this->db->select_sum('QUANTIDADE_COMERCIALIZADA_PRODUTO');
		$this->db->select_sum('VALOR_TOTAL_PRODUTO_DOLAR');
		$this->db->from($table);
		$this->db->where('Categoria',$categoria);
		$this->db->where('Modelo','1');
		$this->db->where('Marca','1');
		$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");		
		
		foreach ($subcategoria as $key => $value)
		{
			$coluna = "SubCategoria". ($key + 1) ."_SCID";
			if (!empty($value) && ($value != 'false'))
			{
				$this->db->where($coluna, $value);
			}
		}
						
		$query = $this->db->get();
		return $query->result();
	}

	// Retorna a lista de importações de uma marca //
	public function getDataDetails($table, $modelos, $marca, $categoria, $dataInicial, $dataFinal)
	{
		if (($marca == NULL) AND ($modelos == NULL))
		{
			$this->db->select('IDN, VALOR_TOTAL_PRODUTO_DOLAR, DESCRICAO_DETALHADA_PRODUTO, VALOR_UNIDADE_PRODUTO_DOLAR, QUANTIDADE_COMERCIALIZADA_PRODUTO, Marca, Modelo, MANome, MNome, MES');
			$this->db->from($table);
			$this->db->join('Marca', 'MAID = Marca');
			$this->db->join('Modelo', 'MOID = Modelo');
			$this->db->where('Categoria', $categoria);
			$this->db->where('Modelo', '1');
			$this->db->where('Marca', '1');
			$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");					
			$query = $this->db->get();			
		}
		elseif (empty($marca))
		{
			$this->db->select('IDN, VALOR_TOTAL_PRODUTO_DOLAR, DESCRICAO_DETALHADA_PRODUTO, VALOR_UNIDADE_PRODUTO_DOLAR, QUANTIDADE_COMERCIALIZADA_PRODUTO, Marca, Modelo, MANome, MNome, MES');
			$this->db->from($table);
			$this->db->join('Marca', 'MAID = Marca');
			$this->db->join('Modelo', 'MOID = Modelo');
			$this->db->where('Categoria', $categoria);
			$this->db->where_in('Modelo', $modelos);
			$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");					
			$query = $this->db->get();
		}
		else
		{
			$this->db->select('IDN, VALOR_TOTAL_PRODUTO_DOLAR, DESCRICAO_DETALHADA_PRODUTO, VALOR_UNIDADE_PRODUTO_DOLAR, QUANTIDADE_COMERCIALIZADA_PRODUTO, Marca, Modelo, MANome, MNome, MES');
			$this->db->from($table);
			$this->db->join('Marca', 'MAID = Marca');
			$this->db->join('Modelo', 'MOID = Modelo');
			$this->db->where('Marca', $marca);			
			$this->db->where_in('Modelo', $modelos);
			$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");		
			$query = $this->db->get();			
		}
		
		return $query->result();
	}
	
	// Retorna a lista de importações detalhadas de um modelo //
	public function getDataModelDetails($table, $modelo, $dataInicial, $dataFinal)
	{
		$this->db->select('IDN, DESCRICAO_DETALHADA_PRODUTO, VALOR_UNIDADE_PRODUTO_DOLAR, QUANTIDADE_COMERCIALIZADA_PRODUTO, Marca, Modelo, MANome, MNome, MES');
		$this->db->from($table);
		$this->db->join('Marca', 'MAID = Marca');
		$this->db->join('Modelo', 'MOID = Modelo');
		$this->db->where('Modelo', $modelo);
		$this->db->where("MES BETWEEN $dataInicial AND $dataFinal");					
		$query = $this->db->get();
		
		return $query->result();
	}	

	// Deleta a referencia da categoria das tabelas NCMs //
	function updateItemForNcm($data, $id, $table, $categoria)
	{
		$this->db->query("UPDATE `$data` SET `$table` = 1 WHERE Categoria  = '$categoria' AND `$table` = $id");
	}

	// Retorna o Mês do último dado cadastrado //
	function getLastData($table)
	{

		$this->db->select('MES');
		$this->db->from($table);
		$this->db->order_by('MES', "desc");
		$this->db->limit('1');
		$query = $this->db->get();
		
		return $query->result();
	}

	// Retorna o Mês do último processamento //
	function getLastProcessing($table)
	{

		$this->db->select('MES');
		$this->db->from($table);
		$this->db->where('Modelo != 1');
		$this->db->order_by('MES', "desc");
		$this->db->limit('1');
		$query = $this->db->get();
		
		return $query->result();
	}	

}

?>