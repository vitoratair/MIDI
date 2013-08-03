<!-- Estrutura -->
<div class="container">
    
    <div class="page-header">
        <h2>{categoriaNome}<small> da marca {marcaNome} importados no ano de {ano}</h2>
    </div>

    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/analiseAno', $atributos); 
    ?>

    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="ano" value="{ano}">    
    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form>


    <table class='table table-striped table-bordered table-hover' id="idTabela" align="right">

            <tr>
                <td width="5%"><b>NCM</b></td>
                <td width="50%"><b>Descrição</td>
                <td width="7%"><b>FOB</td>
                <td width="5%"><b>Unidades</td>
                <td width="10%"><b>Marca</td>
                <td width="10%"><b>Modelo</td>
                <td width="5%"><b>Alterar</td>
            </tr>           
    {dados}    
            <tr class="table-condensed">
                <td>{ncm}</td>
                <td>{descricao}</td>
                <td>$ {fob}</td>
                <td>{unidades}</td>
                <td>{marca}</td>
                <td>{modelo}</td>
                <td width="5%"><a target="blank" href="<?php echo base_url();?>index.php/pesquisa/edit/{idn}/{ncm}/{ano}" class='icon-edit'> <a/></td>
            </tr>

    {/dados}

    </table>


<script type="text/javascript">
    function enviar(id, ncm, ano, idn)
    {    
        if (id == 1)
        {
            document.write('<form action="analiseEdicao" name="Myform" method="POST">')
            document.write('<input type="hidden" name="ncm" value="'+ncm+'">');
            document.write('<input type="hidden" name="ano" value="'+ano+'">');
            document.write('<input type="hidden" name="idn" value="'+idn+'">');      
        }                 
        document.write('</form>')
        document.Myform.submit()

    }
</script>
