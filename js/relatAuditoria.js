

/**
* Manipulaçao de relatorio para auditoria
*/
$(document).ready(function() {

	var tableName = '#tab_auditoria tbody';
	

	$(':checkbox[id=aud_agendada]').change (analisa);
	$(':checkbox[id=aud_executada]').change (analisa);



	// relatorio completo //
	function checkAll()
	{
		Auditoria('all');
	}


	// Analisa status Executada //
	function analisa()
	{

		// Analisa se é para listar todas as auditorias //
		if ( ( $('#aud_executada').is(':checked') &&  $('#aud_agendada').is(':checked') ) || $('#aud_executada').is(':unchecked') &&  $('#aud_agendada').is(':unchecked'))
		{
			checkAll();
			return;
		}

		// Analisa se é para listar somente as agendadas //
		if ( $('#aud_agendada').is(':checked') )
		{
			// Solicita o relatorio //
			Auditoria('agendada');
			return;
		}


		// Analisa se é para listar somente as executadas //
		if ( $('#aud_executada').is(':checked') )
		{
			// Solicita o relatorio //
			Auditoria('executada');
			return;
		}


	}


	// Atualiza o relatorio de auditorias //
	function Auditoria(status)
	{	
		$.getJSON( path + '/relatorio/relatAuditoria/' + status, function (data){
	
			$(tableName).empty();

			$.each(data, function(i, obj) 
			{
				$(tableName).append(
					
					'<tr>' 
					+ 
					
						'<td>' + obj.projetoNome + ' </td>' + 
						'<td>' + obj.unidadeNome +' </td>' + 
						'<td>' + obj.departamentoNome +' </td>' +
						'<td>' + '<span class="label label-'+ obj.statusCode +' ">' + obj.statusNome + '</span>' + '</td>' 

						+   
					'</tr>'

				);
			
			});
		});

	}
	// Fim funcao auditoria //

});
