<!-- Estrutura -->
<div class="container">			
	
	

	<!-- Legenda da pesquisa -->
	<h3 align="center">Lista<small> de requisições</h3><br>
		
	<!-- Tabela com a lista de linhas de NCMs -->
	<table class='table table-bordered'>
			
			<tr class="">				
				<td width="4%"><b>ID</b></td>
				<!-- <td width="4%"><b>Login</b></td> -->
				<td width=""><b>Descrição</td>
<!-- 				<td width=""><b>Categoria</td> -->
				<td width=""><b>Categoria</td>
				<!-- <td width=""><b>Marca</td> -->
				<td width=""><b>Marca</td>
				<!-- <td width=""><b>Modelo</td> -->
				<td width=""><b>Modelo</td>
				<td colspan="2" width=""><b>Opções</td>
			</tr>			
	{dados}	
			<tr class="table-condensed">
				<td colspan="7"></td>			
			<tr>
			<tr class="">	
				<td>{idn}</td>	
				<!-- <td>{login}</td>			 -->
				<td>{descricao}</td>
				<!-- <td>{categoria}</td> -->
				<td><font color=""><strong>{categoriaRe}</strong></font></td>
				<!-- <td>{marca}</td> -->
				<td><font color=""><strong>{marcaRe}</strong></font></td>				
				<!-- <td>{modelo}</td>	 -->
				<td><font color=""><strong>{modeloRe}</strong></font></td>							
				<td><a onclick='Excluir("{idRe}")' data-toggle="modal" href="#deletar" class='icon-trash'></a></td>								
				<td><a onclick='altera("{idRe}", "{idn}", "{table}", "{categoriaReID}", "{marcaReID}", "{modeloReID}")' data-toggle="modal" href="#alterar" class='icon-ok'></a></td>
			</tr>					
	{/dados}			

	</table>



<!-- 
	+++++++++++++++++++++++++++++++++++++++++++++++++++
		++ Janela Modal para alteração dos dados ++
	+++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<!-- Modal para alteração da categoria -->	
	
	<div class="modal hide" id="deletar">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					×
				</button>
				<h3>Excluir</h3>
			</div>

			<div class="modal-body">
				<p>Deseja realmente excluir a requisição?</p>
			</div>

			 <div class="modal-footer">
				<a href="" class="btn" data-dismiss="modal">Não</a>
				<a href="" class="btn btn-danger" id="Excluir">Sim</a>
		 	</div>
	</div>


<!-- 	<div class="modal hide" id="alterar">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					×
				</button>
				<h3>Alteração</h3>
			</div>

			<div class="modal-body">
				<p>Deseja realmente realizar a alteração?</p>
			</div>

			 <div class="modal-footer">
				<a href="" class="btn" data-dismiss="modal">Não</a>
				<a href="" class="btn btn-danger" id="altera">Sim</a>
		 	</div>
	</div>
 -->
<script type="text/javascript">

	function Excluir(id)
	{
        document.write('<form action="delete" name="Myform" method="POST">')
		document.write('<input type="hidden" name="idRe" value="'+id+'">')
		document.write('</form>')
        document.Myform.submit()
	}

	
	function altera(id, idn, table, categoria, marca, modelo)
	{
		
        document.write('<form action="updateRequest" name="Myform" method="POST">')               
        document.write('<input type="hidden" name="idRe" value="'+id+'">');
        document.write('<input type="hidden" name="idn" value="'+idn+'">');
        document.write('<input type="hidden" name="table" value="'+table+'">');
        document.write('<input type="hidden" name="categoria" value="'+categoria+'">');
        document.write('<input type="hidden" name="marca" value="'+marca+'">');
        document.write('<input type="hidden" name="modelo" value="'+modelo+'">');
        document.write('</form>')
        document.Myform.submit()

	}	


</script>



