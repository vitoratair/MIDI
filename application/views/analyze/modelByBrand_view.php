<!--=== Breadcrumbs ===-->
<div class="row-fluid breadcrumbs margin-bottom-40">
    <div class="container">
        <h1 class="pull-left">{categoriaNome}  <small>{marca} importados entre {mesInicial} e {mesFinal} de {ano}</small></h1>
        <ul class="pull-right breadcrumb">
            <li><a href="<?php echo base_url();?>index.php/app/home">Home</a> <span class="divider"> / </span></li>
            <li><a href="#" onclick="enviar(4)" >Análise</a> <span class="divider"> / </span></li>
            <li class="active">Análise por ano</li>
        </ul>
    </div><!--/container-->
</div><!--/breadcrumbs-->

<div class="container">				
    
	<p align="right"><a class="btn-u" onclick="enviar(3);" href="#"><i class="icon-search"></i> Gráfico</a></p>

    <table class='table table-bordered' align="right">
		<thead>
            <tr>
                <td width=""><b>Marca</b></td>
                <td width=""><b>Unidades</b></td>
                <td width=""><b>Volume</b></td>
                <td width=""><b>FOB</b></td>
                <td width=""><b>% Unidades</b></td>
                <td width=""><b>% Volume</b></td>
                <td width=""><b>Evolução</b></td>
                <td width=""><b>Detalhes</b></td>
                <td width=""><b>Pesquisa</b></td>
            </tr>           
		</thead>  
    
    {dados}      
    	<tbody>
            <tr class="table-condensed">
                <td>{modeloNome}</td>
                <td>{unidades}</td>
                <td>$ {volume}</td>
                <td>$ {fob}</td>
                <td>{shareUnidades}</td>
                <td>{shareVolume}</td>
                <td width="5%"><a onclick="enviar(1, {modelo});" href="#" class='icon-search'></a></td>
                <td width="5%"><a onclick="enviar(2, {modelo});" href="#" class='icon-search'></a></td>
                <!-- <td width="5%"><a target="blank" href="https://www.google.com.br/search?q={marca}+{modeloNome}&safe=off&biw=1440&bih=805&source=lnms&sa=X&ei=wIO-Uaj0C8ux0AGW1YHICw&ved=0CAgQ_AUoAA"><img width="25px" src="<?php echo base_url();?>assets/img/google.png"></a></td> -->
                <td width="5%"><a target="blank" href="https://www.google.com.br/search?q={marca}+{modeloNome}&safe=off&biw=1440&bih=805&source=lnms&sa=X&ei=wIO-Uaj0C8ux0AGW1YHICw&ved=0CAgQ_AUoAA"><i class="icon icon-search"></i></a></td>
            </tr>
        </tbody>
    {/dados}

    {total}
            <tr class="table-condensed">    
                <td><strong>Total</strong></td>
                <td><strong>{totalunidades}</strong></td>
                <td><strong>$ {totalvolume}</strong></td>
                <td colspan = "6"></td>
            </tr>
    {/total}

    </table>

</div>

<script type="text/javascript">
    function enviar(id, modelo)
    {    
        if (id == 1)
        {
            var url = '<?php echo base_url();?>index.php/analyze/analyzeModelEvolution';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="modelo" value="' + modelo + '" />' +
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
            var url = '<?php echo base_url();?>index.php/analyze/analyzeModelDetails';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="modelo" value="' + modelo + '" />' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +              
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();



        }      
        else if (id == 3)
        {

            var url = '<?php echo base_url();?>index.php/analyze/yearAnalyzeShareModel';
            var form = $('<form action="' + url + '" method="POST">' +
              '<input type="hidden" name="marca" value="' + {marcaID} + '" />' +
              '<input type="hidden" name="categoria" value="' + <?php echo $categoria;?> + '" />' +
              '<input type="hidden" name="ano" value="' + <?php echo $ano;?> + '" />' +
              '<input type="hidden" name="dataInicial" value="' + <?php echo $dataInicial;?> + '" />' +
              '<input type="hidden" name="dataFinal" value="' + <?php echo $dataFinal;?> + '" />' +                
              '<input type="hidden" name="subcategorias" value="' + <?php echo $postSubcategorias;?> + '" />' +
              '</form>');
            $('body').append(form);
            $(form).submit();
        } 
        else if (id == 4)
        {

            var url = '<?php echo base_url();?>index.php/analyze/yearAnalyze';
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


        // document.write('<input type="hidden" name="categoria" value="'+<?php echo $categoria;?>+'">');
        // document.write('<input type="hidden" name="ano" value="'+<?php echo $ano;?>+'">');
        // document.write('<input type="hidden" name="subcategorias" value="'+<?php echo $postSubcategorias;?>+'">');        
        // document.write('</form>')
        // document.Myform.submit()

    }
</script>


