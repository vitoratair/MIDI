<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



/*
|--------------------------------------------------------------------------
| Constantes de status
|--------------------------------------------------------------------------
|
| Status do sistema, conforme banco de dados
|
*/

define('STATUS_AGENDADA',		1);
define('STATUS_REALIZADA',		2);
define('STATUS_ANDAMENTO',		3);
define('STATUS_NAO_APLICAVEL',	4);
define('STATUS_CONFORME',		5);
define('STATUS_NAO_CONFORME',	6);
define('STATUS_ABERTA',			7);
define('STATUS_FECHADA',		8);
define('STATUS_EXECUTADA',		9);
define('STATUS_RETORNADA',		10);
define('STATUS_DIRETA',			11);


/*
|--------------------------------------------------------------------------
| Constantes de tipo de usuario
|--------------------------------------------------------------------------
|
| Tipos de usuarios presentes no sistema, conforme banco de dados
|
*/

define('USER_ADMIN',		1);
define('USER_USUARIO',		2);

define('DATABASE',			'midi');



/*
|--------------------------------------------------------------------------
| Constantes de mensagens
|--------------------------------------------------------------------------
|
| Constantes de mensagens
|
*/

define('MSG01',	"Mensagem enviada automaticamente pelo sistema");

/* End of file constants.php */
/* Location: ./application/config/constants.php */