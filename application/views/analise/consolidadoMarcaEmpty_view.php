<!-- Estrutura -->
<div class="container">
				
<br>									

<table class="table table-bordered">
    <tr>
        <td>            
            <?php
                $atributos = array('form class'=>' form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
                echo form_open('analise/analiseMarcaAno', $atributos); 
            ?>

                <div align="left">
                    <select id="marca"  name="marca" class="span2" onchange="this.form.submit()">                 
                        <option value=""> - </option>
                        {marcas}    
                            <option value="{MAID}">{MANome}</option>
                        {/marcas}
                        
                    </select>
                </div>
            </form>

        </td>

    </tr>

</table>	


<hr>

    <div class="page-header">
        <h2>{marcaNome} <small> consolidado</h2>
    </div>


<script type="text/javascript">

function enviar(categoria, ano)
{    
    document.write('<form action="analiseAno" name="Myform" method="POST">')
    document.write('<input type="hidden" name="categoria" value="'+categoria+'">');
    document.write('<input type="hidden" name="ano" value="'+ano+'">');
    document.write('<input type="hidden" name="subcategorias" value="'+<?php echo $postSubcategorias;?>+'">');
    document.write('</form>')
    document.Myform.submit()
}

</script>

 