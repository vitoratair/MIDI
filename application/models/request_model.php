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
	function addRequest($id, $user, $ncm, $year, $idn, $item)
	{

		if ($id == 1)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestCategoria', $item);
			$this->db->insert('Request');
		}
		elseif ($id == 2)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestMarca', $item);
			$this->db->insert('Request');
		}	
		elseif ($id == 3)
		{
			$this->db->set('RequestUser', $user);
			$this->db->set('RequestNcm', $ncm);
			$this->db->set('RequestAno', $year);
			$this->db->set('RequestIDN', $idn);
			$this->db->set('RequestModelo', $item);
			$this->db->insert('Request');
		}	
		
	}

	// Atualiza um item da requisição //
	function updateItem($id, $idRe, $ncm, $year, $idn, $item)
	{

		if ($id == 1)
		{
			$this->db->query("UPDATE Request SET RequestCategoria = '$item' WHERE RequestID = '$idRe'");	
		}
		elseif ($id == 2)
		{
			$this->db->query("UPDATE Request SET RequestMarca = '$item' WHERE RequestID = '$idRe'");	
		}
		elseif ($id == 3)
		{
			$this->db->query("UPDATE Request SET RequestModelo = '$item' WHERE RequestID = '$idRe'");	
		}				
	}

	// Exlcuir uma requisição //
	function deleteRequest($id)
	{
		$this->db->where('RequestID',$id);
		$this->db->delete('Request');
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

}


?>