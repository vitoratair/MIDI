<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AnalizeCalc
{	
	// Realiza o calculo para o share inicial de cada NCM -->
	function getDataFirstShare($table, $categoria, $sc)
	{

		echo "string";
		// $modelos	= array();
		// $ano 		= explode('_', $table);
		// $ano 		= $ano[1];

		// // Verifica os modelos da categoria //
		// $modelo 	= $this->modelo_model->listarAllModeloByCategoria($categoria, $sc);

		// if (!empty($modelo))
		// {
		// 	// Formata o query para a clausula IN //
		// 	foreach ($modelo as $key => $value)
		// 	{
		// 		array_push($modelos, $value->MOID);	
		// 	}			
		// }

		// // Calcula as unidades referente a uma NCM //
		// $unidades 			= $this->analise_model->calcUnidadesByModelo($table, $modelos);
		// $volume 			= $this->analise_model->calcVolumeByModelo($table, $modelos);
		// $result['unidades'] = $unidades[0]->QUANTIDADE_COMERCIALIZADA_PRODUTO;
		// $result['volume']	= $volume[0]->VALOR_TOTAL_PRODUTO_DOLAR;
		// $result['ano'] 		= $ano;	

		// return $result;		
	}

}

?>