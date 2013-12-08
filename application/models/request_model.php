<?php


class Request_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	// Count da lista requisições //
	public function countRequest()
	{		
		$this->db->select('*');
		$this->db->from('Request');
		$this->db->join('Usuario', 'usuarioID = RequestUser');
		$this->db->order_by('RequestID');
		return $this->db->count_all_results();
	}

	// Retorna a lista requisições //
	public function getRequest($limit, $start)
	{		
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Request');
		$this->db->join('Usuario', 'usuarioID = RequestUser');
		$this->db->order_by('RequestID');
		$query = $this->db->get();

		return $query->result();				
	}

	// Count da lista requisições de uma categoria //
	public function countRequestbyCategory($categoria)
	{		
		$this->db->select('*');
		$this->db->from('Request');
		$this->db->join('Usuario', 'usuarioID = RequestUser');
		$this->db->where('RequestCategoria', $categoria);
		$this->db->order_by('RequestID');
		return $this->db->count_all_results();
	}

	// Retorna a lista de requisoções de uma categoria
	public function getRequestByCategory($limit, $start, $categoria)
	{		
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('Request');
		$this->db->join('Usuario', 'usuarioID = RequestUser');
		$this->db->where('RequestCategoria', $categoria);
		$this->db->order_by('RequestID');
		$query = $this->db->get();

		return $query->result();				
	}

	// Retorna a quantidade de requisições para novas marcas
	function countRequestByBrand()
	{
		$this->db->from('MarcaRequest');
		$this->db->order_by('MAID');
		return $this->db->count_all_results();
	}

	// Retorna a lista de requisiçoes para novas marcas
	function requestByBrand($limit, $start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('MarcaRequest');
		$this->db->order_by('MAID');
		$query = $this->db->get();

		return $query->result();
	}

	// Retorna a quantidade de requisições para novos modelos
	function countRequestByModel()
	{
		$this->db->from('ModeloRequest');
		$this->db->order_by('MOID');
		return $this->db->count_all_results();
	}

	// Retorna a lista de requisiçoes para novos modelos
	function requestByModel($limit, $start)
	{
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->from('ModeloRequest');
		$this->db->join('Categoria', 'CID = Categoria_CID');
		$this->db->join('Marca', 'MAID = Marca_MAID');
		$this->db->order_by('MOID');
		$query = $this->db->get();

		return $query->result();
	}

	// Verficar se existe uma requisição para a NCM //
	function checkRequest($ncm, $ano, $idn)
	{

		$this->db->select('*');
		$this->db->from('Request');
		$this->db->where('RequestNcm', $ncm);
		$this->db->where('RequestAno', $ano);
		$this->db->where('RequestIDN', $idn);	
		$query = $this->db->get();
		
		return $query->result();
	}

	// Adicionar uma nova requisição
	function addRequest($id, $user, $ncm, $year, $idn, $modelo, $marca, $categoria)
	{

		if ($id == 1)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestCategoria', $categoria);
			$this->db->insert('Request');
		}
		elseif ($id == 2)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestMarca', $marca);
			$this->db->insert('Request');
		}	
		elseif ($id == 3)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestModelo', $modelo);
			$this->db->set('RequestMarca', $marca);
			$this->db->set('RequestCategoria', $categoria);			
			$this->db->insert('Request');
		}	
		
	}

	// Atualiza um item da requisição //
	function updateItem($id, $idRe, $ncm, $year, $idn, $modelo, $marca, $categoria)
	{

		if ($id == 1)
		{
			$this->db->query("UPDATE Request SET RequestCategoria = $categoria WHERE RequestID = '$idRe'");	
		}
		elseif ($id == 2)
		{
			$this->db->query("UPDATE Request SET RequestMarca = $marca, RequestModelo = NULL WHERE RequestID = '$idRe'");	
		}
		elseif ($id == 3)
		{
			$this->db->query("UPDATE Request SET RequestModelo = '$modelo', RequestMarca = '$marca', RequestCategoria = '$categoria' WHERE RequestID = '$idRe'");	
		}				
	}

	// Exlcuir uma requisição //
	function deleteRequest($id)
	{
		$this->db->where('RequestID',$id);
		$this->db->delete('Request');
	}

	// Exlcuir uma requisição de modelo//
	function deleteRequestModel($id)
	{
		$this->db->where('MOID',$id);
		$this->db->delete('ModeloRequest');
	}

	// Atualiza um requisição //
	function updateRequest($id, $table, $idn, $item)
	{

		// Update Categoria
		if ($id == 1)
		{
			$this->db->query("UPDATE $table SET Categoria = '$item' WHERE IDN = '$idn'");	
		}
		// Update Modelo
		elseif ($id == 2)
		{
			$this->db->query("UPDATE $table SET Marca = '$item' WHERE IDN = '$idn'");	
		}		
		// Update Marca
		elseif ($id == 3)
		{
			$this->db->query("UPDATE $table SET Modelo = '$item' WHERE IDN = '$idn'");	
		}	
	}

	// Verifica se a requisição tem valores diferentes de NULL //
	function checkRequestIsNUll($id)
	{
		$this->db->where('RequestCategoria !=', 'NULL');
		$this->db->or_where('RequestMarca !=', 'NULL');
		$this->db->or_where('RequestModelo !=', 'NULL');
		$this->db->where('RequestID',$id);
		$this->db->from('Request');
		return $this->db->count_all_results();		

	}

}


?>