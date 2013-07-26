<!-- Estrutura -->
<div class="container">
				
    <?php
        $atributos = array('form class'=>'well form-horizontal',  'id'=>'FormCadastro', 'method'=>'POST');
        echo form_open('analise/listAll', $atributos); 
    ?>

        <div align="right">
            <select id="datainicial"  name="datainicial" class="span2">                                   
                <option value=""> Data Inicial </option>                 
                    <option value="1">Janeiro</option>
                    <option value="2">Fevereiro</option>
                    <option value="3">Março</option>
                    <option value="4">Abril</option>
                    <option value="5">Maio</option>
                    <option value="6">Junho</option>
                    <option value="7">Julho</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>            
            </select>
            &nbsp;&nbsp;&nbsp;
            <select id="datafinal"  name="datafinal" class="span2">                   
                
                <option value=""> Data Final </option>                 
                    <option value="1">Janeiro</option>
                    <option value="2">Fevereiro</option>
                    <option value="3">Março</option>
                    <option value="4">Abril</option>
                    <option value="5">Maio</option>
                    <option value="6">Junho</option>
                    <option value="7">Julho</option>
                    <option value="8">Agosto</option>
                    <option value="9">Setembro</option>
                    <option value="10">Outubro</option>
                    <option value="11">Novembro</option>
                    <option value="12">Dezembro</option>                
            </select>
        </div>

    </form>

    <table class='table table-striped table-bordered' id="idTabela" align="right">
            
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
            <tr>    
                <td>{nomeMarca}</td>
                <td>{unidades}</td>
                <td>$ {volume}</td>
                <td>$ {fob}</td>
                <td>{shareUnidades}</td>
                <td>{shareVolume}</td>
                <td width="5%"><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
                <td width="5%" ><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
                <td width="5%"><a onclick="enviar({marca});" href="#" class='icon-search'> <a/></td>
            </tr>

    {/dados}

    {total}
            <tr class="info">    
                <td><strong>Total</strong></td>
                <td><strong>{totalunidades}</strong></td>
                <td><strong>$ {totalvolume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
            </tr>
    {/total}

    {outros}

            <tr class="info">    
                <td><strong>Outros</strong></td>
                <td><strong>{unidades}</strong></td>
                <td><strong>$ {volume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a href="<?php echo base_url();?>index.php/analise/analiseAno" class='icon-search'> <a/></td>
            </tr>
    {/outros}

    </table>


<script type="text/javascript">
    function enviar(marca)
    {    
        document.write('<form action="analiseMarcaDetalhe" name="Myform" method="POST">')
        document.write('<input type="hidden" name="categoria" value="'+<?php echo $categoria;?>+'">');
        document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        document.write('<input type="hidden" name="subcategorias" value="'+<?php echo $postSubcategorias;?>+'">');
        document.write('<input type="hidden" name="marca" value="'+marca+'">');
        document.write('</form>')
        document.Myform.submit()
    }
</script>

