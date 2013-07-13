

/**
* Manipulaçao de relatorio para Nao Conformidade
*/
$(document).ready(function() {

	var tableName = '#tab_nc tbody';
	

	$(':checkbox[id=nc_aberta]').change (analisa);
	$(':checkbox[id=nc_fechada]').change (analisa);



	// relatorio completo //
	function checkAll()
	{
		NC('all');
	}


	// Analisa status  //
	function analisa()
	{

		// Analisa se é para listar todas as ncs //
		if ( ( $('#nc_aberta').is(':checked') &&  $('#nc_fechada').is(':checked') ) || $('#nc_aberta').is(':unchecked') &&  $('#nc_fechada').is(':unchecked'))
		{
			checkAll();
			return;
		}

		// Analisa se é para listar somente as fechadas //
		if ( $('#nc_fechada').is(':checked') )
		{
			// Solicita o relatorio //
			NC('fechada');
			return;
		}


		// Analisa se é para listar somente as abertas //
		if ( $('#nc_aberta').is(':checked') )
		{
			// Solicita o relatorio //
			NC('aberta');
			return;
		}


	}


	// Atualiza o relatorio de Nao conformidade //
	function NC(status)
	{	
		$.getJSON( path + '/relatorio/relatNC/' + status, function (data){
	
			$(tableName).empty();

			$.each(data, function(i, obj) 
			{
				$(tableName).append(
					
					'<tr>' 
					+ 
					
						'<td>' + obj.ncDescricao + ' </td>' + 
						'<td>' + obj.artefatoNome +' </td>' + 
						'<td>' + obj.projetoNome +' </td>' + 
						'<td>' + '<span class="label label-'+ obj.statusCode +' ">' + obj.statusNome + '</span>' + '</td>' 

						+   
					'</tr>'

				);
			
			});
		});

	}
	// Fim funcao auditoria //

});
