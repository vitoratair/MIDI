<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Funcões para ajudar a trabalhar com datas em php 
 */



/**
 * Converte data do formato mysql para formato dd/mm/aaaa
 */
if ( !function_exists('convert_date'))
{
	function convert_date($array, $objName, $dateName)
	{
		$CI =& get_instance();


		if (!empty($array[$objName]))
		{
			$tamanho = sizeof($array[$objName]);

			for ($i=0; $i < $tamanho; $i++) 
			{
				$dateBD = $array[$objName][$i]->$dateName;
		 		$date_convertida = implode("/",array_reverse(explode("-",$dateBD)));
		 		$array[$objName][$i]->$dateName = $date_convertida;
			}
		}

		return $array;
	}
}



/**
 * Verifica a se a data é menor que hoje 
 */
if ( !function_exists('date_is_menor_hoje'))
{
	function date_is_menor_hoje($date)
	{
		$CI =& get_instance();
		date_default_timezone_set('America/Sao_Paulo');

		$data_atual = date("d/m/Y");

		$data_auditoria = implode("",array_reverse(explode("/",$date)));
		$data_hoje = implode("",array_reverse(explode("/",$data_atual)));

		if( $data_auditoria < $data_hoje)  
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}	
}



/**
 * Retorna a data do sistema no formato dd/mm/aaaa
 */
if ( !function_exists('date_now'))
{
	function date_now()
	{
		$CI =& get_instance();
		date_default_timezone_set('America/Sao_Paulo');

		return date("d/m/Y");

	}	
}


/**
 * Retorna a data do sistema no formato 17/10/2012 - 01:23 59
 */
if ( !function_exists('convert_date_mysql_timestamp'))
{
	function convert_date_mysql_timestamp($array, $objName, $dateName)
	{
		$CI =& get_instance();
		
		date_default_timezone_set('America/Sao_Paulo');

		// Formato da data //
		$datestring = "%d/%m/%Y às %H:%i e %s segundos";

		// Caracteres a serem retirados //
		$pontos = array(":", "-", " ");

		if (!empty($array[$objName]))
		{
			$tamanho = sizeof($array[$objName]);

			for ($i=0; $i < $tamanho; $i++) 
			{
				// Recupera a data do bd //
				$string = $array[$objName][$i]->$dateName;

				// retira caracteres da data vinda do bd //
				$dateBD = str_replace($pontos,"", $string);

				// pega a data vinda do bd sem os caracteres e formata como espeficicado //
		 		$date_convertida = mdate($datestring, mysql_to_unix($dateBD));

		 		$array[$objName][$i]->$dateName = $date_convertida;
			}
		}

		return $array;

	}	
}




/* End of file user_helper.php */
/* Location: ./application/helpers/user_helper.php */