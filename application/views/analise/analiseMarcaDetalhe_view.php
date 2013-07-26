<!-- Estrutura -->
<div class="container">
				
    <table class='table table-striped table-bordered' id="idTabela" align="right">
            
            <tr>
                <td width="5%"><b>NCM</b></td>
                <td width=""><b>Descrição</td>
                <td width="7%"><b>FOB</td>
                <td width="5%"><b>Unidades</td>
                <td width="10%"><b>Marca</td>
                <td width="10%"><b>Modelo</td>
                <td width="5%"><b>Alterar</td>
            </tr>           
    {dados}    
            <tr>    
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


