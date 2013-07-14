
$(document).ready(function(){

	$('input').hover(function()
	{
		$(this).popover('show')
	});

	$("#FormCadastro").validate(
	{
		
		rules:
		{
			
			/* Valida o categoria */
			categoriaNome:
			{
				required: true,
				minlength: 3,
				maxlength: 45
			},

			/* Valida o NCM */
			ncmNome:
			{
				required: true,
				minlength: 8,
				maxlength: 8,
				number: true
			},

			/* Valida a descricao da NCM */
			ncmDescricao:
			{
				minlength: 8,
				maxlength: 150
			},

			/* Valida o titulo */
			subcategoria:
			{
				required: true,
				minlength: 3,
				maxlength: 45
			},

			/* Valida o indice */
			indice:
			{
				required: true,
				minlength: 1,				
				maxlength: 1,
				number: true
			},

			/* Valida o item da subcategoria */
			subcategoriaitem:
			{
				required: true,
				minlength: 3,				
				maxlength: 45
			},

			/* Valida marca */
			marcaNome:
			{
				required: true,
				minlength: 2,				
				maxlength: 45
			},


			/* Valida marca Sinônimo */
			marcaNome1:
			{
				minlength: 2,				
				maxlength: 45
			},	

			/* Valida marca Sinônimo */
			marcaNome2:
			{
				minlength: 2,				
				maxlength: 45
			},				

			/* Valida modelo */
			nomeModelo:
			{
				required: true,
				minlength: 2,				
				maxlength: 45
			},		

			/* Valida modelo */
			nomeModelo1:
			{
				minlength: 2,				
				maxlength: 45
			},	

			/* Valida modelo */
			nomeModelo2:
			{
				minlength: 2,				
				maxlength: 45
			},		
			
			/* Valida modelo */
			nomeModelo3:
			{
				minlength: 2,				
				maxlength: 45
			},		

			/* Valida modelo */
			nomeModelo4:
			{
				minlength: 2,				
				maxlength: 45
			},		

			/* Valida marca no combobox */
			marca:
			{		
				required: true
			},
		
		},
		
		messages:
		{
			categoriaNome:{
				required: "Informe a categoria",
				minlength:"O nome da nova categoria deve ser maior que 3 caracteres ",
				maxlength:"O nome da nova categoria deve ser menor que 45 caracteres ",
			},

			ncmNome:{
				required: "Informe a NCM",
				minlength:"O nome NCM deve possuir 8 caracteres ",
				maxlength:"O nome NCM deve possuir 8 caracteres ",
				number: "O nome da NCM deve possuir apenas caracteres numéricos",
			},			

			ncmDescricao:{
				minlength:"A descrição da categoria deve ser maior que 6 caracteres ",
				maxlength:"A descriçao da categoria deve ser menor que 150 caracteres ",
			},	

			subcategoria:{
				required: "Informe a subcategoria",
				minlength:"A subcategoria deve ser maior que 3 caracteres ",
				maxlength:"A subcategoria deve ser meno que 45 caracteres ",
			},	

			indice:{
				number: "O índice deve ser numérico",
				required: "Informe o índice",
				minlength:"O índice deve ser igual a 1 ",
				maxlength:"O índice deve ser igual a 1 ",
			},	
									
			subcategoriaitem:{
				required: "Informe o item",
				minlength:"O item deve ser maior que 3 caracteres ",
				maxlength:"O item deve ser menor que 45 caracteres ",
			},

			marcaNome:{
				required: "Informe a marca",
				minlength:"O nova marca deve ser maior que 2 caracteres ",
				maxlength:"O nova marca deve ser menor que 45 caracteres ",
			},

			marcaNome1:{
				minlength:"O nova marca deve ser maior que 2 caracteres ",
				maxlength:"O nova marca deve ser menor que 45 caracteres ",
			},

			marcaNome2:{
				minlength:"O nova marca deve ser maior que 2 caracteres ",
				maxlength:"O nova marca deve ser menor que 45 caracteres ",
			},

			nomeModelo:{
				required: "Informe o modelo",
				minlength:"O modelo deve ser maior que 3 caracteres ",
				maxlength:"O modelo deve ser menor que 45 caracteres ",
			},

			nomeModelo1:{
				minlength:"O modelo deve ser maior que 3 caracteres ",
				maxlength:"O modelo deve ser menor que 45 caracteres ",
			},

			nomeModelo2:{
				minlength:"O modelo deve ser maior que 3 caracteres ",
				maxlength:"O modelo deve ser menor que 45 caracteres ",
			},

			nomeModelo3:{
				minlength:"O modelo deve ser maior que 3 caracteres ",
				maxlength:"O modelo deve ser menor que 45 caracteres ",
			},

			nomeModelo4:{
				minlength:"O modelo deve ser maior que 3 caracteres ",
				maxlength:"O modelo deve ser menor que 45 caracteres ",
			},											
			
			marca:{
				required: "Selecione a marca",
			},	

		},

		errorClass: "help-block",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {

			$(element).parents('.control-group').removeClass('success');
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {

			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
});
