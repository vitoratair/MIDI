<?php 

class Upload extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->logged();
	}

	// Verifica se o usuário está logado //
	public function logged()
	{
		$logged = $this->session->userdata('logged');

		if(!isset($logged) || $logged != true)
		{	
			redirect('login','refresh');
		}		
	}

	// Carrega a view com as opções de importações //
	public function fileUpload()
	{
		$data['main_content'] 	= 'upload/fileUpload_view';		
		$this->parser->parse('template', $data);		
	}

	/* Exibe mensagem de erro para p usuário */
	public function showError($msg)
	{
		$data['error'] 			= $msg;
		$data['main_content'] 	= 'upload/fileUploadError_view';		
		$this->parser->parse('template', $data);
	}

	/* Exibe mensagem de sucesso para p usuário */
	public function showSuccess($msg)
	{
		$data['success'] 			= $msg;
		$data['main_content'] 		= 'upload/fileUploadSuccess_view';		
		$this->parser->parse('template', $data);
	}

	/* Realiza o upload para o diret´orio /uploads */	
	function do_upload()
	{		
		
		/* Realiza o upload para o diret´orio /uploads */
		$uploaddir = '/uploads/';
		$uploadfile = $uploaddir . $_FILES['userfile']['name'];

		$nameFile = explode('/', $uploadfile);
		$nameFile = $nameFile[2];
		$nameFile = explode('.', $nameFile);
		$nameFile = $nameFile[0];

		/* Array com as extensões permitidas */
		$_OP['extensoes'] = array('xls');

		/* Faz a verificação da extensão do arquivo */
		$extensao = strtolower(end(explode('.', $_FILES['userfile']['name'])));		
		if (array_search($extensao, $_OP['extensoes']) === false)
		{
			$this->showError('Verifique a extensão do arquivo');
		}
		else /* Extensão válida*/
		{
			/* Verifica se ja existe uma tabela no banco com o mesmo nome */

			if ($this->upload_model->checkTable($nameFile))
			{
				$this->showError("Tabela <i>" . $nameFile . "</i> já existe na base de dados");
			}

			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir . $_FILES['userfile']['name']))
			{
				$this->openFile($uploadfile);
			}
			else
			{
				$this->showError('Não foi possível fazer upload do arquivo, por-favor tende novamente.');
			}
		}

	}

	function openFile($pathFile)
	{
		error_reporting(E_ALL ^ E_NOTICE); 		/* Não reporta erro do tipo Notice */
		/* SETA constantantes da planilha para comparação */
		
		$nameFile = explode('/', $pathFile);
		$nameFile = $nameFile[2];
		$nameFile = explode('.', $nameFile);
		$nameFile = $nameFile[0];

		$_OP = array
		(
			'MAX_SHEETS' => '1',		
			'MAX_COL' 	=> '21',			
			'NAME_COL' 	=> array
					(
						'1' => 'IDN1',
						'2' => 'MES',
						'3' => 'PAIS_ORIGEM',
						'4' => 'PAIS_AQUISICAO',
						'5' => 'UNIDADE_COMERCIALIZACAO',
						'6' => 'DESCRICAO_DETALHADA_PRODUTO',
						'7' => 'PESO_LIQUIDO_KG',
						'8' => 'VALOR_UNIDADE_PRODUTO_DOLAR',
						'9' => 'QUANTIDADE_COMERCIALIZADA_PRODUTO',
						'10' => 'VALOR_TOTAL_PRODUTO_DOLAR',
						'11' => 'Categoria',
						'12' => 'Marca',
						'13' => 'Modelo',
						'14' => 'SubCategoria1_SCID',
						'15' => 'SubCategoria2_SCID',
						'16' => 'SubCategoria3_SCID',
						'17' => 'SubCategoria4_SCID',
						'18' => 'SubCategoria5_SCID',
						'19' => 'SubCategoria6_SCID',
						'20' => 'SubCategoria7_SCID',
						'21' => 'SubCategoria8_SCID'
					)
		);
		
		/* Carrega a primeira aba do excel na variável $sheet */
		$data 	= new Spreadsheet_Excel_Reader($pathFile, true);
		$sheet 	= $data->sheets[0];

		/* Cria a tabela no mysql */
		$result = $this->upload_model->createTable($nameFile);
		
		/* Verifica o número de colunas */
		if (sizeof($sheet['cells'][1]) != $_OP['MAX_COL'])
		{
			$this->showError('O número de colunas esta incorreto');
		}
		
		/* Verifica se os nomes das colunas estão corretos */
		foreach ($sheet['cells'][1] as $key => $value)
		{
			if ($value != $_OP['NAME_COL'][$key])
			{
				$this->showError("Nome da coluna " . $key . " esta errado");
			}
		}

		/* Montando o array para inserção de dados */
		$i = 0;
		foreach ($sheet['cells'] as $key1 => $value)
		{
			if ($key1 != 1)
			{			
				$dataInsert[$i]['MES'] 									= $value[2];
				$dataInsert[$i]['PAIS_ORIGEM'] 							= $value[3];
				$dataInsert[$i]['PAIS_AQUISICAO']						= $value[4];
				$dataInsert[$i]['UNIDADE_COMERCIALIZACAO']				= $value[5];
				$dataInsert[$i]['DESCRICAO_DETALHADA_PRODUTO']			= $value[6];
				$dataInsert[$i]['PESO_LIQUIDO_KG']						= $value[7];
				$dataInsert[$i]['VALOR_UNIDADE_PRODUTO_DOLAR']			= $value[8];
				$dataInsert[$i]['QUANTIDADE_COMERCIALIZADA_PRODUTO']	= $value[9];
				$dataInsert[$i]['VALOR_TOTAL_PRODUTO_DOLAR']			= $value[10];
				$dataInsert[$i]['Categoria']							= $value[11];
				$dataInsert[$i]['Marca']								= $value[12];
				$dataInsert[$i]['Modelo']								= $value[13];
				$dataInsert[$i]['SubCategoria1_SCID']					= $value[14];
				$dataInsert[$i]['SubCategoria2_SCID']					= $value[15];
				$dataInsert[$i]['SubCategoria3_SCID']					= $value[16];
				$dataInsert[$i]['SubCategoria4_SCID']					= $value[17];	
				$dataInsert[$i]['SubCategoria5_SCID']					= $value[18];
				$dataInsert[$i]['SubCategoria6_SCID']					= $value[19];
				$dataInsert[$i]['SubCategoria7_SCID']					= $value[20];
				$dataInsert[$i]['SubCategoria8_SCID']					= $value[21];												
				$i++;
			}
		}

		/* Inserindo dados na tabela */
		$this->upload_model->insertTable($nameFile, $dataInsert);
		
		$this->showSuccess('Arquivo importado com sucesso');

		return;
	}
}

?>
