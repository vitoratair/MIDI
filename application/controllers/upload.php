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
		/* Busca as informações de POST */
		$id = $this->input->post('id');

		/* Realiza o upload para o diretório /tmp */
		$uploadfile = $_FILES['userfile']['tmp_name'];

		$nameFile = $_FILES['userfile']['name'];
		$nameFile = explode('.', $nameFile);
		$nameFile = $nameFile[0];

		/* Array com as extensões permitidas */
		$_OP['extensoes'] = array('xls', 'jpg');

		/* Faz a verificação da extensão do arquivo */
		$extensao = strtolower(end(explode('.', $_FILES['userfile']['name'])));	

		if (array_search($extensao, $_OP['extensoes']) === false)
		{
			$this->showError('Verifique a extensão do arquivo');
		}
		else
		{
			if ($id == 'ncmImport')
			{				
				/* Verifica se ja existe uma tabela no banco com o mesmo nome */
				if ($this->upload_model->checkTable($nameFile))
				{
					$this->showError("Tabela <i>" . $nameFile . "</i> já existe na base de dados");
					return;
				}

				if (move_uploaded_file($_FILES['userfile']['tmp_name'], '/tmp/' . $_FILES['userfile']['name']))
				{
				    print "O arquivo é valido e foi carregado com sucesso. Aqui esta alguma informação:\n";
				    // print_r($_FILES);
				}
				else
				{
				    print "Possivel ataque de upload! Aqui esta alguma informação:\n";
				    print_r($_FILES['error']);
				}
				#$this->openFile($uploadfile, $nameFile, 1);			

			}
			elseif ($id == 'ncmUpdate')
			{
				/* Verifica se ja existe uma tabela no banco com o mesmo nome */
				if (!$this->upload_model->checkTable($nameFile))
				{
					$this->showError("Tabela <i>" . $nameFile . "</i> não existe na base de dados");
					return;
				}	
				
				$this->openFile($uploadfile, $nameFile, 2);					

			}

		}

	}

	function openFile($pathFile, $nameFile, $id)
	{
		error_reporting(E_ALL ^ E_NOTICE); 		/* Não reporta erro do tipo Notice */	

		/* Carrega a primeira aba do excel na variável $sheet */
		if (!file_exists($pathFile))
		{
			$this->showError("Arquivo não encontrado");
			return;
		}

		$data 	= new Spreadsheet_Excel_Reader($pathFile, true);
		$sheet 	= $data->sheets[0];


		/* Verifica se o arquivo esta com o template correto */
		if (!$this->checkErro($sheet))
			return;

		if ($id == 1)
		{
			/* Cria a tabela no mysql */
			$result = $this->upload_model->createTable("TESTE");		
			$msg = "Arquivo importado com sucesso";
		}
		elseif ($id == 2)
		{
			$msg = "Arquivo atualizado com sucesso";	
		}

		/* Montando o array para inserção de dados */
		$i = 0;
		foreach ($sheet['cells'] as $key1 => $value)
		{
			if ($key1 != 1)
			{			
				$dataInsert['MES'] 									= $value[2];
				$dataInsert['PAIS_ORIGEM'] 							= $value[3];
				$dataInsert['PAIS_AQUISICAO']						= $value[4];
				$dataInsert['UNIDADE_COMERCIALIZACAO']				= $value[5];
				$dataInsert['DESCRICAO_DETALHADA_PRODUTO']			= $value[6];
				$dataInsert['PESO_LIQUIDO_KG']						= $value[7];
				$dataInsert['VALOR_UNIDADE_PRODUTO_DOLAR']			= $value[8];
				$dataInsert['QUANTIDADE_COMERCIALIZADA_PRODUTO']	= $value[9];
				$dataInsert['VALOR_TOTAL_PRODUTO_DOLAR']			= $value[10];
				$dataInsert['Categoria']							= $value[11];
				$dataInsert['Marca']								= $value[12];
				$dataInsert['Modelo']								= $value[13];
				$dataInsert['SubCategoria1_SCID']					= $value[14];
				$dataInsert['SubCategoria2_SCID']					= $value[15];
				$dataInsert['SubCategoria3_SCID']					= $value[16];
				$dataInsert['SubCategoria4_SCID']					= $value[17];	
				$dataInsert['SubCategoria5_SCID']					= $value[18];
				$dataInsert['SubCategoria6_SCID']					= $value[19];
				$dataInsert['SubCategoria7_SCID']					= $value[20];
				$dataInsert['SubCategoria8_SCID']					= $value[21];
				if ($this->upload_model->insertTable($nameFile, $dataInsert) == false)
				{					
					print_r($i);
					break;				
				}
				$i++;
			}
		}

		/* Inserindo dados na tabela */		
		$this->showSuccess($msg);	

		return;
	}

	function checkErro($sheet)
	{

		$_OP = array
		(
			'MAX_SHEETS' => '1',		
			'MAX_COL' 	=> '21',			
			'NAME_COL' 	=> array
					(
						'1' => 'IDN',
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

		/* Verifica o número de colunas */
		if (sizeof($sheet['cells'][1]) != $_OP['MAX_COL'])
		{
			$this->showError("O número de colunas esta incorreto");
			return FALSE;
		}
		
		/* Verifica se os nomes das colunas estão corretos */
		foreach ($sheet['cells'][1] as $key => $value)
		{
			if ($value != $_OP['NAME_COL'][$key])
			{
				$this->showError("Nome da coluna " . $key . " esta errada, o valor correto é <i> ". $value ." </i>");
				return FALSE;
			}
		}
		return TRUE;
	}

}

?>
