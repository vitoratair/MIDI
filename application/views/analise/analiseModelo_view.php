<!-- Estrutura -->
<div class="container">				

    <div class="page-header">
        <h2>{categoriaNome} <small> {marca} importados no ano de {ano}</h2>
    </div>
    
    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/analiseAno', $atributos); 
    ?>
    <a class="btn" onclick="enviar(3);" href="#"><i class="icon-search"></i> Gráfico</a>
    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
    <input type="hidden" name="ano" value="{ano}"> 
    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form>

    <table class='table table-striped table-bordered' id="idTabela" align="right">
            
            <tr>
                <td width=""><b>Marca</b></td>
                <td width=""><b>Unidades</td>
                <td width=""><b>Volume</td>
                <td width=""><b>FOB</td>
                <td width=""><b>% Unidades</td>
                <td width=""><b>% Volume</td>
                <td width=""><b>Evolução</td>
                <td width=""><b>Detalhes</td>
                <td width=""><b>Pesquisa</td>
            </tr>           
    {dados}                
            <tr class="table-condensed">
                <td>{modeloNome}</td>
                <td>{unidades}</td>
                <td>$ {volume}</td>
                <td>$ {fob}</td>
                <td>{shareUnidades}</td>
                <td>{shareVolume}</td>
                <td width="5%"><a onclick="enviar(1, {modelo});" href="#" class='icon-search'><a/></td>
                <td width="5%"><a onclick="enviar(2, {modelo});" href="#" class='icon-search'><a/></td>
                <td width="5%"><a target="blank" href="https://www.google.com.br/search?q={marca}+{modeloNome}&safe=off&biw=1440&bih=805&source=lnms&sa=X&ei=wIO-Uaj0C8ux0AGW1YHICw&ved=0CAgQ_AUoAA"><img width="25px" src="<?php echo base_url();?>img/google.png"><a/></td>
            </tr>

    {/dados}

    {total}
            <tr class="info table-condensed">    
                <td><strong>Total</strong></td>
                <td><strong>{totalunidades}</strong></td>
                <td><strong>$ {totalvolume}</strong></td>
                <td colspan = "6"></td>
            </tr>
    {/total}

    </table>


<script type="text/javascript">
    function enviar(id, modelo)
    {    
        if (id == 1)
        {
            document.write('<form action="analiseModeloEvolucao" name="Myform" method="POST">')
            document.write('<input type="hidden" name="modelo" value="'+modelo+'">');            
        }            
        else if (id == 2)
        {
            document.write('<form action="analiseModeloDetalhe" name="Myform" method="POST">')
            document.write('<input type="hidden" name="modelo" value="'+modelo+'">');            
        }      
        else if (id == 3)
        {
            document.write('<form action="analiseAnoParticipacaoModelo" name="Myform" method="POST">')
            document.write('<input type="hidden" name="marca" value="'+{marcaID}+'">');            
        }            

        document.write('<input type="hidden" name="categoria" value="'+<?php echo $categoria;?>+'">');
        document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        document.write('<input type="hidden" name="subcategorias" value="'+<?php echo $postSubcategorias;?>+'">');        
        document.write('</form>')
        document.Myform.submit()

    }
</script>

