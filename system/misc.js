$(document).ready(function(){

	// Analisa o botão submit de envio de Não conformidade //
	$('#submit_nc').click ( function()
	{
		var desc = $('#Descricao').val();
		var date = $('#Data').val();
		var comment = $('#Comentario').val();
		var auditoria = $('#Auditoria').val();
		var artefato = $('#Artefato').val();
		var responsavel = $('#Responsavel').val();

		// Limpa //
		$('#Descricao').val('');
		$('#Data').val('');
		$('#Comentario').val('');
		$('#Artefato').val('');
		$('#Responsavel').val('');
		
		if (desc != "" && date != "" && comment != "" ){
			
			$.post("../../nc/cadastrarNc/", { Descricao : desc , Data : date, Comentario : comment, Auditoria : auditoria, Artefato : artefato, Responsavel : responsavel }, "json");
			
			$('.modal-body').slideUp(400);
			$('#alert-msg').slideDown(400).delay(800);
			$('#alert-msg').slideUp(400);
		}
		else
			{
				$('.modal-body').slideUp(400);
				$('#alert-msg-error').slideDown(400).delay(800);
				$('#alert-msg-error').slideUp(400);	
			}
		
		// Fecha o modal depois do timeout //
		var delay = 2000;
		setTimeout(function()
		{	
		 	$("#NCmodal").modal('hide');
		}, delay);
		 	
		 
	});

	// Analisa o radio selecionado //
	$(':radio').click ( function()
	{
		if ($(this).is(':checked') && $(this).val() == 6) 
		{
			var id = $(this).attr("id");
			$('#Artefato').val(id);
			
			$('#NCmodal').modal('show');
		}

	});


	// Executa quando o modal for fechado //
	$('#NCmodal').bind('hidden', 'hide', function () {
		  
		// Limpa //
		$('#Descricao').val('');
		$('#Data').val('');
		$('#Comentario').val('');
		$('#Artefato').val('');
		$('#Responsavel').val('');
		
		// Deixa página default //
		$('.modal-body').slideDown();
		
		// Deixa página default //
		$('#alert-msg').slideUp();
		$('#alert-msg-error').slideUp();

	});
	

	// Datas para o sistema //
	$('#Data').datepicker();



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
		
			$.getJSON( path + '/usuario/getPass/' + password, function (data){
			
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


	// Envia a nova senha para o controler 
	function PostNewPass()
	{
		
		var newPass = $('#senhaNova').val();
		
		$.post( path + '/usuario/setPass/' + newPass, function(data){

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
		
			$.getJSON( path + '/usuario/getPass/' + password, function (data){
			
					//console.log(data);

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


	// Funcao verifica senha e apresenta ou remove mensagens das mesmas //
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


});



