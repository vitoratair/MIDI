

/**
* Manipulaçao de relatorio para Nao Conformidade
*/
$(document).ready(function() {

	var tableName = '#tab_ac tbody';
	

	$(':checkbox[id=ac_agendada]').change (analisa);
	$(':checkbox[id=ac_executada]').change (analisa);
	$(':checkbox[id=ac_retornada]').change (analisa);
	$(':checkbox[id=ac_fechada]').change (analisa);



	// relatorio completo //
	function checkAll()
	{
		AC('all');
	}


	// Analisa status  //
	function analisa()
	{

		// Analisa se é para listar todas as ncs //
		if ( ( $('#ac_agendada').is(':checked') &&  $('#ac_executada').is(':checked') ) && $('#ac_retornada').is(':checked') &&  $('#ac_fechada').is(':checked'))
		{
			checkAll();
			return;
		}

		// Analisa se é para listar todas as ncs //
		if ( ( $('#ac_agendada').is(':unchecked') &&  $('#ac_executada').is(':unchecked') ) && $('#ac_retornada').is(':unchecked') &&  $('#ac_fechada').is(':unchecked'))
		{
			checkAll();
			return;
		}

		// Analisa se é para listar somente as agendadas //
		if ( $('#ac_agendada').is(':checked') )
		{
			// Solicita o relatorio //
			AC('agendada');
			return;
		}


		// Analisa se é para listar somente as executadas //
		if ( $('#ac_executada').is(':checked') )
		{
			// Solicita o relatorio //
			AC('executada');
			return;
		}

		// Analisa se é para listar somente as retornadas //
		if ( $('#ac_retornada').is(':checked') )
		{
			// Solicita o relatorio //
			AC('retornada');
			return;
		}

		// Analisa se é para listar somente as fechadas //
		if ( $('#ac_fechada').is(':checked') )
		{
			// Solicita o relatorio //
			AC('fechada');
			return;
		}


	}


	// Atualiza o relatorio de Acao corretiva //
	function AC(status)
	{	
		$.getJSON( path + '/relatorio/relatAC/' + status, function (data){
	
			$(tableName).empty();

			$.each(data, function(i, obj) 
			{
				$(tableName).append(
					
					'<tr>' 
					+ 
					
						'<td>' + obj.acDescricao + ' </td>' +
						'<td>' + obj.ncDescricao + ' </td>' +
						'<td>' + '<span class="label label-'+ obj.statusCode +' ">' + obj.statusNome + '</span>' + '</td>' 

						+   
					'</tr>'

				);
			
			});
		});

	}
	// Fim funcao auditoria //

});
