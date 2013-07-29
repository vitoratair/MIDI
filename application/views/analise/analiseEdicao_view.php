<!-- Estrutura -->
<div class="container">
    
    <div class="page-header">
        <h2>{modeloNome}<small> importados no ano de {ano}</h2>
    </div>

    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analise/analiseModelo', $atributos); 
    ?>

    <input type="hidden" name="subcategorias" value="{postSubcategorias}">
    <input type="hidden" name="categoria" value="{categoria}">
    <input type="hidden" name="ano" value="{ano}">
    <input type="hidden" name="marca" value="{marca}">    
    <button type="submit" class="btn"><i class="icon-arrow-left"></i> Voltar</button>
    </form>


    <table class='table table-striped table-bordered table-hover' id="idTabela" align="right">
            
            <tr>
                <td width="5%"><b>Tabela</b></td>
                <td width="50%"><b>Descrição</td>
                <td width="5%"><b>Unidades</td>
                <td width="10%"><b>Marca</td>
                <td width="10%"><b>Modelo</td>
            </tr>           
    {dados}    
            <tr class="table-condensed">
                <td>{ncm}</td>
                <td>{descricao}</td>
                <td>$ {fob}</td>
                <td>{unidades}</td>
                <td>{marca}</td>
                <td>{modelo}</td>
                <td width="5%"><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-edit'> <a/></td>
            </tr>

    {/dados}

    </table>


