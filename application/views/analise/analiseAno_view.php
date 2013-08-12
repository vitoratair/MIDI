<!-- Estrutura -->
<div class="container">
				

    <div class="page-header">
        <h2>{categoriaNome} <small> importados no ano de {ano}</h2>
    </div>

    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
    ?>
    <input type="hidden" name="categoria" value="{categoria}">
    <a class="btn" onclick="enviar(6);" href="#"><i class="icon-search"></i> Gráfico</a>
    <button type="submit" class="btn btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form>

    <table class='table table-striped table-bordered table-hover' id="idTabela" align="right">
            
            <tr>
                <td width=""><b>Marca</b></td>
                <td width=""><b>Unidades</td>
                <td width=""><b>Volume</td>
                <td width=""><b>FOB</td>
                <td width=""><b>% Unidades</td>
                <td width=""><b>% Volume</td>
                <td width=""><b>Modelos</td>
                <td width=""><b>Evolução</td>
                <td width=""><b>Detalhes</td>
            </tr>           
    {dados}    
            <tr class="table-condensed">
                <td>{nomeMarca}</td>
                <td>{unidades}</td>
                <td>$ {volume}</td>
                <td>$ {fob}</td>
                <td>{shareUnidades}</td>
                <td>{shareVolume}</td>
                <td width="5%"><a onclick="enviar(1, {marca});" href="#" class='icon-search'> <a/></td>
                <td width="5%"><a onclick="enviar(2, {marca});" href="#" class='icon-search'> <a/></td>
                <td width="5%"><a onclick="enviar(3, {marca});" href="#" class='icon-search'> <a/></td>
                
            </tr>

    {/dados}

    {total}
            <tr class="info table-condensed">  
                <td><strong>Total</strong></td>
                <td><strong>{totalunidades}</strong></td>
                <td><strong>$ {totalvolume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a onclick="enviar(4);" href="#" class='icon-search'> <a/></td>
            </tr>
    {/total}

    {outros}

            <tr class="info table-condensed">    
                <td><strong>Outros</strong></td>
                <td><strong>{unidades}</strong></td>
                <td><strong>$ {volume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a onclick="enviar(5);" href="#" class='icon-search'> <a/></td>
            </tr>
    {/outros}

    </table>


<script type="text/javascript">
    function enviar(id, marca)
    {    
        if (id == 1)
        {
            document.write('<form action="analiseModelo" name="Myform" method="POST">')
            document.write('<input type="hidden" name="marca" value="'+marca+'">');            
        }
        else if (id == 2)
        {
            document.write('<form action="analiseMarcaEvolucao" name="Myform" method="POST">')
            document.write('<input type="hidden" name="marca" value="'+marca+'">');
        }
        else if(id == 3)
        {
            document.write('<form action="analiseMarcaDetalhe" name="Myform" method="POST">')
            document.write('<input type="hidden" name="marca" value="'+marca+'">');
        }
        else if(id == 4)
        {
            document.write('<form action="analiseMarcaDetalhe" name="Myform" method="POST">')
        }        
        else if(id == 5)
        {
            document.write('<form action="analiseOutrosDetalhe" name="Myform" method="POST">')
        } 
        else if(id == 6)
        {
            document.write('<form action="analiseAnoParticipacao" name="Myform" method="POST">')
        }                

        document.write('<input type="hidden" name="categoria" value="'+<?php echo $categoria;?>+'">');
        document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        document.write('<input type="hidden" name="subcategorias" value="'+<?php echo $postSubcategorias;?>+'">');        
        document.write('</form>')
        document.Myform.submit()

    }
</script>

