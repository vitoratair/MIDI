
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


			/* Valida o Nome completo do novo usuario */
			Nome:
			{
				required: true,
				minlength: 6,
				maxlength: 45
			},

			/* Valida campos Nome em cadastros */
			Nome2:
			{
				required: true,
				minlength: 3,
				maxlength: 45
			},
			
			/* Valida campos Descricao */
			Descricao:
			{
				required: true,
				minlength: 6,
				maxlength: 255				
			},

			/* Valida campos Assunto */
			Assunto:
			{
				required: true,
				minlength: 6,
				maxlength: 35				
			},

			/* Valida o nome do usuario, inserido */	
			Matricula:
			{
				required: true,
				minlength: 6,
				maxlength: 6,
				number: true
			},
			
			//Valida Email
			Email:
			{
				required: true,
				email: true
			},

			/* Valida data */
			Data:
			{
				required: true,
				dateISO: true
			},

			Unidade: 
			{
				required: true,
			},

			Setor:
			{
				required: true,
			},

			Projeto: 
			{
				required: true,
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









			Nome:{
				required: "Informe o nome completo do novo usuário",
				minlength:"O nome do novo usuario deve ser maior que 6 caracteres ",
				maxlength:"O nome do novo usuario deve ser menor que 45 caracteres ",
			},
			
			Nome2:{
				required: "Informe o nome Válido",
				minlength:"O nome deve ser maior que 2 caracteres ",
				maxlength:"O nome deve ser menor que 45 caracteres ",
			},

			Descricao:{
				required: "Informe a descrição",
				minlength:"A Descricao deve ser maior que 6 caracteres ",
				maxlength:"O nome deve ser menor que 256 caracteres ",
			},

			Assunto:{
				required: "Informe o assunto",
				minlength:"O assunto ser maior que 6 caracteres ",
				maxlength:"O Assunto deve ser menor que 35 caracteres ",
			},

			Matricula:
			{
				required:"Informe a matrícula do usuário",
				minlength:"A matricula digitada pussui menos que 6 números",
				maxlength: "A matricula digitada possui mais que 6 números"
				
			},
								
			Email:
			{
				required:"Informe um endereço de e-mail",
				email:"Endereço de e-mail invalido"
			},

			Data:{
				required: "Informe a data para auditoria",
				dateISO: "Informe uma data valida, exemplo: dd/mm/aaaa"
			},

			Unidade:
			{
				required: "Escolha uma Unidade",
			},

			Setor:
			{
				required: "Escolha um Departamento",
			},

			Projeto:
			{
				required: "Escolha um Projeto",
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
