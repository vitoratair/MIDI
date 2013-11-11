<?php

class Upload_model extends CI_Model
{

	// Inicia construtor do model //
	function __construct()
	{
		parent::__construct();
	}

	public function createTable($tableName)
	{
	    $sql = 
		"
			CREATE TABLE IF NOT EXISTS " . $tableName . " (
			  `IDN` int(5) NOT NULL AUTO_INCREMENT,
			  `MES` int(2) DEFAULT NULL,
			  `PAIS_ORIGEM` varchar(45) DEFAULT NULL,
			  `PAIS_AQUISICAO` varchar(45) DEFAULT NULL,
			  `UNIDADE_COMERCIALIZACAO` varchar(45) DEFAULT NULL,
			  `DESCRICAO_DETALHADA_PRODUTO` varchar(1000) DEFAULT NULL,
			  `PESO_LIQUIDO_KG` decimal(10,5) DEFAULT NULL,
			  `VALOR_UNIDADE_PRODUTO_DOLAR` decimal(10,5) DEFAULT NULL,
			  `QUANTIDADE_COMERCIALIZADA_PRODUTO` int(10) DEFAULT NULL,
			  `VALOR_TOTAL_PRODUTO_DOLAR` decimal(10,5) DEFAULT NULL,
			  `Categoria` int(1) DEFAULT NULL,
			  `Marca` int(1) DEFAULT NULL,
			  `Modelo` int(1) DEFAULT NULL,
			  `SubCategoria1_SCID` int(1) DEFAULT NULL,
			  `SubCategoria2_SCID` int(1) DEFAULT NULL,
			  `SubCategoria3_SCID` int(1) DEFAULT NULL,
			  `SubCategoria4_SCID` int(1) DEFAULT NULL,
			  `SubCategoria5_SCID` int(1) DEFAULT NULL,
			  `SubCategoria6_SCID` int(1) DEFAULT NULL,
			  `SubCategoria7_SCID` int(1) DEFAULT NULL,
			  `SubCategoria8_SCID` int(1) DEFAULT NULL,
			  PRIMARY KEY (`IDN`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8
		";

	    $result = $this->db->query($sql);
	}

	/* Insere as entradas de NCM no formato array */
	function insertTable($tableName, $data) 
	{		
		return $this->db->insert($tableName, $data);
		// return $this->db->insert_batch($tableName, $data);
	}

	/* Insere as entradas de NCM no formato array */
	function insert($tableName, $data) 
	{		
		return $this->db->insert($tableName, $data);
	}	

	/* Verifica se a tabela já existe */
	function checkTable($table)
	{
		return $this->db->table_exists($table);
	}
}

?>
