
$(document).ready(function()
{

	// Envia os dados via post para edição de usuário, #testando progress_bar //
	$('#progrees_bar').submit ( function()
	{
		
		var id 			= $('#ID').val();
		var nome 		= $('#Nome').val();
		var login 		= $('#Login').val();
		var email 		= $('#Email').val();
		var cargo 		= $('#Cargo').val();
		var unidade 	= $('#Unidade').val();
		var tipo 		= $('#Tipo').val();
		
		$.post("../../user/updateUser/", { ID: id, usuarioNome : nome,usuarioLogin : login, usuarioEmail : email, cargoID : cargo, unidadeID : unidade, tipoID : tipo })
	
	});


	/*************************************************
	* Controle da Pagina de alterar senha do usuario *
	*************************************************/

	// Mostra a tela de alteracao de senha //
	$('#AlterarSenha').click ( function()
	{

		$('#Altera').slideDown();

		
		// Reset Mensagens //

		$('#CadastroPass_ok').hide();

		// Senha Atual
		$('#Pass_atual_ok').hide();
		$('#Pass_atual_nok').hide();

		// Nova senha 
		$('#Pass_novo_ok').hide();
		$('#Pass_novo_nok').hide();

		// Confirmacao da nova senha //
		$('#Pass_conf_ok').hide();
		$('#Pass_conf_nok').hide();

		$('#msg_tamanho').val('');

		$('#senhaAtual').val('');
		$('#senhaNova').val('');
		$('#senhaConf').val('');
	
	});


	// Verifica se a senha atual do usuario //
	$('#senhaAtual').change(TestPassAtual);

	// Verifica se a nova senha e a confirmação são iguais //
	$('#senhaNova').change(TestPass); 
	$('#senhaConf').change(TestPass);


	//Envia a nova senha para o controler usuario //
	$('#submit_altera_senha').click(TestAndSend); 



	// Funcao para pegar os dados e alterar a senha //
	function TestAndSend()
	{

		var test_1	= TestPass();

		if(test_1 == true )
		{
			SendPass();
			return true;
		}
		return false;

	}

	// Testa senha atual do usuario //
	function SendPass()
	{
		var password = $('#senhaAtual').val();

		if (password.length <= 0) 
		{
				$('#Pass_atual_ok').hide();
				$('#Pass_atual_nok').show();
				return false;
		}
		else
		{
		
			$.getJSON( path + '/user/getPassword/' + password, function (data){
			
					console.log(data);

					if(data == true)
					{
						$('#Pass_atual_nok').hide();
						$('#Pass_atual_ok').show();
						PostNewPass();
						return true;

					}
					$('#Pass_atual_ok').hide();
					$('#Pass_atual_nok').show();
					return false;
			});

		}
	}

	// Testa senha atual do usuario //
	function TestPassAtual()
	{
		var password = $('#senhaAtual').val();

		if (password.length < 0) 
		{
				$('#Pass_atual_ok').hide();
				$('#Pass_atual_nok').show();
				return false;
		}
		else
		{
		
			$.getJSON( path + '/user/getPassword/' + password, function (data){
			
					// console.log(data);

					if(data == true)
					{
						$('#Pass_atual_nok').hide();
						$('#Pass_atual_ok').show();
						return true;

					}
					$('#Pass_atual_ok').hide();
					$('#Pass_atual_nok').show();
					return false;
			});
		}
	}


	// Verifica se a nova senha e a confirmação de nova senha estão identicas //
	function TestPass()
	{
		var newPass = $('#senhaNova').val();
		var confPass = $('#senhaConf').val();

		if( (newPass == confPass) && (newPass.length > 0 ) && (newPass.length <= 8) )  
		{	
			// reset conf nok //
			$('#Pass_conf_nok').hide();
			$('#Pass_novo_nok').hide();
			$('#msg_tamanho').hide();				
			
			// Mostra ok //
			$('#Pass_novo_ok').show();
			$('#Pass_conf_ok').show();

			return true;
		}
		else
		{
			if(newPass.length <= 0 || newPass.length > 8)
			{
				$('#Pass_novo_ok').hide();
				$('#msg_tamanho').show();
			}
			else	
				// reset ok //
				$('#msg_tamanho').hide();
				$('#Pass_conf_ok').hide();

				$('#Pass_conf_nok').show();

				return false;
		}
	}

	// Envia a nova senha para o controler 
	function PostNewPass()
	{
		
		var newPass = $('#senhaNova').val();
		
		$.post( path + '/user/setPassword/' + newPass, function(data){

			//console.log(data);
			if (data == true)
			{
				$('#CadastroPass_ok').show();
				$('#Altera').slideUp(1000).delay(1000);

			}
			else
			{
				$('#CadastroPass_nok').show();
				$('#Altera').slideUp(1000).delay(1000);
			}

		}, "json");
	}



});



