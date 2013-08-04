<?php


class Requisicoes_model extends CI_Model {


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
	 * Busca todas as requisições
	 */
	function buscar()
	{

		$this->db->select('*');
		$this->db->from('Request');
		$this->db->join('Usuario', 'usuarioID = RequestUser');
		$this->db->order_by('RequestID');
		$query = $this->db->get();
		
		return $query->result();	
	}

	/**
	 * Atualiza um requisição
	 */
	function update($table, $idn, $categoria, $marca, $modelo)
	{

		$this->db->query("UPDATE Request SET Categoria = '$categoria', Marca = '$marca', Modelo = '$modelo' WHERE IDN = '$idn'");
	
	}

	/**
	 * Atualiza um item da requisição requisição
	 */
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

	/**
	 * Adiciona uma requisição
	 */
	function adicionar($id, $user, $ncm, $year, $idn, $item)
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

	/**
	 * Verficar se existe uma requisição para a NCM 
	 */
	function verificar($ncm, $ano, $idn, $user)
	{

		$this->db->select('*');
		$this->db->from('Request');
		$this->db->where('RequestNcm', $ncm);
		$this->db->where('RequestAno', $ano);
		$this->db->where('RequestIDN', $idn);
		
		if (!empty($user))
		{
			$this->db->where('RequestUser', $user);
		}
		
		$query = $this->db->get();
		
		return $query->result();
	}	


	/**
	 * Atualiza um requisição
	 */
	function delete($id)
	{

		$this->db->where('RequestID',$id);
		$this->db->delete('Request');
	
	}

}


?>