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
	  * Verifica se a NCM existe
	  */ 
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

	/**
	 * Busca de marca de uma NCM
	 */
	function buscarMarca($table, $id)
	{
		$this->db->select('Marca');
		$this->db->from($table);
		$this->db->where('IDN',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Busca de modelo de uma NCM
	 */
	function buscarModelo($table, $id)
	{
		$this->db->select('Modelo');
		$this->db->from($table);
		$this->db->where('IDN',$id);
		$query = $this->db->get();
		
		return $query->result();	
	}	


	/**
	 * Busca uma ncm
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
	 * Busca uma linha da tabela de NCM
	 */
	function listarNCM($table, $id)
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
	 * Update de item da NCM
	 */
	public function update($id, $table, $colun, $idn, $item)
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
	function buscaDados($limit, $start, $table, $id, $brand, $model, $search, $unSearch)
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

	}

	/**
	 * COUNT dos dados
	 */
	function countBuscaDados($table, $id, $brand, $model, $search, $unSearch)
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

	}

	/**
	 * Retorna todas as NCMs de uma categoria
	 */
	public function getNcmByCategoria($id)
	{
		$this->db->select('NNome');
		$this->db->from('NCM_has_Categoria');
		$this->db->where('Categoria_CID', $id);
		$this->db->join('NCM','NCM_NID = NID');
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Retorna todas as marcas com um array de modelos
	 */
	public function getDadosAnosByMarca($table, $modelos)
	{
		$this->db->select('DISTINCT(`Marca`)');
		$this->db->from($table);
		$this->db->where_in('Modelo', $modelos);
		$query = $this->db->get();
		
		return $query->result();
	}	

	/**
	 * Retorna a lista de importações
	 */
	public function getDadosMarcaDetalhe($table, $modelos, $marca)
	{
		$this->db->select('DESCRICAO_DETALHADA_PRODUTO, VALOR_UNIDADE_PRODUTO_DOLAR, QUANTIDADE_COMERCIALIZADA_PRODUTO, Marca, Modelo, MANome, MNome');
		$this->db->from($table);
		$this->db->join('Marca', 'MAID = Marca');
		$this->db->join('Modelo', 'MOID = Modelo');
		$this->db->where('Marca', $marca);
		$this->db->where_in('Modelo', $modelos);
		$query = $this->db->get();
		
		return $query->result();
	}		



}
