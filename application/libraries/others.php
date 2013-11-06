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
				return " - ";
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
		error_reporting(E_ALL ^ E_NOTICE);
		
		if($id == 1)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]->QUANTIDADE_COMERCIALIZADA_PRODUTO = number_format($value->QUANTIDADE_COMERCIALIZADA_PRODUTO,0,",",".");
			}			
		}
		elseif($id == 2)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");
				$dados[$key]['volume'] 			= number_format($value['volume'],0,",",".");
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['shareUnidades'] 	= number_format($value['shareUnidades'],2,",",".");
				$dados[$key]['shareVolume'] 	= number_format($value['shareVolume'],2,",",".");				
			}			
		}
		elseif ($id == 3)
		{
			$dados['unidades'] 	= number_format($dados['unidades'],0,",",".");
			$dados['volume'] 	= number_format($dados['volume'],2,",",".");			
		}	
		elseif ($id == 4)
		{
			$dados['fob'] 		= number_format($dados['fob'],2,",",".");
			$dados['unidades'] 	= number_format($dados['unidades'],0,",",".");			
		}
		elseif ($id == 5)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");
				$dados[$key]['volume'] 			= number_format($value['volume'],0,",",".");
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['descricao'] 		= wordwrap($value['descricao'], 15, "\n", true);
			}			
		}
		elseif ($id == 6)
		{
			foreach ($dados as $key => $value)
			{
				$dados[$key]['descricao'] 		= wordwrap($value['descricao'], 15, "\n", true);
				$dados[$key]['fob'] 			= number_format($value['fob'],2,",",".");
				$dados[$key]['unidades']		= number_format($value['unidades'],0,",",".");				
			}			
		}
		elseif ($id == 7) // ERA O ID 1 //
		{
			$dados['totalunidades'] = number_format($dados['totalunidades'],0,",",".");
			$dados['totalvolume'] 	= number_format($dados['totalvolume'],0,",",".");			
		}
		elseif($id == 8)
		{
			
			foreach ($dados as $key => $value)
			{
				if ($value->QUANTIDADE_COMERCIALIZADA_PRODUTO > 0)
					$dados[$key]->QUANTIDADE_COMERCIALIZADA_PRODUTO = number_format($value->QUANTIDADE_COMERCIALIZADA_PRODUTO,0,",",".");
				else
					$dados[$key]->QUANTIDADE_COMERCIALIZADA_PRODUTO = $value->QUANTIDADE_COMERCIALIZADA_PRODUTO;

				if ($value->PESO_LIQUIDO_KG > 0)
					$dados[$key]->PESO_LIQUIDO_KG 				= number_format($value->PESO_LIQUIDO_KG,0,",",".");
				else
					$dados[$key]->PESO_LIQUIDO_KG 				= $value->PESO_LIQUIDO_KG;
				
				if ($value->VALOR_UNIDADE_PRODUTO_DOLAR > 0)
					$dados[$key]->VALOR_UNIDADE_PRODUTO_DOLAR 		= number_format($value->VALOR_UNIDADE_PRODUTO_DOLAR,2,",",".");
				else
					$dados[$key]->VALOR_UNIDADE_PRODUTO_DOLAR 		= $value->VALOR_UNIDADE_PRODUTO_DOLAR;
				
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