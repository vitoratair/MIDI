
<!-- Estrutura -->
<div class="container">

	<div class="hero-unit">
		<h1 align="center">MIDI</h1>
		<p align="center">Monitoramento Intelbras de Dados de Importações</p>
		<p align="right"><small>Documentação de desenvolvimento</small></p>
	<hr>
	


	<h2><u>Sumário</u></h2>
	<br>

	<div id="Table of Contents1">
		
		<p><a href="#__RefHeading__587_71787220">1 - Arquivos</a></p>

		<p><a href="#__RefHeading__587_71787220">2 - Classes</a></p>

	</div>
	<hr>

	<ol start="1">
		<li>
			<p align="LEFT">
				<a name="__RefHeading__587_71787220"></a><a name="_Toc330651652"></a>
				<h2>Arquivos</h2>
					
			</p>
		</li>
	</ol>

	<p class="western" align="JUSTIFY" style="text-indent: 0.76cm; line-height: 150%">
		Os arquivos deverão ser nomeados seguindo as regras abaixo.

		<blockquote>

			<ul>

				<li><h4>View</h4></li>

				<li><h4>Model</h4></li>

				<li><h4>Controller</h4></li>

			</ul>

		</blockquote>


	<ol start="2">
		<li>
			<p align="LEFT">
				<a name="__RefHeading__587_71787220"></a><a name="_Toc330651652"></a>
				<h2>Classes</h2>
					
			</p>
		</li>
	</ol>

	<p class="western" align="JUSTIFY" style="text-indent: 0.76cm; line-height: 150%">
		As classes desse sistema serão nomeadas de acordo com as regras abaixo.
		
		<blockquote>
		
		<ul>		

			<li><h4>Model</h4></li>
				Nome exato da classe controller que representa a classe model, seguida pela string <code>_model</code>.<br>
				<u>Exemplo:</u><br>	
				<code>
					class Categoria_model extends CI_Model {<br>
					&nbsp;&nbsp;
					...
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					&nbsp;&nbsp;					
					...
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>					
				</code>						
				<br>	

			<li><h4>Controller</h4></li>
				Uma palavra que defina exatamente ao que a classe representa, primeira letra em maiúsculo, demais em minúsculo.<br>
				<u>Exemplo:</u><br>
				<code>
					class Categoria extends CI_Controller{<br>
					&nbsp;&nbsp;
					...
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					&nbsp;&nbsp;					
					...
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
					}
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>					
				</code>


		</ul>		
		</blockquote>
		
	</p>

	</div>


<!-- FIM estrutura -->
