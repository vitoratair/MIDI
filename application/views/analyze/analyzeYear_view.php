<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">{categoriaNome}  <small>importados no ano de {ano}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar(7)">Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->


<div class="container">
				

    <?php
        $atributos = array('form class'=>'form-horizontal',  'id'=>'FormCadastro', 'align' => 'right', 'method'=>'POST');
        echo form_open('analyze/listAll', $atributos); 
    ?>
        <input type="hidden" name="categoria" value="{categoria}">
        <p align="right"><a class="btn-u" onclick="enviar(6);" href="#"><i class="icon-search"></i> Gráfico</a></p>
    </form>

    <table class='table table-bordered table-hover' align="right">
            
    <thead>
            <tr>
                <td width=""><b>Marca</b></td>
                <td width=""><b>Unidades</b></td>
                <td width=""><b>Volume</b></td>
                <td width=""><b>FOB</b></td>
                <td width=""><b>% Unidades</b></td>
                <td width=""><b>% Valor</b></td>
                <td width=""><b>Modelos</b></td>
                <td width=""><b>Evolução</b></td>
                <td width=""><b>Detalhes</b></td>
            </tr>      
    </thead>     
    {dados}    
            <tr class="table-condensed">
                <td>{nomeMarca}</td>
                <td>{unidades}</td>
                <td>$ {volume}</td>
                <td>$ {fob}</td>
                <td>{shareUnidades}</td>
                <td>{shareVolume}</td>
                <td width="5%"><a onclick="enviar(1, {marca});" href="#" class='icon-search'> </a></td>
                <td width="5%"><a onclick="enviar(2, {marca});" href="#" class='icon-search'> </a></td>
                <td width="5%"><a onclick="enviar(3, {marca});" href="#" class='icon-search'> </a></td>
                
            </tr>

    {/dados}

    {total}
            <tr class="success">  
                <td><strong>Total</strong></td>
                <td><strong>{totalunidades}</strong></td>
                <td><strong>$ {totalvolume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a onclick="enviar(4);" href="#" class='icon-search'> </a></td>
            </tr>
    {/total}

    {outros}

            <tr class="success">    
                <td><strong>Outros</strong></td>
                <td><strong>{unidades}</strong></td>
                <td><strong>$ {volume}</strong></td>
                <td colspan = "5"></td>
                <td width="5%"><a onclick="enviar(5);" href="#" class='icon-search'> </a></td>
            </tr>
    {/outros}

    </table>

</div>



<script type="text/javascript">
    function enviar(id, marca)
    {    
        if (id == 1)
        {            
            var url = '<?php echo base_url();?>index.php/analyze/analyzeModel';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="marca" value="' + marca + '" />' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        }
        else if (id == 2)
        {                
            var url = '<?php echo base_url();?>index.php/analyze/analizeBrandEvolution';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="marca" value="' + marca + '" />' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +              
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        }
        else if(id == 3)
        {
            var url = '<?php echo base_url();?>index.php/analyze/analizeBrandDetails';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="marca" value="' + marca + '" />' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        }
        else if(id == 4)
        {
            var url = '<?php echo base_url();?>index.php/analyze/analizeBrandDetails';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        }        
        else if(id == 5)
        {
           
        } 
        else if(id == 6)
        {
            var url = '<?php echo base_url();?>index.php/analyze/analyzeYearShare';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();


        }        
        else if(id == 7)
        {
            var url = '<?php echo base_url();?>index.php/analyze/listAll';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="categoria" value="' + {categoria} + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +              
              '</form>');
            $('body').append(form);
            $(form).submit();            
        }        
        



    }
</script>

