
// getJSON Unidade //
$(function(){

	$("select[name=Unidade]").change(function(){

		unidade = $(this).val();
		
		if ( unidade === '')
			return false;
		
		resetaCombo('Setor');
		resetaCombo('Projeto');
			
		$.getJSON( path + '/departamento/getDepartamento/' + unidade, function (data){
	
			//console.log(data);
			var option = new Array();
		
			$.each(data, function(i, obj){

		    	option[i] = document.createElement('option');
		    	$( option[i] ).attr( {value : obj.departamentoID} );
		 		$( option[i] ).append( obj.departamentoNome );

		    	$("select[name='Setor']").append( option[i] );
		
			});
	
		});
	
	});

});

// getJSON Setor //
$(function(){

	$("select[name=Setor]").change(function(){

		setor = $(this).val();
		
		if ( setor === '')
			return false;
		
		resetaCombo('Projeto');
			
		$.getJSON( path + '/projeto/getProjetos/' + setor, function (data){
	
			//console.log(data);
			var option = new Array();
		
			$.each(data, function(i, obj){

		    	option[i] = document.createElement('option');
		    	$( option[i] ).attr( {value : obj.projetoID} );
		 		$( option[i] ).append( obj.projetoNome );

		    	$("select[name='Projeto']").append( option[i] );
		
			});
	
		});
	
	});

});


function resetaCombo( el ) {
   $("select[name='"+el+"']").empty();
   var option = document.createElement('option');                                  
   $( option ).attr( {value : ''} );
   $( option ).append( 'Escolha' );
   $("select[name='"+el+"']").append( option );
}