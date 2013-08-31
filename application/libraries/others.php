<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Others
{

	function buscaMes($i)
	{

		switch ($i) {
			
			case 1:			
				return "Janeiro";
				break;

			case 2:			
				return "Fevereiro";
				break;

			case 3:			
				return "Março";
				break;

			case 4:			
				return "Abril";
				break;

			case 5:			
				return "Maio";
				break;

			case 6:			
				return "Junho";
				break;

			case 7:			
				return "Julho";
				break;

			case 8:			
				return "Agosto";
				break;																

			case 9:			
				return "Setembro";
				break;	

			case 10:			
				return "Outubro";
				break;	

			case 11:			
				return "Novembro";
				break;									

			case 12:			
				return "Dezembro";
				break;

			default:
				# code...
				break;
		}
	
	}

	// Alinha todas as categorias encontradas em uma NCM um uma string //
	function formataCategorias($dados)
	{
		$categorias = NULL;
		foreach ($dados as $key => $value)
		{
			$categorias = $categorias . " - " . $value->CNome;
		}
		$categorias = substr($categorias, 3);

		return $categorias;
	}

	// Formata os dados unidades e o volume das importações //
	function formatarDados($id, $dados)
	{	
		if($id == 1)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]->QUANTIDADE_COMERCIALIZADA_PRODUTO = number_format($value->QUANTIDADE_COMERCIALIZADA_PRODUTO,0,",",".");
			}			
		}

		return $dados;
	}		

	// Merge de todas as NCMs em um único array //
	function mergeTableNcm($dados)
	{
		$result = array();

		for ($i=0; $i < sizeof($dados); $i++)
		{ 
			if (!empty($dados[$i]))
			{
				$result = array_merge($result, $dados[$i]);	
			}
		}		
		return $result;
	}

}

/* End of file others.php */
/* Location: ./application/libraries/others.php */