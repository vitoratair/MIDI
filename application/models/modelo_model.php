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
	 * Lista de modelos por marca
	 */
	function listarModeloByMarca($limit,$start, $marca)
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

	/**
	 * Lista de modelos por marca e categoria
	 */
	function listarModeloByMarcaCategoria($limit,$start, $marca, $categoria)
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
	 * Lista de todos os modelos cadastrados no sistema
	*/
	function listarAllModelo()
	{

		$this->db->select('MOID, MNome, MNome1, MNome2, MNome3, MNome4, Categoria_CID, Marca_MAID');
		$this->db->from('Modelo');
		$query = $this->db->get();

		return $query->result();		
	}


	/**
	 * Lista de modelos na categoria e marca selecionadas
	 */
	function listarAllModeloByMarca($categoria, $subcategoria, $marca)
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

	/**
	 * Lista de modelos na categoria selecionada
	 */
	function listarAllModeloByCategoria($categoria, $subcategoria)
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

	/**
	 * Lista os modelos da marca e categoria
	 */
	function buscaModeloByMarca($id, $categoria)
	{
		
		$this->db->select('*');
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$id);

		if (!empty($categoria))
		{
			$this->db->where('Categoria_CID',$categoria);			
		}

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
	 * count de modelos por marca
	 */
	function countModeloByMarca($id)
	{
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$id);
		$this->db->join('Marca' , 'MAID = Marca_MAID');
		$this->db->join('Categoria' , 'CID = Categoria_CID');

		return $this->db->count_all_results();
	}

	/**
	 * count de modelos por marca e categoria
	 */
	function countModeloByMarcaCategoria($marca, $categoria)
	{
		$this->db->from('Modelo');
		$this->db->where('Marca_MAID',$marca);
		$this->db->where('Categoria_CID',$categoria);
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
	 * Busca marca do modelo
	 */
	function bucaMarcaByModelo($id)
	{

		$this->db->select('MAID, MANome');
		$this->db->FROM('Marca');
		$this->db->join('Modelo','MAID = Marca_MAID');
		$this->db->where('MOID',$id);
		$query = $this->db->get();

		return $query->result();		
	}	

	/**
	 * Busca modelo
	 */
	function getModelo($id)
	{

		$this->db->select('MNome');
		$this->db->FROM('Modelo');
		$this->db->where('MOID',$id);
		$query = $this->db->get();

		return $query->result();		

	}	

	/**
	 * Busca o próximo ID
	 */
	function getId()
	{		
		$query = $this->db->query("SHOW TABLE STATUS LIKE 'Modelo'");
		
		return $query->result();	
	}	

	/**
	  * update de um modelo
	  */ 
	function updateModelo($data) 
	{				
		$id = $data['MOID'];
		$this->db->where('MOID', $id);
		$this->db->update('Modelo', $data);
	}

	/**
	 * Deleta o modelo
	 */
	function delete($id)
	{
		$this->db->where('MOID',$id);
		$this->db->delete('Modelo');
	}	

	/**
	  * update da NCM com modelo = 1
	  */ 
	function updateNcm($table, $id) 
	{				
		$this->db->query("UPDATE $table SET Modelo = 1 WHERE Modelo  = '$id'");
	}	

	/**
	  * Insere modelo 
	  */ 
	function cadastrar($data) 
	{		
		return $this->db->insert('Modelo', $data);
	}	

}
