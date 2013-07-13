<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Usa o nome do usuario e matricula para criar o username;
 *
 * @access	public
 * @param	nome, matricula
 * @return	string
 */
if ( ! function_exists('create_username'))
{
	function create_username($nome, $matricula)
	{
		$CI =& get_instance();

		$nome = substr($nome,0,2);
		$matricula = substr($matricula, 0, 6);		
		 
		return strtolower($nome).$matricula;
	}
}


/* End of file user_helper.php */
/* Location: ./application/helpers/user_helper.php */